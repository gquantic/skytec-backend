<?php

namespace App\Console\Commands\ldap;

use Illuminate\Console\Command;
use LdapRecord\Container;

class GetUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-user-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connection = Container::getConnection('default');
        dd($connection->query()->where('cn', '=', '*')->first());
    }
}
