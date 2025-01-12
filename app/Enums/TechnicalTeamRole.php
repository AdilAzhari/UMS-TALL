<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TechnicalTeamRole: string implements HasLabel
{
    case SUPPORT = 'Support';
    case ADMIN = 'Admin';
    case MANAGER = 'Manager';
    case SUPER_ADMIN = 'Super Admin';

    public static function values(): array
    {
        return [
            self::SUPPORT,
            self::ADMIN,
            self::MANAGER,
            self::SUPER_ADMIN,
        ];
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SUPPORT => __('Support'),
            self::ADMIN => __('Admin'),
            self::MANAGER => __('Manager'),
            self::SUPER_ADMIN => __('Super Admin'),
        };
    }
}
