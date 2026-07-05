<?php
namespace App\Models;
use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'subject_id', 'title', 'description', 'deadline_date', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}