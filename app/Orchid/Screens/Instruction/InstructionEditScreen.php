<?php

namespace App\Orchid\Screens\Instruction;

use App\Events\FileSystemUploaded;
use App\Models\Documents\Document;
use App\Models\Documents\Instruction;
use App\Models\Documents\VacationApplicationDocument;
use App\Orchid\Layouts\Document\DocumentCreateLayout;
use App\Orchid\Layouts\Instruction\InstructionEditLayout;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class InstructionEditScreen extends Screen
{
    public $document;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Instruction $document): iterable
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
            InstructionEditLayout::class
        ];
    }

    public function saveDocument(Request $request, Instruction $document)
    {
        $data = $request->collect('document')->toArray();

        if (isset($request->document['attachment'])) {
            $file = $request->document['attachment'];
            $fileService = new FileService();

            $fileName = $fileService->uploadFile($file);

            $data['attachment'] = $fileName;
        } else {
            $data['attachment'] = '';
        }

        $document->update($data);

        Toast::info('Документ успешно добавлен.');
        return redirect()->route('platform.instructions.list');
    }
}
