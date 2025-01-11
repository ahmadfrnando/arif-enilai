<?php

namespace App\Filament\Resources\SiswaLulusSemesterResource\Pages;

use App\Filament\Resources\SiswaLulusSemesterResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiswaLulusSemesters extends ListRecords
{
    protected static string $resource = SiswaLulusSemesterResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
