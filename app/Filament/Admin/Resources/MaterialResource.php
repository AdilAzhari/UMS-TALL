<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MaterialResource\Pages;
use App\Filament\Admin\Resources\MaterialResource\RelationManagers;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Learning Resources';
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Section: Basic Information
            Forms\Components\Section::make('Basic Information')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Course Title')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\RichEditor::make('description')
                        ->label('Course Description')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\Select::make('course_id')
                        ->label('Course ID')
                        ->required()
                        ->relationship('course', 'name'),
                    Forms\Components\radio::make('type')
                        ->inline()
                        ->label('Course Type')
                        ->options([
                            'video' => 'Video',
                            'audio' => 'Audio',
                            'pdf' => 'PDF',
                            'doc' => 'DOC',
                            'ppt' => 'PPT',
                            'zip' => 'ZIP',
                            'none' => 'none',
                        ])
                        ->default('none'),
                ]),
            // Section: Media/Files
            Forms\Components\Section::make('Media/Files')
                ->schema([
                    Forms\Components\TextInput::make('thumbnail')
                        ->label('Thumbnail')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('size')
                        ->label('Size')
                        ->placeholder('Size in bytes')
                        ->maxLength(255)
                        ->default(null)
                        ->numeric()
                        ->default(0),
                    Forms\Components\TextInput::make('path')
                        ->label('Path')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('url')
                        ->label('Url')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('filename')
                        ->label('Filename')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('original_filename')
                        ->label('Original Filename')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('disk')
                        ->label('Storage Disk')
                        ->maxLength(255)
                        ->default(null),
                ]),

            // Section: Audit Information
            Forms\Components\Section::make('Audit Information')
                ->schema([
                    Forms\Components\Select::make('created_by')
                        ->label('Created By')
                        ->required()
                        ->relationship('createdBy', 'name')
                        ->default(function () {
                            if (Auth::check() && Auth::user()->created_by === null) {
                                return Auth::id();
                            }
                        })->disabled(),
                    Forms\Components\select::make('updated_by')
                        ->label('Updated By')
                        ->required()
                        ->relationship('updatedBy', 'name')
                        ->default(function () {
                                return Auth::user()->id;
                        })
                        ->disabled(),
                ])->columns(2),
        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course_id')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('size')
                    ->searchable(),
                Tables\Columns\TextColumn::make('path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('filename')
                    ->searchable(),
                Tables\Columns\TextColumn::make('original_filename')
                    ->searchable(),
                Tables\Columns\TextColumn::make('disk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
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
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}
