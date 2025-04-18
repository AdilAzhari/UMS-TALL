<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum StudentStatus: string implements HasLabel
{
    case GRADUATED = 'Graduated';
    case ENROLLED = 'Enrolled';
    case SUSPENDED = 'Suspended';
    case EXPELLED = 'Expelled';

    public static function values(): array
    {
        return [
            self::GRADUATED,
            self::ENROLLED,
            self::SUSPENDED,
            self::EXPELLED,
        ];
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::GRADUATED => __('Graduated'),
            self::ENROLLED => __('Enrolled'),
            self::SUSPENDED => __('Suspended'),
            self::EXPELLED => __('Expelled'),
        };
    }
}
