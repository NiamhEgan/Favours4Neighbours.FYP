<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRepository extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['name', 'email', "active", "Username", "Password"];

    protected $useTimestamps = false;

    protected $validationRules    = [];
    protected $validationMessages = [];

    protected $skipValidation     = false;

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password']))
         return $data;
    
        $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        unset($data['data']['password']);
    
        return $data;
    }
}