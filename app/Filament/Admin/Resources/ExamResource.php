<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ExamResource\Pages;
use App\Filament\Admin\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;
    protected static ?string $navigationGroup = 'Academic';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('exam_date')
                    ->required(),
                Forms\Components\TextInput::make('exam_description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('exam_duration')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('exam_rules')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('exam_passing_score')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('exam_questions')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('exam_answers')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('class_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('teacher_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('created_by')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('updated_by')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('exam_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exam_description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_duration')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_rules')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_passing_score')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_questions')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_answers')
                    ->searchable(),
                Tables\Columns\TextColumn::make('class_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
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
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
}
