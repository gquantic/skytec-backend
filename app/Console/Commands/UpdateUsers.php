<?php

namespace App\Console\Commands;

use App\Imports\UsersImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class UpdateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from excel file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new UsersImport, public_path('Company_structure.xlsx'));
    }
}
