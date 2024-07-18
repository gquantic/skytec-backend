<?php

namespace App\Orchid\Fields;

use Orchid\Screen\Field;

/**
 * @method id(string $id)
 * @method title(string $title)
 * @method help(string $help)
 */
class CkeEditor extends Field
{
    /**
     * Blade template
     *
     * @var string
     */
    protected $view = 'admin.fields.cke-editor';

    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [
        'id' => 'cke-editor',
        'value' => '',
        'name' => '',
        'title' => '',
        'help' => '',
    ];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [];
}
