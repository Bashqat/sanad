<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactfiles extends Model
{
    use HasFactory;
    protected $table='contact_attachment_files';
    protected $fillable = [
        'id',
        'folder_id',
        'file_name',
        'file_path',
        'file_type'
    ];
}
