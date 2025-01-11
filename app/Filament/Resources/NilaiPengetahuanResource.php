<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NilaiPengetahuanResource\Pages;
use App\Filament\Resources\NilaiPengetahuanResource\RelationManagers;
use App\Models\Guru;
use App\Models\NilaiPengetahuan;
use App\Models\RefKelas;
use App\Models\RefMapel;
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

class NilaiPengetahuanResource extends Resource
{
    protected static ?string $model = NilaiPengetahuan::class;

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
                Tables\Columns\TextColumn::make('semester')->label('Semester')->searchable(),
                Tables\Columns\TextColumn::make('nilai_pengetahuan')->label('Nilai Pengetahuan')->searchable(),
                Tables\Columns\TextColumn::make('predikat')->label('Predikat')->searchable(),
                Tables\Columns\TextColumn::make('guru.nama_guru')->label('Guru')->searchable(),
            ])
            ->filters([
                SelectFilter::make('id_kelas')->label('Pilih Kelas')
                    ->options(RefKelas::all()->pluck('nama_kelas', 'id')),
                SelectFilter::make('semester')->label('Pilih Semester')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNilaiPengetahuans::route('/'),
            'create' => Pages\CreateNilaiPengetahuan::route('/create'),
            'edit' => Pages\EditNilaiPengetahuan::route('/{record}/edit'),
        ];
    }
}
