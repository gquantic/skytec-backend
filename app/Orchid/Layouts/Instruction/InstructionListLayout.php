<?php

namespace App\Orchid\Layouts\Instruction;

use App\Models\Documents\Instruction;
use App\Models\Documents\VacationApplicationDocument;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class InstructionListLayout extends Table
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
                ->render(fn (Instruction $instruction) => $instruction->id),

            TD::make('title', 'Title')
                ->render(fn (Instruction $instruction) => $instruction->title),

            TD::make('attachment', 'File')
                ->render(function (Instruction $instruction) {
                    return Link::make('Перейти к файлу')
                        ->target('blank')
                        ->href($instruction->document);
                }),

            TD::make('')
                ->width(80)
                ->render(function (Instruction $instruction) {
                    return Link::make('Редактировать')
                        ->target('blank')
                        ->route('platform.instructions.edit', $instruction->id);
                }),
            TD::make('')
                ->width(60)
                ->render(function (Instruction $instruction) {
                    return Button::make('Удалить')
                        ->method('remove', ['document' => $instruction->id]);
                }),
        ];
    }
}
