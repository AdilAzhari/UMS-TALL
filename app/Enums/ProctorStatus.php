<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ProctorStatus: string implements HasLabel
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    /**
     * Get all the values of the enum.
     *
     * @return array
     */
    public static function values(): array
    {
        return [
            self::PENDING,
            self::APPROVED,
            self::REJECTED,
        ];
    }
    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => __('Proctor.Pending'),
            self::APPROVED => __('Proctor.Approved'),
            self::REJECTED => __('Proctor.Rejected'),
        };
    }
}
