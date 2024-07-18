<?php

namespace App\Services\Admin;

class FormInterfaceService
{
    public static function checkIcon(bool $value): string
    {
        if ($value)
            return '<i class="fa fa-check text-success"></i>';
        else
            return '<i class="fa fa-close text-danger"></i>';
    }

    public static function checkModeratedIcon(int $value): string
    {
        if ($value == 1)
            return '<i class="fa fa-check text-success"></i>';
        elseif ($value == 0)
            return '<i class="fa fa-warning text-warning"></i>';
        else
            return '<i class="fa fa-close text-danger"></i>';
    }
}
