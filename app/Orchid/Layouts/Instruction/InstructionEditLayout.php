<?php

namespace App\Orchid\Layouts\Instruction;

use App\Orchid\Fields\UploadFile;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Attach;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class InstructionEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('document.title')
                ->title('Название')
                ->type('text'),

            Upload::make('document.attachment')
                ->title('Файл'),
        ];
    }
}
