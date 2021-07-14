<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'xero_contact_id',
        'name',
        'name_arabic',
        'type',
        'tags',
        'account_no',
        'logo',
        'business_registration_number',
        'tax_registration_number',
        'address',
        'location',
        'phone',
        'fax',
        'mobile',
        'website',
        'email',
        'user_defined',
        'attachment',
        'notes',
        'organization_id',
        'created_by',
    ];
    protected $casts = [
        'phone' => 'array',
        'fax' => 'array',
        'mobile' => 'array',
        'address' => 'array',
        'attachment' => 'array',
        'tags' => 'array',
    ];
}
