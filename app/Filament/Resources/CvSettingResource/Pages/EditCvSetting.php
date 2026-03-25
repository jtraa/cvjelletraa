<?php

namespace App\Filament\Resources\CvSettingResource\Pages;

use App\Filament\Resources\CvSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCvSetting extends EditRecord
{
    protected static string $resource = CvSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view_cv')
                ->label('Bekijk CV')
                ->url('/')
                ->openUrlInNewTab()
                ->icon('heroicon-o-eye'),
        ];
    }
}
