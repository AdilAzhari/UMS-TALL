<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ExamResultResource\Pages;
use App\Filament\Admin\Resources\ExamResultResource\RelationManagers;
use App\Models\ExamResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExamResultResource extends Resource
{
    protected static ?string $model = ExamResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationGroup = 'Assessment & Grading';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('exam_id')
                    ->label('Select The Exam')
                    ->required()
                    ->relationship('exam', 'id'),
                Forms\Components\Select::make('student_id')
                    ->required()
                    ->relationship('student', 'user_id', function ($query) {
                        return $query->whereColumn('user_id', 'id');
                    }),
                Forms\Components\TextInput::make('score')
                    ->required()
                    ->numeric(),
                Forms\Components\Radio::make('status')
                    ->inline()
                    ->options([
                        'pass' => 'Pass',
                        'fail' => 'Fail',
                        'absent' => 'Absent',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('notes')
                    ->maxLength(255)
                    ->label('Notes')
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('exam.exam_date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('score')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('notes')
                    ->searchable(),
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
            'exam' => RelationManagers\ExamRelationManager::class,
            'student' => RelationManagers\StudentRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExamResults::route('/'),
            'create' => Pages\CreateExamResult::route('/create'),
            'edit' => Pages\EditExamResult::route('/{record}/edit'),
        ];
    }
}
