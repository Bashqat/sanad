<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_permission extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='user_has_permissions';
    protected $fillable = ['user_id',
    'permission_id','group_contact_permission'];
}
