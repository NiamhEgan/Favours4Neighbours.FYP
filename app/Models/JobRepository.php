<?php

namespace App\Models;

use CodeIgniter\Model;

class JobRepository extends Model
{
    protected $table      = 'job';

    protected $primaryKey = 'id';
    protected $foreignKey = 'fk_Job_User1';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = [
        'AssignedTo',
        'CreatedBy',
        'DurationEstimate',
        'EquipmentRequired',
        'JobCategory',
        'JobCounty',
        'JobDetails',
        'JobPrice',
        'JobStatus',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];

    protected $skipValidation     = false;
}

/**
 * Job Status values from Database
 */
class JobStatus
{
    public const Closed = 1;
    public const Open = 2;
}
