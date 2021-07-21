<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Org_setting extends Model
{
    use HasFactory;
    protected $table='setting';
    protected $fillable = ['org_name',
    'smtp_email',
    'smtp_username',
    'smtp_password',
    'smtp_host',

  ];
}
