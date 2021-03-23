<?php

namespace App\Models;

use CodeIgniter\Model;

class JobRepository extends Model
{
    protected $table      = 'job';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = [
        "CreatedBy",
        "DurationEstimate",
        "DateCreated",
        "EquipmentRequired",
        "jobDetails",
        "JobPrice",
        "JobStatus",
       
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'DateCreated';
    protected $updatedField  = 'DateModified';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];

    protected $skipValidation     = false;

   
}
