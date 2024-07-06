<?php

namespace App\Orchid\Screens\Config;

use App\Models\Site\Config;
use App\Orchid\Layouts\Config\ConfigEditLayout;
use App\Orchid\Layouts\Config\ConfigListLayout;
use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ConfigListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'configs' => Config::query()->paginate(30)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Настройки сайта';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ConfigListLayout::class,

            Layout::modal('asyncEditConfigModal', ConfigEditLayout::class)
                ->async('asyncGetConfig'),
        ];
    }

    public function asyncGetConfig(Config $config): iterable
    {
        return [
            'config' => $config,
        ];
    }

    public function saveConfig(Request $request, Config $config): void
    {
        $data = $request->collect('config')->toArray();
        $config->update($data);
    }
}
