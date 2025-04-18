<?php

namespace App\Filament\Resources\PelaksanaanSemesterResource\Pages;

use App\Filament\Resources\PelaksanaanSemesterResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePelaksanaanSemesters extends ManageRecords
{
    protected static string $resource = PelaksanaanSemesterResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
