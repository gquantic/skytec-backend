<?php

namespace App\Orchid\Screens\MenuItem;

use App\Models\Menu\MenuItem;
use App\Orchid\Layouts\MenuItem\LeftMenuItemsListLayout;
use App\Orchid\Layouts\MenuItem\MenuItemsListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class MenuItemListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'topMenuItems' => MenuItem::query()->where('top_menu', true)->orderByDesc('sort_top')->get(),
            'leftMenuItems' => MenuItem::query()->where('left_menu', true)->orderByDesc('sort_left')->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Ссылки в меню';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить ссылку')
                ->icon('plus')
                ->route('platform.menu-items.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            MenuItemsListLayout::class,
            LeftMenuItemsListLayout::class,

            Layout::modal('editLeftSortModal', [
                Layout::rows([
                    Input::make('menuItem.sort_left')
                        ->type('number')
                        ->title('Позиция в меню')
                        ->help('Позиция по убыванию'),
                ]),
            ])->async('asyncGetMenuItem'),

            Layout::modal('editTopSortModal', [
                Layout::rows([
                    Input::make('menuItem.sort_top')
                        ->type('number')
                        ->title('Позиция в меню')
                        ->help('Позиция по убыванию'),
                ]),
            ])->async('asyncGetMenuItem'),
        ];
    }

    public function asyncGetMenuItem(MenuItem $menuItem): iterable
    {
        return [
            'menuItem' => $menuItem,
        ];
    }

    public function editLeftSort(MenuItem $menuItem, Request $request)
    {
        $menuItem->update([
            'sort_left' => $request->input('menuItem.sort_left'),
        ]);

        Toast::success('Позиция в меню изменена успешно.');
    }

    public function editTopSort(MenuItem $menuItem, Request $request)
    {
        $menuItem->update([
            'sort_top' => $request->input('menuItem.sort_top'),
        ]);

        Toast::success('Позиция в меню изменена успешно.');
    }
}
