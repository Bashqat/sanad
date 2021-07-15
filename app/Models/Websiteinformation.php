<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Websiteinformation extends Model
{
    use HasFactory;
    protected $table='website_informations';

    protected $fillable = [
        'title',
        'type',
        'link',
        'username',
        'password',
        'contact_id',
        'group_id'
    ];
}
