<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;
    protected $table='organisation_info';
    protected $fillable = ['org_name',
    'superadmin_id',
    'org_id',
    'org_db_name',
    'display_name',
    'legal_name',
    // 'logo',
    'type_of_organization',
    'type_of_business',
    'business_registration_number',
    'location',
    'address',
    'current_date_utc_format',
    'phone',
    'fax',
    'mobile',
    'website',
    'tax_reg_number',
    'email',
    'currency',
    'status',
    'user_defined',
    'logo'
  ];
  protected $casts = [
      'address' => 'array',
    ];
}
