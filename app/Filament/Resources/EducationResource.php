<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationResource\Pages;
use App\Models\Education;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class EducationResource extends Resource
{
    protected static ?string $model = Education::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Educatie';
    protected static string|\UnitEnum|null $navigationGroup = 'CV';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title_nl')->label('Titel (NL)')->required(),
            TextInput::make('title_en')->label('Title (EN)')->required(),
            TextInput::make('institution')->label('Instelling / School')->required(),
            TextInput::make('period')->label('Periode')->required(),
            Textarea::make('learned_nl')->label('Geleerd (NL)')->rows(3)->columnSpanFull(),
            Textarea::make('learned_en')->label('Learned (EN)')->rows(3)->columnSpanFull(),
            TextInput::make('sort_order')->label('Volgorde')->numeric()->default(0),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->label('#')->sortable(),
                Tables\Columns\TextColumn::make('title_nl')->label('Opleiding'),
                Tables\Columns\TextColumn::make('institution')->label('School'),
                Tables\Columns\TextColumn::make('period')->label('Periode'),
            ])
            ->defaultSort('sort_order')
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListEducation::route('/'),
            'create' => Pages\CreateEducation::route('/create'),
            'edit'   => Pages\EditEducation::route('/{record}/edit'),
        ];
    }
}
