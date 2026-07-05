<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function landing()
    {
        if (session()->get('userId')) {
            return redirect()->to('/home');
        }
        return view('landing');
    }

    public function index()
    {
        $userId = session()->get('userId');
        $db = \Config\Database::connect();
        $tasks = $db->table('tasks')
            ->select('tasks.*, subjects.name as subject_name')
            ->join('subject_tasks', 'subject_tasks.task_id = tasks.id')
            ->join('subjects', 'subjects.id = subject_tasks.subject_id')
            ->where('tasks.user_id', $userId)
            ->orderBy('tasks.deadline', 'ASC')
            ->get()
            ->getResultArray();

        return view('home/index', [
            'monthLabel' => date('F Y'),
            'daysInMonth' => [],
            'leadingBlanks' => 0,
            'upcomingTasks' => $tasks,
        ]);
    }
}