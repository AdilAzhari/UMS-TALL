<?php

namespace App\Filament\Admin\Resources\QuizzeResource\Pages;

use App\Filament\Admin\Resources\QuizzeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuizze extends EditRecord
{
    protected static string $resource = QuizzeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
