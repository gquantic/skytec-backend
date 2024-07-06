<?php

namespace App\Orchid\Layouts\Config;

use App\Models\Site\Config;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ConfigListLayout extends Table
{
    protected $target = 'configs';

    protected function columns(): iterable
    {
        return [
            TD::make('id', '#')
                ->render(function (Config $config) {
                    return "{$config->id}";
                }),

            TD::make('title', 'Параметр (нажмите для редактирования)')
                ->render(fn (Config $config) => ModalToggle::make($config->title)
                    ->modal('asyncEditConfigModal')
                    ->modalTitle($config->title)
                    ->method('saveConfig')
                    ->asyncParameters([
                        'config' => $config->id,
                    ])),
//                    return "{$config->title}";
//
//                    ModalToggle::make('launch')
//                        ->modal('asyncEditConfigModal');

//                    ModalToggle::make('Open asynchronous modal')
//                        ->method('methodForModal')
//                        ->modalTitle('Customizable Title')
//                        ->modal('asyncModal', [
//                            'welcome' => 'Hello world!',
//                        ]);
//                }),

            TD::make('name', 'Уникальный ID (для разработчика)')
                ->render(function (Config $config) {
                    return "{$config->name}";
                }),

            TD::make('value', 'Значение')
                ->render(function (Config $config) {
                    return "{$config->value}";
                }),
        ];
    }
}
