<?php

namespace App\Filament\Resources\NilaiKeterampilanResource\Pages;

use App\Filament\Resources\NilaiKeterampilanResource;
use App\Models\Guru;
use App\Models\NilaiKeterampilan;
use App\Models\Siswa;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNilaiKeterampilan extends CreateRecord
{
    protected static string $resource = NilaiKeterampilanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_kelas'] = Siswa::where('id', $data['id_siswa'])->value('id_kelas_sekarang');
        $data['semester'] = Siswa::where('id', $data['id_siswa'])->value('semester_sekarang');
        $data['id_mapel'] = Guru::where('id', $data['id_guru'])->value('id_mapel');

        NilaiKeterampilan::where([
            'id_siswa' => $data['id_siswa'],
            'id_mapel' => $data['id_mapel'],
            'id_kelas' => $data['id_kelas'],
            'semester' => $data['semester'],
        ])->delete();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
