<?php

namespace App\Orchid\Screens\Page;

use App\Models\Page\Page;
use App\Orchid\Fields\PageBlocksEditor;
use App\Orchid\Layouts\Page\PageCreateLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PageEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Page $page): iterable
    {
        return [
            'page' => $page
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редактирование страницы';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить в черновики')
                ->icon('plus')
                ->method('save'),

            Button::make('Опубликовать страницу')
                ->icon('check')
                ->method('publish'),
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
            PageCreateLayout::class,

            Layout::columns([
                Layout::rows([
                    PageBlocksEditor::make('page.left')
                        ->position('left')
                        ->title('Левая колонка'),
                ]),
                Layout::rows([
                    PageBlocksEditor::make('page.center')
                        ->position('center')
                        ->title('Центральная колонка'),
                ]),
                Layout::rows([
                    PageBlocksEditor::make('page.right')
                        ->position('right')
                        ->title('Правая колонка'),
                ]),
            ])
        ];
    }

    public function save(Page $pageModel, Request $request)
    {
        $page = $request->collect('page')->toArray();
        $left = $request->collect('page_left')->toArray() ?? [];
        $center = $request->collect('page_center')->toArray() ?? [];
        $right = $request->collect('page_right')->toArray() ?? [];
        $page['active'] = false;
        $page['uri'] = $page['uri'] ?? Str::slug($page['menu_title'] . ' ' . time());

        foreach ($page as $key => $value) {
            $pageModel->$key = $value;
        }

        $pageModel->left = $left;
        $pageModel->center = $center;
        $pageModel->right = $right;

        $pageModel->save();

        Toast::success('Страница сохранена в черновики');
        return redirect()->route('platform.pages.list');
    }

    public function publish(Page $page, Request $request)
    {
        $pageModel = $page;
        $page = $request->collect('page')->toArray();
        $left = $request->collect('page_left')->toArray() ?? [];
        $center = $request->collect('page_center')->toArray() ?? [];
        $right = $request->collect('page_right')->toArray() ?? [];
        $page['active'] = true;
        $page['uri'] = $page['uri'] ?? Str::slug($page['menu_title'] . ' ' . time());

        foreach ($page as $key => $value) {
            $pageModel->$key = $value;
        }

        $pageModel->left = $left;
        $pageModel->center = $center;
        $pageModel->right = $right;

        $pageModel->save();

        Toast::success('Страница добавлена');
        return redirect()->route('platform.pages.list');
    }
}
