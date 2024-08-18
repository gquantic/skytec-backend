<?php

namespace App\Orchid\Screens\VacationApplicationDocument;

use App\Models\Applications\VacationApplication;
use App\Models\Documents\VacationApplicationDocument;
use App\Orchid\Layouts\Document\DocumentListLayout;
use App\Orchid\Layouts\VacationDocument\VacationDocumentListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class VacationDocumentListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'documents' => VacationApplicationDocument::all(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список заявлений на отпуск';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить документ')
                ->route('platform.vacation-documents.create')
                ->icon('plus')
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
            VacationDocumentListLayout::class
        ];
    }

    public function remove(VacationApplicationDocument $document)
    {
        $document->delete();
        Toast::error("Документ {$document->title} удален");
//        return redirect()->route('platform.documents.index');
    }
}
