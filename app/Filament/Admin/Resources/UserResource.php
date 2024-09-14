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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Users';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Personal Information Section
            Forms\Components\Section::make('Personal Information')
                ->description('Enter your personal information')
                ->schema([
                    Forms\Components\TextInput::make('first_name')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('middle_name')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('last_name')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('date_of_birth')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('nationality')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('marital_status'),
                ])->columns(3),
        
            // Contact Information Section
            Forms\Components\Section::make('Contact Information')
                ->description('Provide your contact details')
                ->schema([
                    Forms\Components\TextInput::make('primary_email_address')
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
                ])->columns(3),
        
            // Account Information Section
            Forms\Components\Section::make('Account Information')
                ->description('Manage account details')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DateTimePicker::make('email_verified_at'),
                    Forms\Components\TextInput::make('avatar')
                        ->maxLength(255)
                        ->default(null),
                ])->columns(2),
        
            // Role and Permissions Section
            Forms\Components\Section::make('Role & Permissions')
                ->description('Manage user roles and permissions')
                ->schema([
                    Forms\Components\TextInput::make('role')
                        ->required(),
                    Forms\Components\Toggle::make('is_admin')
                        ->required(),
                    Forms\Components\Toggle::make('is_active')
                        ->required(),
                ])->columns(2),
        
            // Metadata Section
            Forms\Components\Section::make('Metadata')
                ->description('System-generated information')
                ->schema([
                    Forms\Components\TextInput::make('created_by')
                        ->numeric()
                        ->default(null),
                    Forms\Components\TextInput::make('updated_by')
                        ->numeric()
                        ->default(null),
                ])->columns(2),
        ])->columns(3);
        
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
                Tables\Columns\TextColumn::make('primary_email_addres')
                    ->searchable(),
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
