<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TeacherResource\Pages;
use App\Filament\Admin\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Users';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Professional Information')
                ->description('Enter professional and employment details')
                ->schema([
                    Forms\Components\TextInput::make('qualification')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('experience')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('specialization')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\select::make('department_id')
                        ->relationship('department', 'code')
                        ->required(),
                    Forms\Components\TextInput::make('designation')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('hire_date')
                        ->required(),
                    Forms\Components\select::make('user_id')
                        ->relationship('user', 'name')
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('qualification')
                    ->searchable(),
                Tables\Columns\TextColumn::make('experience')
                    ->searchable(),
                Tables\Columns\TextColumn::make('specialization')
                    ->searchable(),
                Tables\Columns\TextColumn::make('department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('designation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hire_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department_id')
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
