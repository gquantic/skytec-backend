<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Начало')
                ->icon('bs.book')
                ->title('Навигация')
                ->route(config('platform.index')),

            Menu::make(__('Пользователи'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Контроль доступа')),

            Menu::make(__('Отделы'))
                ->icon('bs.people')
                ->route('platform.departments.list')
                ->divider(),

            Menu::make(__('Роли'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),

            Menu::make(__('Настройки сайта'))
                ->icon('bs.ui-checks-grid')
                ->route('platform.systems.configs')
                ->permission('platform.systems.users')
                ->title(__('Сайт')),

            Menu::make(__('Документы'))
                ->icon('bs.ui-checks-grid')
                ->route('platform.documents.list'),

            Menu::make(__('Статьи'))
                ->icon('bs.ui-checks-grid')
                ->route('platform.articles.list'),

            Menu::make(__('Новости'))
                ->icon('bs.ui-checks-grid')
                ->route('platform.news.list'),

            Menu::make('Документация')
                ->title('Разработчикам')
                ->icon('bs.box-arrow-up-right')
                ->url('https://orchid.software/ru/docs')
                ->target('_blank'),

            Menu::make('Лог изменений')
                ->icon('bs.box-arrow-up-right')
                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                ->target('_blank')
                ->badge(fn () => Dashboard::version(), Color::DARK),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('Системные'))
                ->addPermission('platform.systems.roles', __('Роли'))
                ->addPermission('platform.systems.users', __('Пользователи')),

            ItemPermission::group(__('Портал'))
                ->addPermission('users.create', __('Создание пользователей')),
        ];
    }
}
