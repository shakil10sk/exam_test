<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            "application",
            "certificate",
            "generate",
            "edit",
            "delete",
            "regenerate",
            "invoice",
            "nagorik",
            "trade-license",
            "warish",
            "paribarik",
            "others-application",
            "charittik",
            "mirttu",
            "obibahito",
            "bibahito",
            "punobibaho",
            "sonaton",
            "prottan",
            "vumihin",
            "protibondi",
            "ekoinam",
            "barshikay",
            "onumoti",
            "nodibanga",
            "voterid",
            "onapotti",
            "rashta-khanon",
            "website-management",
            "employee-list",
            "add-employee",
            "view-employee",
            "edit-employee",
            "delete-employee",
            "employee-status",
            "notice-list",
            "add-notice",
            "edit-notice",
            "delete-notice",
            "slider-list",
            "add-slide",
            "edit-slide",
            "delete-slide",
            "vata-list",
            "add-vata",
            "edit-vata",
            "delete-vata",
            "accounts",
            "registers",
            "tax",
            "income-tax",
            "add-income-tax",
            "tax-invoice",
            "home-tax",
            "add-home",
            "add-home-tax",
            "edit-home",
            "delete-home",
            "everyday-reports",
            "accounts-setting",
            "add-accounts",
            "edit-accounts",
            "delete-accounts",
            "setting",
            "union-setup",
            "union-profile",
            "edit-union",
            "role-list",
            "show-role",
            "delete-role",
            "assign-role",
            "reset-all-role",
            "reset-role",
            "create-role",
            "assigned-role",
            "role-setup",
            "role-edit",
            "everyday-attendance-report",
            "all-reports",
            "vata-payment",
            "income-tax-invoice",
            "home-tax-invoice",
            "vata-profile",
            "vata-card-print",
            "rosid-list",
            "association",
            "bazar"
        ];

        foreach ($permissions as  $item) {
            Permission::create(['name' => $item]);
        }
    }
}
