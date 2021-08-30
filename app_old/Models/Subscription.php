<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    public function user_detail()
    {
      return $this->hasOne(User::class, 'id', 'superadmin_id');
    }
    public function package()
    {
      return $this->hasOne(Package::class, 'id', 'package_id');
    }
}
