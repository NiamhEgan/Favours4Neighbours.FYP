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

        $data['data']['Password'] = $this->createPasswordHash($data['data']['Password']);

        return $data;
    }

    public function createPasswordHash($plainTextPassword)
	{
		return hash("ripemd160", $plainTextPassword);
	}


    public function hashText(String $password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
