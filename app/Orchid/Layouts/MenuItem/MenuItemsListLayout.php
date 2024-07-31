<?php

namespace App\Orchid\Layouts\MenuItem;

use App\Models\Menu\MenuItem;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MenuItemsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'topMenuItems';

    protected $title = 'Верхнее меню';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('menuItem.id', '#')
                ->render(fn (MenuItem $menuItem) => $menuItem->id),

            TD::make('menuItem.title', 'Название')
                ->render(fn (MenuItem $menuItem) => $menuItem->title),

            TD::make('menuItem.sort_top', 'Сортировка')
                ->width(100)
                ->render(function (MenuItem $menuItem) {
                    return ModalToggle::make(' ' . $menuItem->sort_top)
                        ->modal('editTopSortModal')
                        ->method('editTopSort')
                        ->asyncParameters([
                            'menuItem' => $menuItem->id,
                        ])
                        ->icon('pencil');
                }),

            TD::make('menuItem.edit', '')
                ->width(100)
                ->render(function (MenuItem $menuItem) {
                    return Link::make('Редактировать')
                        ->icon('pencil')
                        ->route('platform.menu-items.edit', $menuItem->id);
                }),
        ];
    }
}
