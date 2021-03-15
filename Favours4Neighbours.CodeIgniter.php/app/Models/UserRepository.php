<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRepository extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = [
        "Active",
        "AddressLine1",
        "AddressLine2",
        "Eircode",
        "email",
        "FirstName",
        "Gender",
        "Password",
        "Surname",
        "Telephone",
        "Username",
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'DateCreated';
    protected $updatedField  = 'DateModified';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];

    protected $skipValidation     = false;

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['Password']))
            return $data;

        $data['data']['Password'] = password_hash($data['data']['Password'], PASSWORD_DEFAULT);

        return $data;
    }
}
