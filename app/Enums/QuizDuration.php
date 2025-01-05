<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Quizduration: string implements HasLabel
{
    case FIVE = '5';
    case TEN = '10';
    case FIFTEEN = '15';
    case TWENTY = '20';
    case TWENTY_FIVE = '25';
    case THIRTY = '30';
    case THIRTY_FIVE = '35';
    case FORTY = '40';
    case FORTY_FIVE = '45';
    case FIFTY = '50';
    case FIFTY_FIVE = '55';
    case SIXTY = '60';
    public function getLabel(): ?string
    {
        return match ($this) {
            self::FIVE => '5 minutes',
            self::TEN => '10 minutes',
            self::FIFTEEN => '15 minutes',
            self::TWENTY => '20 minutes',
            self::TWENTY_FIVE => '25 minutes',
            self::THIRTY => '30 minutes',
            self::THIRTY_FIVE => '35 minutes',
            self::FORTY => '40 minutes',
            self::FORTY_FIVE => '45 minutes',
            self::FIFTY => '50 minutes',
            self::FIFTY_FIVE => '55 minutes',
            self::SIXTY => '60 minutes',
        };
    }
}
