<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-code-bracket';
    protected static ?string $navigationLabel = 'Vaardigheden';
    protected static string|\UnitEnum|null $navigationGroup = 'CV';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('category_nl')->label('Categorie (NL)')->required(),
            TextInput::make('category_en')->label('Category (EN)')->required(),
            TextInput::make('items')
                ->label('Items (scheiden met |)')
                ->helperText('Bijv: PHP | Laravel | Vue')
                ->required()
                ->columnSpanFull(),
            TextInput::make('sort_order')->label('Volgorde')->numeric()->default(0),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->label('#')->sortable(),
                Tables\Columns\TextColumn::make('category_nl')->label('Categorie'),
                Tables\Columns\TextColumn::make('items')->label('Items')->limit(50),
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
            'index'  => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit'   => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
