<?php

namespace App\Filament\Resources\NilaiPengetahuanResource\Pages;

use App\Filament\Resources\NilaiPengetahuanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNilaiPengetahuan extends EditRecord
{
    protected static string $resource = NilaiPengetahuanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
