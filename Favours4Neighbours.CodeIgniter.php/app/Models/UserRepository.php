<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRepository extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['name', 'email', "active", "username", "password"];

    protected $useTimestamps = false;

    protected $validationRules    = [];
    protected $validationMessages = [];

    protected $skipValidation     = false;
}