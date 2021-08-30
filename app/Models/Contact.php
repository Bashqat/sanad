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
        'nickname',
        'position',
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
        'country',
        'city',
        'emp_info',
        'personal_info',
        'emergency_contact',
        'dependent_info',
        'contact_type',
        'financial_information',
        'company_type',
        'group_id'
    ];
    protected $casts = [
        'phone' => 'array',
        'fax' => 'array',
        'mobile' => 'array',
        'address' => 'array',
        'attachment' => 'array',
        'tags' => 'array',
        'financial_information'=>'array',
        'emp_info'=>'array',
        'personal_info'=>'array',
        'emergency_contact'=>'array',
        'dependent_info'=>'array',
        'group_id'=>'array'
    ];
    public function contact_information()
    {
      return $this->hasMany(ContactInformation::class, 'contact_id', 'id');
    }
    public function website_information()
    {
      return $this->hasMany(Websiteinformation::class, 'contact_id', 'id')->where('type','contact');
    }
    public function notes()
    {
      return $this->hasMany(Notes::class, 'contact_id', 'id');
    }
    public function activity()
    {
      return $this->hasMany(contact_activity::class, 'contact_id', 'id');
    }
}
