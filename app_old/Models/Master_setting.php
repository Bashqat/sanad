<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_setting extends Model
{
    protected $table='master_admin_setting';
    protected $fillable = ['business_name','email','currency','address','application_name','application_title','application_default_language','smtp_email','smtp_username','smtp_password','user_id'];
    //use HasFactory;
}
