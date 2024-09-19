<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CourseResource\Pages;
use App\Filament\Admin\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Academic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('course_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('course_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('course_description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('course_credit')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('course_syllabus')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('course_image')
                    ->image()
                    ->required(),
                Forms\Components\Toggle::make('course_status')
                    ->required(),
                Forms\Components\TextInput::make('teacher_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('program_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('requires_proctor')
                    ->required(),
                Forms\Components\Toggle::make('is_paid')
                    ->required(),
                Forms\Components\TextInput::make('cost')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('course_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('course_credit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('course_syllabus')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('course_image'),
                Tables\Columns\IconColumn::make('course_status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('teacher_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('program_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('requires_proctor')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_paid')
                    ->boolean(),
                Tables\Columns\TextColumn::make('cost')
                    ->money()
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
