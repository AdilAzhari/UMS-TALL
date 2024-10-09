<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AcademicProgressResource\Pages;
use App\Filament\Admin\Resources\AcademicProgressResource\RelationManagers;
use App\Models\AcademicProgress;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AcademicProgressResource extends Resource
{
    protected static ?string $model = AcademicProgress::class;
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Academic Structure';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Student')
                    ->options(Student::query()->pluck('id', 'id')->toArray())
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $search) => Student::where('id', 'like', "%{$search}%")->limit(50)->pluck('id', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => Student::find($value)?->user->name ?? null)
                    ->required(),
                Forms\Components\TextInput::make('major_courses_total')
                    ->required()
                    ->numeric()
                    ->default(40),
                Forms\Components\TextInput::make('major_courses_completed')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('general_courses_total')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('general_courses_completed')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('elective_courses_total')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('elective_courses_completed')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.user.name')
                    ->label('Student Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('major_courses_total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('major_courses_completed')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('general_courses_total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('general_courses_completed')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('elective_courses_total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('elective_courses_completed')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAcademicProgress::route('/'),
            'create' => Pages\CreateAcademicProgress::route('/create'),
            'edit' => Pages\EditAcademicProgress::route('/{record}/edit'),
        ];
    }
}
