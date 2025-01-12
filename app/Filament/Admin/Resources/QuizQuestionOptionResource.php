<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\QuizQuestionOptionResource\Pages;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizQuestionOptionResource extends Resource
{
    protected static ?string $model = QuizQuestionOption::class;

    protected static ?string $activeNavigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationGroup = 'Assessment & Grading';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('quiz_question_id')
                    ->relationship('quizQuestion', 'id')
                    ->required()
                    ->options(QuizQuestion::all()->pluck('question')),
                Forms\Components\TextInput::make('option')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_correct')
                    ->required(),
                Forms\Components\Hidden::make('created_by')
                    ->default(auth()->id())
                    ->disabledOn('edit'),
                Forms\Components\Hidden::make('updated_by')
                    ->default(auth()->id())
                    ->disabledOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quizQuestion.question')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('option')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_correct')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListQuizQuestionOptions::route('/'),
            'create' => Pages\CreateQuizQuestionOption::route('/create'),
            'edit' => Pages\EditQuizQuestionOption::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
