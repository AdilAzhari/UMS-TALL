<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TechnicalTeamStatus: string implements HasLabel
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';

    public static function values(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
        ];
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ACTIVE => __('Active'),
            self::INACTIVE => __('Inactive'),
        };
    }
}