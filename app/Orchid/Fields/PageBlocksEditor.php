<?php

namespace App\Orchid\Fields;

use Orchid\Screen\Field;

/**
 * @method id(string $id)
 * @method title(string $title)
 * @method help(string $help)
 */
class PageBlocksEditor extends Field
{
    /**
     * Blade template
     *
     * @var string
     */
    protected $view = 'admin.fields.page.edit';

    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [
        'position' => 'center',
        'title' => 'Редактирование колонки',
        'help' => '',
    ];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [];
}
