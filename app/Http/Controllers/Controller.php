<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function organizationTypes(){
        return [
            'individual' => 'Individual',
            'sole_proprietorship' => 'Sole proprietorship',
            'general_partnership' => 'General Partnership',
            'corporation' => 'Corporation',
            'limited_liability_company' => 'Limited liability company',
            'non_profit' => 'Non-Profit'
        ];
    }

    public function businessTypes(){
        return [
            'automotive' => 'Automotive',
            'chemicals_and_specialty_materials' => 'Chemicals and Specialty Materials',
            'consumer_products' => 'Consumer Products',
            'retail,_wholesale_and_distribution' => 'Retail, Wholesale and Distribution',
            'travel,_hospitality_and_services' => 'Travel, Hospitality and Services',
            'energy_&_resources' => 'Energy & Resources',
            'mining' => 'Mining',
            'oil_&_gas' => 'Oil & Gas',
            'power' => 'Power',
            'shipping_&_ports' => 'Shipping & Ports',
            'water' => 'Water',
            'financial_services' => 'Financial Services',
            'banking_&_securities' => 'Banking & Securities',
            'insurance' => 'Insurance',
            'investment_management' => 'Investment Management',
            'real_estate' => 'Real Estate',
            'life_sciences_&_health_care' => 'Life Sciences & Health Care',
            'health_care' => 'Health Care',
            'life_sciences' => 'Life Sciences',
            'public_sector' => 'Public Sector',
            'civil_government' => 'Civil Government',
            'defense' => 'Defense',
            'education' => 'Education',
            'international_donor_organizations' => 'International Donor Organizations',
            'public_health_and_social_services' => 'Public Health and Social Services',
            'public_transportation' => 'Public Transportation',
            'security_and_justice' => 'Security and Justice',
            'technology' => 'Technology',
            'media' => 'Media',
            'telecommunications' => 'Telecommunications',

        ];
    }
    public function uploadDataAttachmentsGetLinks($dataArr,$path = 'Default'){
        foreach ( $dataArr as $key => $data ) {
            if( is_object($data) ){
                if(strpos(get_class($data), 'UploadedFile') !== false){
                    $file = $data;
                    $imageName = Str::random(15).'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('images/'.$path), $imageName);
                    $dataArr[$key] = 'images/'.$path.'/'.$imageName;
                }
            }elseif( is_array($data) ){
                $links = [];
                foreach ( $data as $key2 => $data2 ) {
                    if( is_object($data2) ){
                        if(strpos(get_class($data2), 'UploadedFile') !== false){
                            $file = $data2;
                            $imageName = Str::random(15).'.'.$file->getClientOriginalExtension();
                            $file->move(public_path('images/'.$path), $imageName);
                            $links[] = 'images/'.$path.'/'.$imageName;
                        }
                    }
                }
                if( !empty($links) ){
                    $dataArr[$key] = $links;
                }
            }
        }
        return $dataArr;
    }
}
