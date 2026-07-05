<?php
namespace App\Models;
use CodeIgniter\Model;

class SummaryModel extends Model
{
    protected $table = 'summaries';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'title', 'content'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}