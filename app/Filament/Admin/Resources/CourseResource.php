<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Academic Structure';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Basic Information')
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->required()
                                    ->maxLength(20)
                                    ->unique(ignoreRecord: true),
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('program_id')
                                    ->relationship('program', 'program_name')
                                    ->required()
                                    ->searchable(),
                                Forms\Components\TextInput::make('credit')
                                    ->required()
                                    ->numeric()
                                    ->default(3)
                                    ->minValue(0)
                                    ->maxValue(10),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Course Details')
                            ->schema([
                                Forms\Components\RichEditor::make('description')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('Course Materials')
                            ->schema([
                                Forms\Components\FileUpload::make('syllabus')
                                    ->image()
                                    ->maxSize(10240)
                                    ->directory('course-syllabi'),
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->maxSize(5120)
                                    ->directory('course-images'),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status & Settings')
                            ->schema([
                                Forms\Components\Toggle::make('status')
                                    ->label('Active')
                                    ->default(true)
                                    ->required(),
                                Forms\Components\Toggle::make('require_proctor')
                                    ->label('Requires Proctoring')
                                    ->default(false)
                                    ->required(),
                            ]),

                        Forms\Components\Section::make('Payment Information')
                            ->schema([
                                Forms\Components\Toggle::make('is_paid')
                                    ->label('Paid Course')
                                    ->default(false)
                                    ->required(),
                                Forms\Components\TextInput::make('cost')
                                    ->numeric()
                                    ->prefix('$')
                                    ->minValue(0)
                                    ->visible(fn (Forms\Get $get) => $get('is_paid')),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('program.program_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('credit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('require_proctor')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_paid')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cost')
                    ->money('usd')
                    ->sortable()
                    ->visible(fn (Builder $query) => $query->where('is_paid', true)->exists()),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('program')
                    ->relationship('program', 'program_name'),
                Tables\Filters\TernaryFilter::make('status'),
                Tables\Filters\TernaryFilter::make('is_paid')
                    ->label('Payment Required'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            // Add any necessary relations here
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

    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }
}
