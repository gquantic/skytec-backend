<?php

namespace App\Orchid\Fields;

use Orchid\Screen\Field;

/**
 * @method id(string $id)
 * @method title(string $title)
 * @method help(string $help)
 */
class UploadFile extends Field
{
    /**
     * Blade template
     *
     * @var string
     */
    protected $view = 'admin.fields.upload-file';

    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [
        'title' => 'Загрузка файла',
        'help' => '',
        'value' => '',
    ];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [];
}
