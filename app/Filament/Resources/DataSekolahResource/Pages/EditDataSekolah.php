<?php

namespace App\Filament\Resources\DataSekolahResource\Pages;

use App\Filament\Resources\DataSekolahResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataSekolah extends EditRecord
{
    protected static string $resource = DataSekolahResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
