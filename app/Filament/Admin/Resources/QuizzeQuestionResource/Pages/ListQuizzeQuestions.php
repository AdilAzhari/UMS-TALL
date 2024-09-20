<?php

namespace App\Filament\Admin\Resources\QuizzeQuestionResource\Pages;

use App\Filament\Admin\Resources\QuizzeQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuizzeQuestions extends ListRecords
{
    protected static string $resource = QuizzeQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
