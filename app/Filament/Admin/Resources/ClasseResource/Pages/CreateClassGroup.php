<?php

namespace App\Filament\Admin\Resources\ClasseResource\Pages;

use App\Filament\Admin\Resources\ClasseResource;
use App\Models\ClassGroup;
use Filament\Resources\Pages\CreateRecord;

class CreateClassGroup extends CreateRecord
{
    protected static string $resource = ClassGroup::class;
}
