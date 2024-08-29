<?php

namespace App\Orchid\Layouts\Document;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Attach;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class DocumentCreateLayout extends Rows
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
            Select::make('document.company')
                ->title('Компания')
                ->options(config('structure.companies')),

            Input::make('document.title')
                ->title('Название')
                ->required()
                ->type('text'),

            Attach::make('document.attachment')
                ->value('document.attachment')
                ->title('Файл'),

//            CheckBox::make('document.show')
//                ->title('Показывать на сайте')
//                ->placeholder('Документ будет отображен в разделе Нормативные документы')
//                ->value(1)
        ];
    }
}
