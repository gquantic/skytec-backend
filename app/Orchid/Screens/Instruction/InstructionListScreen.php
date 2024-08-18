<?php

namespace App\Orchid\Screens\Instruction;

use App\Models\Applications\VacationApplication;
use App\Models\Documents\Instruction;
use App\Models\Documents\VacationApplicationDocument;
use App\Orchid\Layouts\Document\DocumentListLayout;
use App\Orchid\Layouts\Instruction\InstructionListLayout;
use App\Orchid\Layouts\VacationDocument\VacationDocumentListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class InstructionListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'documents' => Instruction::all(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Инструкции';
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
                ->route('platform.instructions.create')
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
            InstructionListLayout::class,
//            VacationDocumentListLayout::class
        ];
    }

    public function remove(Instruction $document)
    {
        $document->delete();
        Toast::error("Документ {$document->title} удален");
//        return redirect()->route('platform.documents.index');
    }
}
