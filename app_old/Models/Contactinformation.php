<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    use HasFactory;
    protected $table='contact_information';

    protected $fillable = [
        'type',
        'first_name',
        'last_name',
        'nickname',
        'position',
        'land_line',
        'mobile',
        'email',
        'notes',
        'user_defined',
        'attachment',
        'contact_id',
        'group_id'
    ];

    protected $casts = [
        'land_line' => 'array',
        'mobile' => 'array',
        'attachment' => 'array',
    ];
}
