<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkExperienceResource\Pages;
use App\Models\WorkExperience;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
<<<<<<< HEAD
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
=======
>>>>>>> fe2476398bbac801ffbe737fe9427605e10da3fa
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
<<<<<<< HEAD
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
=======
use Filament\Tables\Table;
>>>>>>> fe2476398bbac801ffbe737fe9427605e10da3fa

class WorkExperienceResource extends Resource
{
    protected static ?string $model = WorkExperience::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Werkervaring';
    protected static string|\UnitEnum|null $navigationGroup = 'CV';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('period')->label('Periode')->required()->columnSpanFull(),
            TextInput::make('company')->label('Bedrijf')->columnSpanFull(),
            Textarea::make('description_nl')->label('Omschrijving (NL)')->rows(5)->columnSpanFull(),
            Textarea::make('description_en')->label('Description (EN)')->rows(5)->columnSpanFull(),
            TextInput::make('url')->label('Website URL')->url(),
            TextInput::make('tech_stack')->label('Werkwijze / Tech stack'),
            TextInput::make('sort_order')->label('Volgorde')->numeric()->default(0),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->label('#')->sortable(),
                Tables\Columns\TextColumn::make('period')->label('Periode'),
                Tables\Columns\TextColumn::make('company')->label('Bedrijf'),
                Tables\Columns\TextColumn::make('tech_stack')->label('Tech')->limit(40),
<<<<<<< HEAD
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
=======
            ])
            ->defaultSort('sort_order')
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
>>>>>>> fe2476398bbac801ffbe737fe9427605e10da3fa
                ]),
            ]);
    }

<<<<<<< HEAD
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScope(SoftDeletingScope::class);
    }

=======
>>>>>>> fe2476398bbac801ffbe737fe9427605e10da3fa
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListWorkExperiences::route('/'),
            'create' => Pages\CreateWorkExperience::route('/create'),
            'edit'   => Pages\EditWorkExperience::route('/{record}/edit'),
        ];
    }
}
