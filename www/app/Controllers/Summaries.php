<?php

namespace App\Controllers;

use App\Models\SummaryModel;
use App\Models\SubjectModel;
use GuzzleHttp\Client;

class Summaries extends BaseController
{
    public function store()
{
    $userId = session()->get('userId');

    $rules = [
        'title'      => 'required',
        'document'   => 'uploaded[document]|ext_in[document,pdf]',
        'subject_id' => 'permit_empty|is_natural_no_zero',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $file = $this->request->getFile('document');
    $newName = $file->getRandomName();
    $file->move(WRITEPATH . 'uploads', $newName);
    $path = WRITEPATH . 'uploads/' . $newName;

    $parser = new \Smalot\PdfParser\Parser();
    $pdf = $parser->parseFile($path);
    $text = $pdf->getText();

    try {
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => ['Authorization' => 'Bearer ' . env('OPENAI_API_KEY')],
            'json' => [
                'model' => 'gpt-4o',
                'messages' => [['role' => 'user', 'content' => 'Summarize this: ' . substr($text, 0, 5000)]],
            ],
        ]);
        $result = json_decode($response->getBody(), true);
        $summaryText = $result['choices'][0]['message']['content'];
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Could not generate summary. Please try again.');
    }

    $model = new \App\Models\SummaryModel();
    $newId = $model->insert([
        'user_id' => $userId,
        'title'   => $this->request->getPost('title'),
        'content' => $summaryText, // matches your actual column name
    ]);

    $subjectId = $this->request->getPost('subject_id');
    if ($subjectId) {
        $db = \Config\Database::connect();
        $db->table('subject_summaries')->insert([
            'subject_id' => $subjectId,
            'summary_id' => $newId,
        ]);
    }

    return redirect()->to('/summaries/' . $newId)->with('success', 'Summary created.');
}

public function index()
{
    $db = \Config\Database::connect();
    $summaries = $db->table('summaries')
        ->select('summaries.*, subjects.name as subject_name')
        ->join('subject_summaries', 'subject_summaries.summary_id = summaries.id', 'left')
        ->join('subjects', 'subjects.id = subject_summaries.subject_id', 'left')
        ->where('summaries.user_id', session()->get('userId'))
        ->get()
        ->getResultArray();

    return view('summaries/index', ['summaries' => $summaries]);
}

public function show($id)
{
    $db = \Config\Database::connect();
    $summary = $db->table('summaries')
        ->select('summaries.*, subjects.id as subject_id, subjects.name as subject_name')
        ->join('subject_summaries', 'subject_summaries.summary_id = summaries.id', 'left')
        ->join('subjects', 'subjects.id = subject_summaries.subject_id', 'left')
        ->where('summaries.id', $id)
        ->where('summaries.user_id', session()->get('userId'))
        ->get()
        ->getRowArray();

    if (!$summary) {
        return redirect()->to('/summaries')->with('error', 'Summary not found.');
    }

    
    $summary['summary_text'] = $summary['content'];

    return view('summaries/show', ['summary' => $summary]);
}

public function delete($id)
{
    $model = new \App\Models\SummaryModel();
    $existing = $model->find($id);
    if (!$existing || $existing['user_id'] != session()->get('userId')) {
        return redirect()->to('/summaries')->with('error', 'Summary not found.');
    }

    $db = \Config\Database::connect();
    $db->table('subject_summaries')->where('summary_id', $id)->delete();
    $model->delete($id);

    return redirect()->to('/summaries')->with('success', 'Summary deleted.');
}
public function create()
{
    $subjectModel = new SubjectModel();
    $subjects = $subjectModel->where('user_id', session()->get('userId'))->findAll();
    $preselectedSubjectId = $this->request->getGet('subject_id');

    return view('summaries/create', [
        'subjects' => $subjects,
        'preselectedSubjectId' => $preselectedSubjectId,
    ]);
}
    
}