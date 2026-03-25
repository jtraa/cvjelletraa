<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationResource\Pages;
use App\Models\Education;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Tables\Columns\TextColumn::make('deleted_at')->label('Verwijderd op')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                RestoreAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    RestoreBulkAction::make(),
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScope(SoftDeletingScope::class);
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
