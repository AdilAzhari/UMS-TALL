<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AssignmentStatus: string implements HasLabel
{
    case PENDING = 'Pending';
    //    case ACCEPTED = 'Accepted';
    case COMPLETED = 'Completed';
    case OVERDUE = 'Overdue';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => __('Pending'),
            self::COMPLETED => __('Completed'),
            self::OVERDUE => __('Overdue'),
        };
    }
}
