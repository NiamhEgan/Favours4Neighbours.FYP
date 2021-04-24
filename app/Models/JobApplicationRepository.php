<?php

namespace App\Models;

use CodeIgniter\Model;

class JobApplicationRepository extends Model
{
    protected $table      = 'jobapplication';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = [

        "Job",
        "Status",
        "User",
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];

    protected $skipValidation     = false;
}
class JobApplicationStatus
{
    //TODO: get names and id
    public const Open = 1;
    public const Closed = 2;
}
