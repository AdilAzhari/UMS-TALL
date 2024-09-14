<?php

namespace App\Filament\Admin\Resources\ClasseResource\Pages;

use App\Filament\Admin\Resources\ClasseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClasse extends EditRecord
{
    protected static string $resource = ClasseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
