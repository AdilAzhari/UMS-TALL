<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ExamResource\Pages;
use App\Filament\Admin\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use App\Models\Teacher;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
                Forms\Components\TextInput::make('exam_code')
                    ->required(),
                Forms\Components\RichEditor::make('exam_description')
                    ->label('Exam Description')
                    ->placeholder('Enter the description of the exam')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('exam_rules')
                    ->label('Exam Rules')
                    ->placeholder('Enter the rules of the exam')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\select::make('exam_passing_score')
                    ->required()
                    ->default('60%')
                    ->options([
                        '50' => '50%',
                        '55' => '55%',
                        '60' => '60%',
                        '65' => '65%',
                        '70' => '70%',
                    ]),
                Forms\Components\select::make('exam_duration')
                    ->required()
                    ->label('Exam Duration')
                    ->placeholder('Choce the duration of the exam')
                    ->options([
                        'one Houre' => '1/hr',
                        'one and half' => '1.5/hr',
                        'two Houre' => '2/hr',

                    ]),
                Forms\Components\select::make('class_id')
                    ->label('Select The Class')
                    ->relationship('class', 'group_number')
                    ->required(),
                Forms\Components\select::make('teacher_id')
                    ->label('Select The Teacher')
                    ->searchable()
                    ->options(function () {
                        return User::whereHas('teacher')
                            ->get()
                            ->pluck('name', 'id');
                    })
                    ->getSearchResultsUsing(function (string $search) {
                        return User::whereHas('teacher')
                            ->where('name', 'like', "%{$search}%")
                            ->limit(50)
                            ->pluck('name', 'id');
                    })
                    ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $teacherId = Teacher::where('user_id', $state)->value('id');
                        $set('teacher_id', $teacherId);
                    }),
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

        return $form;
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
                Tables\Columns\TextColumn::make('class.group_number')
                    ->label('Class')
                    ->sortable(['classes.group_number'])
                    ->searchable(),
                Tables\Columns\TextColumn::make('teacher.user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.code')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updatedBy.name')
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
            'class' => RelationManagers\ClassRelationManager::class,
            'course' => RelationManagers\CourseRelationManager::class,
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
