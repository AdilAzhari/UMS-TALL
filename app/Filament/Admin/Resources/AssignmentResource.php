<?php

namespace App\Filament\Admin\Resources;

use App\Enums\AssignmentStatus;
use App\Filament\Admin\Resources\AssignmentResource\Pages;
use App\Models\Assignment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AssignmentResource extends Resource
{
    protected static ?string $model = Assignment::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationGroup = 'Assignments & Submissions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Class Group Section
                Forms\Components\Section::make('Class Information')
                    ->schema([
                        Forms\Components\Select::make('class_group_id')
                            ->label('Class Group')
                            ->relationship('classGroup', 'group_number')
                            ->required(),
                    ])->columns(1),

                // Teacher Section
                Forms\Components\Section::make('Teacher Information')
                    ->schema([
                        Forms\Components\Select::make('teacher_id')
                            ->label('Teacher')
                            ->relationship('teacher.user', 'name')
                            ->required(),
                    ])->columns(1),

                // Course Section
                Forms\Components\Section::make('Course Information')
                    ->schema([
                        Forms\Components\Select::make('course_id')
                            ->label('Course')
                            ->relationship('course', 'name')
                            ->required(),
                    ])->columns(1),

                // Assignment Details Section
                Forms\Components\Section::make('Assignment Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('total_marks')
                            ->label('Total Marks')
                            ->required()
                            ->numeric(),
                        Forms\Components\DatePicker::make('deadline')
                            ->label('Deadline')
                            ->required(),
                        Forms\Components\FileUpload::make('file')
                            ->label('Attachment')
                            ->directory('assignments') // Store files in the 'assignments' directory
                            ->preserveFilenames()
                            ->downloadable(),
                    ])->columns(2),

                // Status Section
                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Radio::make('status')
                            ->label('Status')
                            ->options(AssignmentStatus::class)
                            ->default(AssignmentStatus::PENDING)
                            ->required(),
                    ])->columns(1),

                // System Information Section (Visible only in Edit Mode)
                Forms\Components\Section::make('System Information')
                    ->schema([
                        Forms\Components\TextInput::make('created_by')
                            ->label('Created By')
                            ->default(Auth::user()->id)
                            ->disabled()
                            ->visible(fn ($livewire) => $livewire instanceof Pages\EditAssignment),
                        Forms\Components\TextInput::make('updated_by')
                            ->label('Updated By')
                            ->default(Auth::id())
                            ->disabled()
                            ->visible(fn ($livewire) => $livewire instanceof Pages\EditAssignment),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('teacher.user.name')
                    ->label('Teacher')
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.name')
                    ->label('Course')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        AssignmentStatus::COMPLETED => 'warning',
                        AssignmentStatus::PENDING => 'success',
                        AssignmentStatus::OVERDUE => 'primary',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deadline')
                    ->label('Deadline')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('status')
                    ->options(AssignmentStatus::class)
                    ->label('Status'),
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
            // Add relations here if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssignments::route('/'),
            'create' => Pages\CreateAssignment::route('/create'),
            'edit' => Pages\EditAssignment::route('/{record}/edit'),
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
