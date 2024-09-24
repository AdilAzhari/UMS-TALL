<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\QuizzeSubmissionsResource\Pages;
use App\Filament\Admin\Resources\QuizzeSubmissionsResource\RelationManagers;
use App\Models\QuizzeSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizzeSubmissionsResource extends Resource
{
    protected static ?string $model = QuizzeSubmission::class;
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Assessment & Grading';
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
            'index' => Pages\ListQuizzeSubmissions::route('/'),
            'create' => Pages\CreateQuizzeSubmissions::route('/create'),
            'edit' => Pages\EditQuizzeSubmissions::route('/{record}/edit'),
        ];
    }
}
