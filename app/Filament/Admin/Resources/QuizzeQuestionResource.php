<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\QuizzeQuestionResource\Pages;
use App\Filament\Admin\Resources\QuizzeQuestionResource\RelationManagers;
use App\Models\QuizzeQuestion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizzeQuestionResource extends Resource
{
    protected static ?string $model = QuizzeQuestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Academic';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
