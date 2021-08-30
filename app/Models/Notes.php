<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
    protected $table='contact_notes';
    protected $fillable = [
        'id',
        'contact_id',
        'header',
        'content',
        'created_by'
    ];
}
