<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Spatie\Permission\Models\Permission;

class SyncPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $permissions = [
            "association",
            "bazar",
            "street-setup"
        ];

        $permission_list = Permission::all()->pluck('name')->toArray();

        foreach ($permissions as  $item) {
            if (!in_array($item,$permission_list)){
                Permission::create(['name' => $item]);
            }

        }

        echo "Permission Sync Successfully";
    }
}
