<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\SubjectModel;

class Tasks extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $tasks = $db->table('tasks')
            ->select('tasks.*, subjects.name as subject_name')
            ->join('subject_tasks', 'subject_tasks.task_id = tasks.id')
            ->join('subjects', 'subjects.id = subject_tasks.subject_id')
            ->where('tasks.user_id', session()->get('userId'))
            ->get()
            ->getResultArray();

        return view('tasks/index', ['tasks' => $tasks]);
    }

    public function create()
    {
        $subjectModel = new SubjectModel();
        $data['subjects'] = $subjectModel->where('user_id', session()->get('userId'))->findAll();
        $data['preselectedSubjectId'] = $this->request->getGet('subject_id');

        return view('tasks/create', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required',
            'deadline' => 'required|valid_date',
            'subject_id' => 'required',
        ];

        if (!$this->validate($rules)) {
            $subjectModel = new SubjectModel();
            $subjects = $subjectModel->where('user_id', session()->get('userId'))->findAll();
            return view('tasks/create', ['subjects' => $subjects, 'validation' => $this->validator]);
        }

        $taskModel = new TaskModel();
        $taskId = $taskModel->insert([
            'user_id' => session()->get('userId'),
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'deadline' => $this->request->getPost('deadline'),
            'status' => 'pending', // adjust to 0 if your status column is an integer — check this
        ]);

        $db = \Config\Database::connect();
        $db->table('subject_tasks')->insert([
            'subject_id' => $this->request->getPost('subject_id'),
            'task_id' => $taskId,
        ]);

        return redirect()->to('/tasks/')->with('success', 'Task created.');
    }

    public function toggle($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->where('id', $id)->where('user_id', session()->get('userId'))->first();

        if ($task) {
            $newStatus = ($task['status'] === 'pending') ? 'completed' : 'pending';
            $taskModel->update($id, ['status' => $newStatus]);
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $db = \Config\Database::connect();
        $task = $db->table('tasks')
            ->select('tasks.*, subjects.id as subject_id, subjects.name as subject_name')
            ->join('subject_tasks', 'subject_tasks.task_id = tasks.id')
            ->join('subjects', 'subjects.id = subject_tasks.subject_id')
            ->where('tasks.id', $id)
            ->where('tasks.user_id', session()->get('userId'))
            ->get()
            ->getRowArray();

        if (!$task) {
            return redirect()->to('/tasks/')->with('error', 'Task not found.');
        }

        return view('tasks/show', ['task' => $task]);
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();
        $task = $db->table('tasks')
            ->select('tasks.*, subjects.id as subject_id')
            ->join('subject_tasks', 'subject_tasks.task_id = tasks.id')
            ->join('subjects', 'subjects.id = subject_tasks.subject_id')
            ->where('tasks.id', $id)
            ->where('tasks.user_id', session()->get('userId'))
            ->get()
            ->getRowArray();

        if (!$task) {
            return redirect()->to('/tasks/')->with('error', 'Task not found.');
        }

        $subjectModel = new SubjectModel();
        $subjects = $subjectModel->where('user_id', session()->get('userId'))->findAll();

        return view('tasks/edit', ['task' => $task, 'subjects' => $subjects]);
    }

    public function update($id)
    {
        
        $taskModel = new TaskModel();
        $existing = $taskModel->find($id);
        if (!$existing || $existing['user_id'] != session()->get('userId')) {
            return redirect()->to('/tasks/')->with('error', 'Task not found.');
        }

        $rules = ['title' => 'required', 'deadline' => 'required|valid_date'];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $taskModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'deadline' => $this->request->getPost('deadline'),
            'status' => $this->request->getPost('status'),
        ]);

        $db = \Config\Database::connect();
        $db->table('subject_tasks')->where('task_id', $id)->update([
            'subject_id' => $this->request->getPost('subject_id'),
        ]);

        return redirect()->to('/tasks/' . $id)->with('success', 'Task updated.');
    }

    public function delete($id)
    {
    
        $taskModel = new TaskModel();
        $existing = $taskModel->find($id);
        if (!$existing || $existing['user_id'] != session()->get('userId')) {
            return redirect()->to('/tasks/')->with('error', 'Task not found.');
        }

        $db = \Config\Database::connect();
        $db->table('subject_tasks')->where('task_id', $id)->delete();
        $taskModel->delete($id);

        return redirect()->to('/tasks/')->with('success', 'Task deleted.');
    }
}