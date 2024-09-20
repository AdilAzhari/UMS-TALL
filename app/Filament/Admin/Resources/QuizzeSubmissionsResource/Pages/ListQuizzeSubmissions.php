<?php

namespace App\Filament\Admin\Resources\QuizzeSubmissionsResource\Pages;

use App\Filament\Admin\Resources\QuizzeSubmissionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuizzeSubmissions extends ListRecords
{
    protected static string $resource = QuizzeSubmissionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
