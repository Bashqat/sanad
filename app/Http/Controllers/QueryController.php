<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class QueryController extends Controller
{
    public function createDb($db_name)
    {
        if(DB::statement("CREATE DATABASE $db_name"))
        {
            $query="use $db_name";
            DB::statement($query);
            $this->createRole();
            $this->createUser();
            $this->createOrganisation();
            return 'aaaa';
        }
    }
    public function createOrganisation()
    {
        $query="CREATE TABLE `organisations` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `org_name` varchar(255) NOT NULL,
            `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `superadmin_id` bigint UNSIGNED DEFAULT NULL,
            `display_name` varchar(255) DEFAULT NULL,
            `legal_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            -- `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'organization-avatar.png',
            `type_of_organization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `type_of_business` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `business_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `current_date_utc_format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `status` enum('active','not-active') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `user_defined` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
          ";
          DB::statement($query);
    }
    public function createRole()
    {
        $query="CREATE TABLE `roles` (
            `id` bigint UNSIGNED NOT NULL,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
            DB::statement($query);
    }
    public function createUser()
    {
        $query= "CREATE TABLE `users` (
            `id` bigint UNSIGNED NOT NULL,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            -- `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `email_verified_at` timestamp NULL DEFAULT NULL,
            `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user-avatar.png',
            `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            `organization_id` bigint UNSIGNED DEFAULT NULL,
            `status` enum('pending_acceptance','active','suspended') COLLATE utf8mb4_unicode_ci NOT NULL,
            `xero_access_token` longtext COLLATE utf8mb4_unicode_ci,
            `tenants` longtext COLLATE utf8mb4_unicode_ci,
            `tenant_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
            DB::statement($query);
    }
    public function createContact()
    {
        $query="CREATE TABLE `contacts` (
            `id` bigint UNSIGNED NOT NULL,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `name_arabic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact',
            `tags` json DEFAULT NULL,
            `account_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'images/contacts/contact-avatar.png',
            `business_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `tax_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `address` json DEFAULT NULL,
            `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `phone` json DEFAULT NULL,
            `fax` json DEFAULT NULL,
            `mobile` json DEFAULT NULL,
            `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `user_defined` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `attachment` json DEFAULT NULL,
            `notes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
            `organization_id` bigint UNSIGNED DEFAULT NULL,
            `created_by` bigint UNSIGNED DEFAULT NULL,
            `xero_contact_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `xero_sync_status` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'false',
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            `group_id` bigint UNSIGNED DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
          DB::statement($query);
    }

}
