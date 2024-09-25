<?php

namespace App\Filament\Admin\Resources\QuizzeSubmissionResource\Pages;

use App\Filament\Admin\Resources\QuizzeSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuizzeSubmissions extends ListRecords
{
    protected static string $resource = QuizzeSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
