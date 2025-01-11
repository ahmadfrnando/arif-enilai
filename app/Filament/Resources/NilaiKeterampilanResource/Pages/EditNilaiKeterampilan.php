<?php

namespace App\Filament\Resources\NilaiKeterampilanResource\Pages;

use App\Filament\Resources\NilaiKeterampilanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNilaiKeterampilan extends EditRecord
{
    protected static string $resource = NilaiKeterampilanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
