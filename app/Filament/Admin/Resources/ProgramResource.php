<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationGroup = 'Academic Structure';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('program_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('duration_years')
                    ->required()
                    ->numeric(),
                Forms\Components\select::make('department_id')
                    ->required()
                    ->relationship('department', 'name'),
                Forms\Components\TextInput::make('program_name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Radio::make('program_status')
                    ->options([
                        'Graduated' => 'Graduated',
                        'Enrolled' => 'Enrolled',
                        'Suspended' => 'Suspended',
                        'Expelled' => 'Expelled',
                    ])
                    ->required(),
                Forms\Components\select::make('program_type')
                    ->options([
                        'Undergraduate' => 'Undergraduate',
                        'Postgraduate' => 'Postgraduate',
                        'Diploma' => 'Diploma',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('program_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration_years')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('program_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('program_status'),
                Tables\Columns\TextColumn::make('program_type'),
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
