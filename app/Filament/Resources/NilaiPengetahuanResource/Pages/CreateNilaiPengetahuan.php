<?php

namespace App\Filament\Resources\NilaiPengetahuanResource\Pages;

use App\Filament\Resources\NilaiPengetahuanResource;
use App\Models\Guru;
use App\Models\NilaiKeterampilan;
use App\Models\NilaiPengetahuan;
use App\Models\Siswa;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNilaiPengetahuan extends CreateRecord
{
    protected static string $resource = NilaiPengetahuanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // $data['id_guru'] = auth()->id();
        $data['id_kelas'] = Siswa::where('id', $data['id_siswa'])->value('id_kelas_sekarang');
        $data['semester'] = Siswa::where('id', $data['id_siswa'])->value('semester_sekarang');
        $data['id_mapel'] = Guru::where('id', $data['id_guru'])->value('id_mapel');

        NilaiPengetahuan::where([
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
