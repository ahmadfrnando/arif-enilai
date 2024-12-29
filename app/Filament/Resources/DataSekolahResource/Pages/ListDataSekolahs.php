<?php

namespace App\Filament\Resources\DataSekolahResource\Pages;

use App\Filament\Resources\DataSekolahResource;
use App\Models\DataSekolah;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataSekolahs extends ListRecords
{
    protected static string $resource = DataSekolahResource::class;

    protected function getActions(): array
    {
        // Mengecek apakah data sekolah sudah ada
        $data_sekolah_exists = DataSekolah::exists();

        // Jika data sekolah belum ada, tambahkan CreateAction
        if (!$data_sekolah_exists) {
            return [
                Actions\CreateAction::make(),
            ];
        }

        // Jika data sekolah sudah ada, kembalikan array kosong (tidak ada aksi)
        return [];
    }
}
