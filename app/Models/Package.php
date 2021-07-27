<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $table='package';
    protected $fillable = ['name',
    'price',
    'storage_per_org',
    'invite_user_count',
    'contact_count',
    'third_party_api',
    'storage',
    'email'
  ];
}
