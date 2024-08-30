<?php

namespace App\Orchid\Screens\VacationApplicationDocument;

use App\Events\FileSystemUploaded;
use App\Models\Documents\Document;
use App\Models\Documents\VacationApplicationDocument;
use App\Orchid\Layouts\Document\DocumentCreateLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class VacationDocumentCreateScreen extends Screen
{
    public $document;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Добавление документа';
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
                ->method('createDocument'),
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
            DocumentCreateLayout::class,
        ];
    }

    public function createDocument(Request $request, VacationApplicationDocument $document)
    {
        $data = $request->collect('document')->toArray();
        $data['show'] = true;

        VacationApplicationDocument::query()->create($data);
        Event(new FileSystemUploaded());

        Toast::info('Документ успешно добавлен.');
        return redirect()->route('platform.vacation-documents.list');
    }
}
