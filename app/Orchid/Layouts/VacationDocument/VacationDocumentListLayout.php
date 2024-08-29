<?php

namespace App\Orchid\Layouts\VacationDocument;

use App\Models\Documents\Document;
use App\Models\Documents\VacationApplicationDocument;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class VacationDocumentListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'documents';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', '#')
                ->render(fn (VacationApplicationDocument $document) => $document->id),

            TD::make('title', 'Title')
                ->render(fn (VacationApplicationDocument $document) => $document->title),

            TD::make('company', 'Company')
                ->render(fn (VacationApplicationDocument $document) => $document->company),

            TD::make('attachment', 'File')
                ->render(function (VacationApplicationDocument $document) {
                    return Link::make('Перейти к файлу')
                        ->target('blank')
                        ->href($document->document);
                }),

            TD::make('')
                ->width(80)
                ->render(function (VacationApplicationDocument $document) {
                    return Link::make('Редактировать')
                        ->target('blank')
                        ->route('platform.vacation-documents.edit', $document->id);
                }),
            TD::make('')
                ->width(60)
                ->render(function (VacationApplicationDocument $document) {
                    return Button::make('Удалить')
                        ->method('remove', ['document' => $document]);
                }),
        ];
    }
}
