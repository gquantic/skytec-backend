<?php

namespace App\Console\Commands\Config;

use App\Models\Site\Config;
use Illuminate\Console\Command;

class SetBaseConfigs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:base';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set site base configs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Config::query()->updateOrCreate([
            'title' => 'HelpDesc — почта',
            'name' => 'help_desc_mail',
        ], [
            'value' => 'help@skytecmedia.ru',
        ]);

        Config::query()->updateOrCreate([
            'title' => 'АХО — почта',
            'name' => 'axo_mail',
        ], [
            'value' => 'reception@skytecmedia.ru',
        ]);

        Config::query()->updateOrCreate([
            'title' => 'Заявка на отпуск — почта',
            'name' => 'vacation_mail',
        ], [
            'value' => 'HR@skyalliance.media',
        ]);

        Config::query()->updateOrCreate([
            'title' => 'Обучение — почта',
            'name' => 'education_mail',
        ], [
            'value' => 'HR@skyalliance.media',
        ]);

        Config::query()->updateOrCreate([
            'title' => 'Заявка на командировку — почта',
            'name' => 'trip_mail',
        ], [
            'value' => 'HR@skyalliance.media',
        ]);

        Config::query()->updateOrCreate([
            'title' => 'Заказать справку — почта',
            'name' => 'order_certificate_mail',
        ], [
            'value' => 'HR@skyalliance.media',
        ]);
    }
}
