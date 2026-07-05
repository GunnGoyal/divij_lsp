<?php
namespace App\Models;
use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'name', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}