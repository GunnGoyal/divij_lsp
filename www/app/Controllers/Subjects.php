<?php

namespace App\Controllers;

use App\Models\SubjectModel;

class Subjects extends BaseController
{
    public function index()
    {
        $model = new SubjectModel();
        // Fetch only subjects belonging to the currently logged-in user
        $data['subjects'] = $model->where('user_id', session()->get('userId'))->findAll();
        return view('subjects/index', $data);
    }

    public function create()
    {
        return view('subjects/create');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'code' => 'permit_empty|max_length[10]' // Only include if your DB column 'code' exists
        ];

        if (!$this->validate($rules)) {
            return view('subjects/create', ['validation' => $this->validator]);
        }

        $model = new SubjectModel();
        $model->save([
            'user_id' => session()->get('userId'), // SECURITY: bind to user
            'name'    => $this->request->getPost('name'),
            'code'    => $this->request->getPost('code'),
        ]);

        return redirect()->to('/subjects')->with('success', 'Subject created successfully.');
    }

    public function show($id)
    {
        $model = new SubjectModel();
        
        // Security check: ensure the subject belongs to the logged-in user
        $subject = $model->where('id', $id)
                         ->where('user_id', session()->get('userId'))
                         ->first();

        if (!$subject) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $tab = $this->request->getGet('tab') ?? 'tasks';

        return view('subjects/show', [
            'subject' => $subject,
            'tab'     => $tab
        ]);
    }

    public function edit($id)
{
    $model = new SubjectModel();
    $subject = $model->find($id);

    if (!$subject || $subject['user_id'] != session()->get('user_id')) {
        return redirect()->to('/subjects')->with('error', 'Subject not found.');
    }

    return view('subjects/edit', ['subject' => $subject]);
}

public function update($id)
{
    $rules = [
        'name' => 'required|min_length[2]',
    ];

    if (!$this->validate($rules)) {
        $model = new SubjectModel();
        $subject = $model->find($id);
        return view('subjects/edit', ['subject' => $subject, 'validation' => $this->validator]);
    }

    $model = new SubjectModel();
    $subject = $model->find($id);
    if (!$subject || $subject['user_id'] != session()->get('user_id')) {
        return redirect()->to('/subjects')->with('error', 'Subject not found.');
    }

    $model->update($id, [
        'name' => $this->request->getPost('name'),
        'description' => $this->request->getPost('description'),
    ]);

    return redirect()->to('/subjects' . $id)->with('success', 'Subject updated.');
}

public function delete($id)
{
    $model = new SubjectModel();
    $subject = $model->find($id);

    if (!$subject || $subject['user_id'] != session()->get('user_id')) {
        return redirect()->to('/subjects')->with('error', 'Subject not found.');
    }

    $model->delete($id);
    return redirect()->to('/subjects')->with('success', 'Subject deleted.');
}
}