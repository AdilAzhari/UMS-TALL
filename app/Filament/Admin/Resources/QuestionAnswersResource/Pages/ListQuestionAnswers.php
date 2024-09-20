<?php

namespace App\Filament\Admin\Resources\QuestionAnswersResource\Pages;

use App\Filament\Admin\Resources\QuestionAnswersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionAnswers extends ListRecords
{
    protected static string $resource = QuestionAnswersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
