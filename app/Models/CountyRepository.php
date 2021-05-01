<?php

namespace App\Models;

use CodeIgniter\Model;
class CountyRepository extends Model
{
    protected $table      = 'county';
   
    protected $primaryKey = 'id';


    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = [
        "county",
    
       
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];

    protected $skipValidation     = false;

   
}
