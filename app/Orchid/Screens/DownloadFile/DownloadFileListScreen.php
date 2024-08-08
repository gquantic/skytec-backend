<?php

namespace App\Orchid\Screens\DownloadFile;

use App\Models\DownloadFile;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class DownloadFileListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'files' => DownloadFile::query()->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Скачиваемые файлы';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
//            Link::make('Добавить файл')
//                ->route('platform.documents.create')
//                ->icon('plus')
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
            Layout::table('files', [
                TD::make('file.id', 'ID')
                    ->render(fn (DownloadFile $file) => $file->id),

                TD::make('file.slug', 'Slug')
                    ->render(fn (DownloadFile $file) => $file->slug),

                TD::make('file.download', 'Download url')
                    ->render(fn (DownloadFile $file) => $file->download),

                TD::make('file.edit', '')
                    ->width(250)
                    ->render(function (DownloadFile $file) {
                        return Link::make('Редактировать')
                            ->icon('pencil')
                            ->route('platform.download-files.edit', $file->id);
                    }),
            ])
        ];
    }
}
