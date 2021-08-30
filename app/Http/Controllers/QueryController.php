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
            $db_name=str_replace(' ', '', $db_name);
            $query="use $db_name";
            DB::connection()->getPdo()->exec($query);
            $this->createRole();
            $this->createUser();
            $this->createOrganisation();
            $this->createContact();
            $this->contact_information();
            $this->website_information();
            $this->user_permission();
            $this->user_has_permissions();
            $this->setting();
            $this->conneacted_app();
            $this->contact_activity();
            $this->group();
            $this->createEmployee();
            $this->attachment();
            $this->attachment_file();
            $this->contact_notes();

            return $db_name;
        }
    }
    public function createOrganisation()
    {
        $query="CREATE TABLE `organisation_info` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `org_id` bigint UNSIGNED NOT NULL,
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
            `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `status` enum('active','not-active') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `user_defined` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
          ";
          DB::connection()->getPdo()->exec($query);
    }
    public function createRole()
    {
        $query="CREATE TABLE `roles` (
            `id` bigint UNSIGNED NOT NULL,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
            //DB::statement($query);
            $query1="INSERT INTO `roles` (`id`, `name`) VALUES
            (3, 'admin'),
            (4, 'employee');";
            DB::connection()->getPdo()->exec($query);
            DB::connection()->getPdo()->exec($query1);

    }
    public function createUser()
    {
        $query= "CREATE TABLE `users` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            -- `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

            `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `email_verified_at` timestamp NULL DEFAULT NULL,
            `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user-avatar.png',
            `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `role` bigint COLLATE utf8mb4_unicode_ci DEFAULT NULL,

            `organization_id` bigint UNSIGNED DEFAULT NULL,
            `status` enum('pending_acceptance','active','suspended') COLLATE utf8mb4_unicode_ci NOT NULL,
            `xero_access_token` longtext COLLATE utf8mb4_unicode_ci,
            `tenants` longtext COLLATE utf8mb4_unicode_ci,
            `tenant_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
          //  DB::statement($query);
          DB::connection()->getPdo()->exec($query);
    }
    public function createContact()
    {
        $query="CREATE TABLE `contacts` (
              `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
              `name_arabic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact',
              `company_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `tags` json DEFAULT NULL,
              `account_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `contact_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'person',

              `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'images/contacts/contact-avatar.png',
              `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `business_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `tax_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `address` json DEFAULT NULL,
              `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `phone` json DEFAULT NULL,
              `fax` json DEFAULT NULL,
              `mobile` json DEFAULT NULL,
              `financial_information` json DEFAULT NULL,
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
              `group_id` json DEFAULT NULL,
              `merged_to` bigint UNSIGNED DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        //  DB::statement($query);
        DB::connection()->getPdo()->exec($query);
    }
    public function createEmployee()
    {
        $query="CREATE TABLE `contact_employee` (
              `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
              `name_arabic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact',
              `tags` json DEFAULT NULL,
              `address` json DEFAULT NULL,
              `emp_info` json DEFAULT NULL,
              `contact_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `personal_info` json DEFAULT NULL,
              `emergency_contact` json DEFAULT NULL,
              `dependent_info` json DEFAULT NULL,
              `phone` json DEFAULT NULL,
              `mobile` json DEFAULT NULL,
              `email` json DEFAULT NULL,
              `attachment` json DEFAULT NULL,
              `notes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
              `organization_id` bigint UNSIGNED DEFAULT NULL,
              `created_by` bigint UNSIGNED DEFAULT NULL,

              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              `group_id` bigint UNSIGNED DEFAULT NULL,
              `merged_to` bigint UNSIGNED DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        //  DB::statement($query);
        DB::connection()->getPdo()->exec($query);
    }
    public function contact_information()
    {
        $query="CREATE TABLE `contact_information` (
              `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `contact_id` bigint UNSIGNED NOT NULL,
              `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact',
              `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `land_line` json DEFAULT NULL,
              `mobile` json DEFAULT NULL,
              `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `notes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
              `user_defined` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `attachment` json DEFAULT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              `group_id` json DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
            // DB::statement($query);
            DB::connection()->getPdo()->exec($query);
    }

    public function website_information()
    {
        $query="CREATE TABLE `website_informations` (
          `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `contact_id` bigint UNSIGNED NOT NULL,
          `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact',
          `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `created_at` timestamp NULL DEFAULT NULL,
          `updated_at` timestamp NULL DEFAULT NULL,
          `group_id` bigint UNSIGNED DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        //DB::statement($query);
        DB::connection()->getPdo()->exec($query);

    }
    public function user_permission()
    {
      $query="CREATE TABLE `permissions` (
        `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

      $query1="INSERT INTO `permissions` (`id`, `name`,`slug`, `guard_name`) VALUES

      (1, 'View Contact Only','view_contact', 'contact'),
      (2, 'View Create and Edit Contact','view_create_edit_contact', 'contact'),
      (3, 'View Password','view_password', 'contact'),
      (4, 'Create Drafts Invoices Only','create_draft_invoice', 'sales'),
      (5, 'Create and approve Invoices','create_approve_invoice', 'sales'),
      (6, 'Allow Invoice Payment','allow_invoice_payment', 'sales'),
      (7, 'Create Drafts Quotes Only','create_draft_quote', 'sales'),
      (8, 'Create and approve Quotes','create_approve_quote', 'sales'),

      (9, 'Create Drafts Only','create_journal_draft', 'accounting'),
      (10, 'Create and Post', 'create_post_journal','accounting'),
      (11, 'Allow Date Locking','allow_date_locking', 'accounting'),
      (12, 'Allow to view and Run Reports','allow_view_run_report', 'accounting'),
      (13, 'Allow to Publish Reports', 'allow_publish_report','accounting')



      ";
        DB::connection()->getPdo()->exec($query);
        DB::connection()->getPdo()->exec($query1);

    }
    public function user_has_permissions()
    {

      $query="CREATE TABLE `user_has_permissions` (
        `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `permission_id` text COLLATE utf8mb4_unicode_ci,
        `user_id` bigint(20) UNSIGNED NOT NULL,
        `group_contact_permission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        DB::connection()->getPdo()->exec($query);

    }


    public function setting()
    {
        $query="CREATE TABLE `setting` (
          `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `smtp_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `smtp_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `smtp_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `smtp_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `security_pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `created_at` timestamp NULL DEFAULT NULL,
          `updated_at` timestamp NULL DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
  ";
    DB::connection()->getPdo()->exec($query);
    }
    public function conneacted_app()
    {
        $query="CREATE TABLE `connected_apps` (
              `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'images/connected_apps/contact-avatar.png',
              `app_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `app_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `app_extra_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `status` enum('connected','disconnected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disconnected',
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
            DB::connection()->getPdo()->exec($query);
    }
    public function contact_activity()
    {
      $query="CREATE TABLE `contact_activities` (
        `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `contact_id` bigint(20) UNSIGNED NOT NULL,
        `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
        `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `description` longtext COLLATE utf8mb4_unicode_ci,
        `activity_by` bigint(20) UNSIGNED NOT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
      DB::connection()->getPdo()->exec($query);

    }
    public function group()
    {
      $query="CREATE TABLE `groups` (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
              `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `parent` bigint(20) UNSIGNED DEFAULT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            ";
          DB::connection()->getPdo()->exec($query);
    }
    public function attachment()
    {
      $query="CREATE TABLE `contact_attachment` (
        `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `folder_name` varchar(255) NOT NULL,
        `contact_id` bigint(20) NOT NULL,
        `contact_detail_id` bigint(20) NOT NULL,
        `files` json DEFAULT NULL,
        `created_at` datetime NOT NULL,
        `updated_at` datetime NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      DB::connection()->getPdo()->exec($query);
    }
    public function attachment_file()
    {
      $query="CREATE TABLE `contact_attachment_files` (
        `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `folder_id` bigint(20) NOT NULL,
        `file_name` varchar(255) NOT NULL,
        `file_path` varchar(255) NOT NULL,
        `file_type` varchar(255) NOT NULL,
        `created_at` datetime DEFAULT NULL,
        `updated_at` datetime DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      DB::connection()->getPdo()->exec($query);
    }
    public function contact_notes()
    {
      $query="CREATE TABLE `contact_notes` (
        `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `contact_id` bigint(20) NOT NULL,
        `header` varchar(255) NOT NULL,
        `content` text NOT NULL,
        `created_by` bigint(20) NOT NULL,
        `created_at` datetime NOT NULL,
        `updated_at` datetime NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      DB::connection()->getPdo()->exec($query);
    }

}
