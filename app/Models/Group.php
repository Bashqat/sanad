<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['title','parent'];

    public function referrer()
        {
             return $this->hasOne('App\Models\Group', 'parent', 'id');
        }

    public function subgroup()
      {
            return $this->hasMany('App\Models\Group','parent','id');
      }
}
