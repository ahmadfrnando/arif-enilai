<?php

namespace App\Filament\Resources\DataSekolahResource\Pages;

use App\Filament\Resources\DataSekolahResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataSekolah extends CreateRecord
{
    protected static string $resource = DataSekolahResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
