<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CvSettingResource\Pages;
use App\Models\CvSetting;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class CvSettingResource extends Resource
{
    protected static ?string $model = CvSetting::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Persoonlijke info';
    protected static string|\UnitEnum|null $navigationGroup = 'CV';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Algemeen')->schema([
                TextInput::make('name')->label('Naam')->required(),
                TextInput::make('job_title_nl')->label('Functietitel (NL)')->required(),
                TextInput::make('job_title_en')->label('Job title (EN)')->required(),
                TextInput::make('dob')->label('Geboortedatum'),
                TextInput::make('address_line1')->label('Adres regel 1'),
                TextInput::make('address_line2')->label('Adres regel 2'),
                TextInput::make('availability')->label('Beschikbaar'),
                TextInput::make('email')->label('E-mail')->email(),
                TextInput::make('phone')->label('Telefoon'),
                TextInput::make('linkedin')->label('LinkedIn URL'),
                TextInput::make('github')->label('GitHub URL'),
                FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->directory('photos')
                    ->imagePreviewHeight('150'),
            ])->columns(2),

            Section::make('Profiel')->schema([
                Textarea::make('profile_nl')
                    ->label('Profiel (NL)')
                    ->rows(5)
                    ->columnSpanFull(),
                Textarea::make('profile_en')
                    ->label('Profile (EN)')
                    ->rows(5)
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Naam'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('phone')->label('Telefoon'),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCvSettings::route('/'),
            'create' => Pages\CreateCvSetting::route('/create'),
            'edit'   => Pages\EditCvSetting::route('/{record}/edit'),
        ];
    }
}
