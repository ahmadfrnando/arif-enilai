<?php

namespace App\Filament\Resources\NilaiPengetahuanResource\Pages;

use App\Filament\Resources\NilaiPengetahuanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNilaiPengetahuans extends ListRecords
{
    protected static string $resource = NilaiPengetahuanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
