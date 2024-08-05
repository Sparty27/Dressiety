<?php

namespace App\Enums;

enum MessageTypeEnum: string
{
    case INFORMATION = 'information';
    case WARNING = 'warning';
    case DANGER = 'danger';
    case SUCCESS = 'success';

    public function getPopupColor()
    {
        return trans("enums.popup_colors.$this->value");
    }
}
