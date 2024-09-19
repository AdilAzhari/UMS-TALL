<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Users';
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Basic Information')
                ->description('Enter basic user information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('First Name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('middle_name')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('last_name')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('Preferred_name')
                        ->label('Preferred Name (Nickname) Optional')
                        ->maxLength(255)
                        ->default(null),
                ])->columns(2),

            Forms\Components\Section::make('Contact Information')
                ->description('Enter user contact details')
                ->schema([
                    Forms\Components\TextInput::make('email')
                        ->label('Primary Email Address')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('secondary_email_address')
                        ->email()
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('phone_number')
                        ->tel()
                        ->maxLength(255)
                        ->default(null),
                ])->columns(2),

            Forms\Components\Section::make('Security')
                ->description('Set user password')
                ->schema([
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->required()
                        ->maxLength(255),
                ])->columns(1),

            Forms\Components\Section::make('Personal Details')
                ->description('Enter additional personal information')
                ->schema([
                    Forms\Components\select::make('gender')
                        ->options([
                            'male',
                            'female',
                        ])
                        ->required(),
                    Forms\Components\DatePicker::make('date_of_birth')
                        ->default(null),
                    Forms\Components\TextInput::make('nationality')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\select::make('marital_status')
                        ->options([
                            'single',
                            'married',
                            'divorced',
                            'widowed',
                        ])->default('single'),
                ])->columns(2),

            Forms\Components\Section::make('Address Information')
                ->description('Enter user address details')
                ->schema([
                    Forms\Components\TextInput::make('city_of_residence')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('state')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('zip_code')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('country_of_residence')
                        ->maxLength(255)
                        ->default(null),
                ])->columns(2),

            Forms\Components\Section::make('Account Settings')
                ->description('Configure user account settings')
                ->schema([
                    Forms\Components\select::make('role')
                        ->options([
                            'student',
                            'teacher',
                            'admin',
                            'technical_team',
                        ])
                        ->required(),
                    Forms\Components\Toggle::make('is_active')
                        ->required(),
                    Forms\Components\fileupload::make('avatar')
                        ->label('Profile Picture')
                        ->image()
                        ->disk('public')
                        ->default(null),
                ])->columns(2),

            Forms\Components\Section::make('System Information')
                ->description('System-managed fields')
                ->schema([
                    Forms\Components\TextInput::make('created_by')
                        ->numeric()
                        ->default(null),
                    Forms\Components\TextInput::make('updated_by')
                        ->numeric()
                        ->default(null),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Preferred_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city_of_residence')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('avatar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nationality')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country_of_residence')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marital_status'),
                Tables\Columns\TextColumn::make('secondary_email_address')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_admin')
                    ->boolean(),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
