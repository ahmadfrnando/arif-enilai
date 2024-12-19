<?php

namespace App\Filament\Resources\WaliKelasResource\Pages;

use App\Filament\Resources\WaliKelasResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWaliKelas extends CreateRecord
{
    protected static string $resource = WaliKelasResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
