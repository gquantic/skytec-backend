<?php

namespace App\Orchid\Screens\DownloadFile;

use App\Events\FileSystemUploaded;
use App\Models\DownloadFile;
use App\Services\FileService;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class DownloadFileEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(DownloadFile $file): iterable
    {
        return [
            'file' => $file,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редактирование файла';
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
                ->method('saveFile')
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
            Layout::rows([
                Input::make('file.slug')
                    ->title('Ссылка'),

                Upload::make('file.url')
                    ->title('Файл')
                    ->media()
                    ->maxFiles(1)
                    ->closeOnAdd(),
            ])
        ];
    }

    public function saveFile(Request $request, DownloadFile $file)
    {
        $data = $request->collect('file')->toArray();

//        $attachment = Attachment::query()->find($data['url'][0]);
//        $data['url'] = $attachment->url();

        foreach ($data['url'] as $key => $value) {
            if ($value == 'undefined') {
                unset($data['url'][$key]);
            } else {
                $data['url'][0] = $value;
            }
        }

        if (isset($data['url']) && is_array($data['url']) && count($data['url']) > 0) {
            $uploadFile = $data['url'];
            $fileService = new FileService();

            $data['url'] = $fileService->reUploadOrchidFile($data['slug'], $data['url']);
        }

        $file->update($data);

        Toast::info('Файл успешно добавлен.');
        return redirect()->route('platform.download-files.list');
    }
}
