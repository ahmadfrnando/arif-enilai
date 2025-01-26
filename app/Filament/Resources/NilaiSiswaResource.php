<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NilaiSiswaResource\Pages;
use App\Filament\Resources\NilaiSiswaResource\RelationManagers;
use App\Models\Guru;
use App\Models\NilaiSiswa;
use App\Models\RefKelas;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NilaiSiswaResource extends Resource
{
    protected static ?string $model = NilaiSiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_siswa')
                    ->label('Pilih Siswa')
                    ->searchable()
                    ->options(Siswa::all()->pluck('nama_siswa', 'id'))
                    ->required(),
                Select::make('id_guru')
                    ->label('Pilih Guru')
                    ->searchable()
                    ->options(Guru::join('ref_mapel', 'guru.id_mapel', '=', 'ref_mapel.id')
                        ->selectRaw("CONCAT(guru.nama_guru, ' - ', ref_mapel.nama_mapel) as label, guru.id as value")
                        ->get()
                        ->pluck('label', 'value'))
                    ->required(),
                TextInput::make('nilai_pengetahuan')
                    ->numeric()
                    ->required(),
                TextInput::make('nilai_keetrampilan')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')->rowIndex(),
                Tables\Columns\TextColumn::make('siswa.nama_siswa')->label('Siswa')->searchable(),
                Tables\Columns\TextColumn::make('mapel.nama_mapel')->label('Mata Pelajaran')->searchable(),
                Tables\Columns\TextColumn::make('kelas.nama_kelas')->label('Kelas')->searchable(),
                Tables\Columns\TextColumn::make('semester_id')->label('Semester')->searchable(),
                Tables\Columns\TextColumn::make('nilai_pengetahuan')->label('Nilai Pengetahuan')->searchable(),
                Tables\Columns\TextColumn::make('predikat_pengetahuan')->label('Predikat')->searchable(),
                Tables\Columns\TextColumn::make('nilai_keterampilan')->label('Nilai Keterampilan')->searchable(),
                Tables\Columns\TextColumn::make('predikat_keterampilan')->label('Predikat')->searchable(),
                Tables\Columns\TextColumn::make('guru.nama_guru')->label('Guru')->searchable(),
                Tables\Columns\TextColumn::make('status.nama_status_lulus')->label('Status')->searchable(),
            ])
            ->filters([
                SelectFilter::make('id_kelas')->label('Pilih Kelas')
                    ->options(RefKelas::all()->pluck('nama_kelas', 'id')),
                SelectFilter::make('semester_id')->label('Pilih Semester')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\ViewAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNilaiSiswas::route('/'),
            'create' => Pages\CreateNilaiSiswa::route('/create'),
            'edit' => Pages\EditNilaiSiswa::route('/{record}/edit'),
        ];
    }
}
