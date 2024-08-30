<?php

namespace App\Orchid\Screens\Instruction;

use App\Events\FileSystemUploaded;
use App\Models\Documents\Document;
use App\Models\Documents\Instruction;
use App\Models\Documents\VacationApplicationDocument;
use App\Orchid\Layouts\Document\DocumentCreateLayout;
use App\Orchid\Layouts\Instruction\InstructionEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class InstructionCreateScreen extends Screen
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
        return 'Добавление инструкции';
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
            InstructionEditLayout::class,
        ];
    }

    public function createDocument(Request $request, Instruction $document)
    {
        $data = $request->collect('document')->toArray();
        $data['show'] = true;

        Instruction::query()->create($data);
        Event(new FileSystemUploaded());

        Toast::info('Документ успешно добавлен.');
        return redirect()->route('platform.instructions.list');
    }
}
