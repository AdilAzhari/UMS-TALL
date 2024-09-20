<?php

namespace App\Filament\Admin\Resources\QuizzeResource\Pages;

use App\Filament\Admin\Resources\QuizzeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuizzes extends ListRecords
{
    protected static string $resource = QuizzeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
