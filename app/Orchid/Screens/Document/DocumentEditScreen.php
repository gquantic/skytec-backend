<?php

namespace App\Orchid\Screens\Document;

use App\Models\Document;
use App\Orchid\Layouts\Document\DocumentCreateLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class DocumentEditScreen extends Screen
{
    public $document;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Document $document): iterable
    {
        return [
            'document' => $document
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'DocumentEditScreen';
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
                ->method('saveDocument')
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
            DocumentCreateLayout::class
        ];
    }

    public function saveDocument(Request $request, Document $document)
    {
        $data = $request->collect('document')->toArray();

        $document->update($data);

        Toast::info('Документ успешно добавлен.');
        return redirect()->route('platform.documents.list');
    }
}
