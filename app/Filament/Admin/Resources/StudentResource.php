<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DepartmentResource\RelationManagers\StudentsRelationManager;
use App\Filament\Admin\Resources\StudentResource\Pages;
use App\Filament\Admin\Resources\StudentResource\RelationManagers;
use App\Filament\Admin\Resources\StudentResource\RelationManagers\AssignmentSubmissionsRelationManager;
use App\Filament\Admin\Resources\StudentResource\RelationManagers\CoursesRelationManager;
use App\Filament\Admin\Resources\StudentResource\RelationManagers\CurrentTermRelationManager;
use App\Filament\Admin\Resources\StudentResource\RelationManagers\DepartmentRelationManager;
use App\Filament\Admin\Resources\StudentResource\RelationManagers\EnrollmentsRelationManager;
use App\Filament\Admin\Resources\StudentResource\RelationManagers\ExamResultsRelationManager;
use App\Filament\Admin\Resources\StudentResource\RelationManagers\ProgramRelationManager;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'User Management';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                ->description('Enter your personal information')
                ->schema([
                    Forms\Components\DatePicker::make('enrollment_date')
                        ->required(),
                    Forms\Components\Select::make('user_id')
                        ->relationship('user', 'name')
                        // ->searchable()
                        ->required(),
                ])->columns(2),
                Forms\Components\Section::make('Academic Information')
                ->description('Enter your academic information')
                ->schema([
                    Forms\Components\Select::make('term_id')
                        ->label('Term')
                        ->relationship('currentTerm', 'name'),
                    Forms\Components\Select::make('program_id')
                        ->label('Program')
                        ->relationship('program', 'program_name'),
                    Forms\Components\Select::make('department_id')
                        ->label('Department')
                        ->relationship('department', 'name'),
                    Forms\Components\Select::make('status')
                        ->options([
                            'Active', 'Inactive'
                        ]),
                ])->columns(4),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('enrollment_date')
                    ->date()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department.code')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('currentTerm.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->searchable()
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
            AssignmentSubmissionsRelationManager::class,
            CoursesRelationManager::class,
            CurrentTermRelationManager::class,
            DepartmentRelationManager::class,
            EnrollmentsRelationManager::class,
            ExamResultsRelationManager::class,
            ProgramRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
    public function beforeCreate(){
        $data['student_id'] = $this->generateStudentId();
    }
    public function generateStudentId(){
        $student_id = 'STU';
        $year = date('Y');
        $student_id .= $year.'-'. rand(1000,9999);
        return $student_id;
    }
}
