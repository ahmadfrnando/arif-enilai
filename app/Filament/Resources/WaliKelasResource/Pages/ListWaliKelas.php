<?php

namespace App\Filament\Resources\WaliKelasResource\Pages;

use App\Filament\Resources\WaliKelasResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaliKelas extends ListRecords
{
    protected static string $resource = WaliKelasResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
