<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ExamResource\Pages;
use App\Filament\Admin\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Assessment & Grading';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('exam_date')
                    ->required(),
                Forms\Components\RichEditor::make('exam_description')
                    ->label('Exam Description')
                    ->placeholder('Enter the description of the exam')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('exam_duration')
                    ->required()
                    ->label('Exam Duration')
                    ->placeholder('Enter the duration of the exam'),
                Forms\Components\TextInput::make('exam_rules')
                    ->label('Exam Rules')
                    ->placeholder('Enter the rules of the exam')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('exam_passing_score')
                    ->required()
                    ->default('60%')
                    ->maxLength(255),
                Forms\Components\TextInput::make('exam_questions')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('exam_answers')
                    ->required()
                    ->maxLength(255),
                Forms\Components\select::make('class_id')
                    ->label('Select The Class')
                    ->relationship('class', 'group_number')
                    ->required(),
                Forms\Components\select::make('teacher_id')
                    ->required()
                    ->label('Select The Teacher')
                    ->relationship('teacher', 'user_id',
                    function ($query) {
                            return $query->with('user')->where('id', 'user_id');
                        }
                    ),
                Forms\Components\select::make('course_id')
                    ->label('Select The Course')
                    ->required()
                    ->relationship('course', 'name'),
                Forms\Components\select::make('created_by')
                    ->relationship('createdBy', 'name')
                    ->default(function () {
                        if (Auth::check() && Auth::user()->created_by === null) {
                            return Auth::id();
                        }
                    })->disabled(),
                Forms\Components\select::make('updated_by')
                    ->relationship('updatedBy', 'name')
                    ->default(Auth::id())->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('exam_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exam_description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_duration')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_rules')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_passing_score')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_questions')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_answers')
                    ->searchable(),
                Tables\Columns\TextColumn::make('class_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('course_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
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
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
}
