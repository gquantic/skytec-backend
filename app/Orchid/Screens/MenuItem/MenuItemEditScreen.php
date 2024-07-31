<?php

namespace App\Orchid\Screens\MenuItem;

use App\Models\Menu\MenuItem;
use App\Models\Page\Page;
use App\Orchid\Layouts\MenuItem\MenuItemCreateLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class MenuItemEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(MenuItem $menuItem): iterable
    {
        return [
            'item' => $menuItem
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редактирование ссылки';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->icon('check')
                ->method('save'),
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
            MenuItemCreateLayout::class
        ];
    }

    public function save(MenuItem $menuItem, Request $request)
    {
        $data = $request->collect('item')->toArray();
        $data['sort_top'] = $data['sort_top'] ?? 0;
        $data['sort_left'] = $data['sort_left'] ?? 0;

        if ($data['page_id'] != null) {
            $data['url'] = Page::query()->findOrFail($data['page_id'])->uri;
        }

        $menuItem->update(
            $data
        );

        Toast::success('Ссылка добавлена.');
        return redirect()->route('platform.menu-items.list');
    }
}
