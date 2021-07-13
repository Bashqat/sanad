<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterOrganisation extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table='organisation';
    protected $fillable = ['org_db_name',
    'superadmin_id',
    
    ];
}
