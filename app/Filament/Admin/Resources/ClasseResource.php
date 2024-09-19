<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ClasseResource\Pages;
use App\Filament\Admin\Resources\ClasseResource\RelationManagers;
use App\Models\Classe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClasseResource extends Resource
{
    protected static ?string $model = Classe::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Academic';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('group_number')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('year')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('max_students')
                    ->required()
                    ->numeric()
                    ->default(30),
                Forms\Components\TextInput::make('current_students')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('course_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('teacher_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('term_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('group_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_students')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_students')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('course_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('term_id')
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
            'index' => Pages\ListClasses::route('/'),
            'create' => Pages\CreateClasse::route('/create'),
            'edit' => Pages\EditClasse::route('/{record}/edit'),
        ];
    }
}
