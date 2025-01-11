<?php

namespace App\Filament\Resources\SiswaLulusMapelResource\Pages;

use App\Filament\Resources\SiswaLulusMapelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiswaLulusMapel extends EditRecord
{
    protected static string $resource = SiswaLulusMapelResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
