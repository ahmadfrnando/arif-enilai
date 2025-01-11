<?php

namespace App\Filament\Resources\SiswaLulusMapelResource\Pages;

use App\Filament\Resources\SiswaLulusMapelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiswaLulusMapels extends ListRecords
{
    protected static string $resource = SiswaLulusMapelResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
