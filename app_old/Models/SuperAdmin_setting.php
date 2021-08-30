<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdmin_setting extends Model
{
    use HasFactory;
    protected $table='super_admin_setting';
    protected $fillable = ['pin','superadmin_id'];
   
}
