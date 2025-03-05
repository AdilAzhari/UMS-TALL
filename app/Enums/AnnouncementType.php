<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnnouncementType: string implements HasLabel
{
    case ANNOUNCEMENT = 'Announcement';
    case ASSESSMENT = 'Assessment';
    case QUIZ = 'Quiz';

    public static function values(): array
    {
        return [
            self::ANNOUNCEMENT,
            self::ASSESSMENT,
            self::QUIZ,
        ];
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ANNOUNCEMENT => __('Announcement'),
            self::ASSESSMENT => __('Assessment'),
            self::QUIZ => __('Quiz'),
        };
    }

    public function getValue(): ?string
    {
        return match ($this) {
            self::ANNOUNCEMENT => 'Announcement',
            self::ASSESSMENT => 'Assessment',
            self::QUIZ => 'Quiz',
        };
    }
}
