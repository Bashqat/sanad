<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactattachment extends Model
{
    use HasFactory;
    protected $table='contact_attachment';
    protected $fillable = [
        'id',
        'folder_name',
        'contact_id',
        'contact_detail_id',
        'files'
    ];
}
