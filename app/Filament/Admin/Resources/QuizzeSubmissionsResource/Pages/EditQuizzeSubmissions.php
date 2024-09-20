<?php

namespace App\Filament\Admin\Resources\QuizzeSubmissionsResource\Pages;

use App\Filament\Admin\Resources\QuizzeSubmissionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuizzeSubmissions extends EditRecord
{
    protected static string $resource = QuizzeSubmissionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
