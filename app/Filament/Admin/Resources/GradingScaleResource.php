<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GradingScaleResource\Pages;
use App\Filament\Admin\Resources\GradingScaleResource\RelationManagers;
use App\Models\GradingScale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GradingScaleResource extends Resource
{
    protected static ?string $model = GradingScale::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Academic';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('grade')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('min_score')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('max_score')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('gpa_point')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('grade')
                    ->searchable(),
                Tables\Columns\TextColumn::make('min_score')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_score')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gpa_point')
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
            'index' => Pages\ListGradingScales::route('/'),
            'create' => Pages\CreateGradingScale::route('/create'),
            'edit' => Pages\EditGradingScale::route('/{record}/edit'),
        ];
    }
}