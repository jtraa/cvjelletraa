<?php

namespace App\Filament\Resources\CvSettingResource\Pages;

use App\Filament\Resources\CvSettingResource;
use App\Models\CvSetting;
use Filament\Resources\Pages\ListRecords;

class ListCvSettings extends ListRecords
{
    protected static string $resource = CvSettingResource::class;

    public function mount(): void
    {
        // Always redirect to the single record's edit page
        $record = CvSetting::instance();
        $this->redirect(CvSettingResource::getUrl('edit', ['record' => $record]));
    }
}
