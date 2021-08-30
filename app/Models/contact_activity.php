<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact_activity extends Model
{
    use HasFactory;
    protected $table='contact_activities';
    protected $fillable = [
        'contact_id',
        'type',
        'title',
        'description',
        'activity_by'


    ];
}
