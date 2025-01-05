<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\QuizzeQuestionResource\Pages;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuizQuestionResource extends Resource
{
    protected static ?string $model = QuizQuestion::class;
    protected static ?string $navigationLabel = "Quizzes";

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationGroup = 'Assessment & Grading';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('quiz_id')
                    ->label('Quiz')
                    ->relationship('quiz', 'id')
                    ->searchable()
                ->options(Quiz::pluck('title')),
                Forms\Components\Select::make('created_by')
                    ->relationship('createdBy', 'name')
                    ->required(),
                Forms\Components\Select::make('updated_by')
                    ->label('Updated By')
                    ->relationship('updatedBy', 'name')
                    ->required(),
                Forms\Components\Textarea::make('question')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quiz.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updatedBy.name')
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
            'index' => Pages\ListQuizzeQuestions::route('/'),
            'create' => Pages\CreateQuizzeQuestion::route('/create'),
            'edit' => Pages\EditQuizzeQuestion::route('/{record}/edit'),
        ];
    }
}
