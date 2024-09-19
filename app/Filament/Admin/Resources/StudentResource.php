<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DepartmentResource\RelationManagers\StudentsRelationManager;
use App\Filament\Admin\Resources\StudentResource\Pages;
use App\Filament\Admin\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Users';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                ->description('Enter your personal information')
                ->schema([
                    Forms\Components\DatePicker::make('enrollment_date')
                        ->required(),
                    Forms\Components\TextInput::make('current_year')
                        ->required()
                        ->numeric(),
                    Forms\Components\Select::make('user_id')
                        ->relationship('user', 'name')
                        // ->searchable()
                        ->required(),
                ])->columns(2),
                Forms\Components\Section::make('Academic Information')
                ->description('Enter your academic information')
                ->schema([
                    Forms\Components\Select::make('current_term_id')
                        ->label('Term')
                        ->relationship('currentTerm', 'name'),
                    Forms\Components\Select::make('program_id')
                        ->label('Program')
                        ->relationship('program', 'program_name'),
                    Forms\Components\Select::make('department_id')
                        ->label('Department')
                        ->relationship('department', 'name'),
                    Forms\Components\Select::make('status')
                        ->options([
                            'Active', 'Inactive'
                        ]),
                ])->columns(4),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('enrollment_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_term_id')
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
            StudentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
