<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table='contact_employee';
    protected $fillable = [
        'name',
        'name_arabic',
        'type',
        'tags',
        'address',
        'phone',
        'mobile',
        'email',
        'attachment',
        'notes',
        'organization_id',
        'created_by',
        'emp_info',
        'personal_info',
        'emergency_contact',
        'dependent_info',
        'contact_type'
    ];
    protected $casts = [

        'mobile' => 'array',
        'phone'=>'array',
        'address' => 'array',
        'attachment' => 'array',
        'tags' => 'array',
        'emp_info'=>'array',
        'personal_info'=>'array',
        'emergency_contact'=>'array',
        'dependent_info'=>'array',
        'email'=>'array'
    ];
}
