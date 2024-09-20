<?php

namespace App\Filament\Admin\Resources\QuizzeQuestionOptionResource\Pages;

use App\Filament\Admin\Resources\QuizzeQuestionOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuizzeQuestionOptions extends ListRecords
{
    protected static string $resource = QuizzeQuestionOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
