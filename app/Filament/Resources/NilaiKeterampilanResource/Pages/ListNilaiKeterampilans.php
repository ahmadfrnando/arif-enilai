<?php

namespace App\Filament\Resources\NilaiKeterampilanResource\Pages;

use App\Filament\Resources\NilaiKeterampilanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNilaiKeterampilans extends ListRecords
{
    protected static string $resource = NilaiKeterampilanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
