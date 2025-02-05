<?php

namespace App\Filament\Admin\Resources\QuizQuestionResource\Pages;

use App\Filament\Admin\Resources\QuizQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuizQuestion extends EditRecord
{
    protected static string $resource = QuizQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
