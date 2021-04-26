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

        "Applicant",
        "Job",
        "Status",
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
    public const Accepted = 1;
    public const Pending = 2;
    public const Rejected = 3;
    public const Withdrawn = 4;
}
