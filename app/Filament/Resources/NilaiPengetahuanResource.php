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

    protected static ?string $navigationLabel = 'Data Nilai Pengetahuan';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('id_siswa')
                ->label('Siswa')
                ->options(Siswa::all()->pluck('nama_siswa', 'id'))
                ->searchable()
                ->required(),
            Forms\Components\Select::make('id_mapel')
                ->label('Mapel')
                ->options(RefMapel::all()->pluck('nama_mapel', 'id'))
                ->searchable()
                ->required(),
            Forms\Components\Select::make('id_kelas')
                ->label('kelas')
                ->options(RefKelas::all()->pluck('nama_kelas', 'id'))
                ->searchable()
                ->required(),
            Forms\Components\TextInput::make('nilai_pengetahuan')->numeric()->required(),
            Forms\Components\Select::make('id_guru')
                ->label('Guru')
                ->options(Guru::all()->pluck('nama_guru', 'id'))
                ->searchable()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')->rowIndex(),
                Tables\Columns\TextColumn::make('siswa.nama_siswa'),
                Tables\Columns\TextColumn::make('kelas.nama_kelas'),
                Tables\Columns\TextColumn::make('mapel.nama_mapel'),
                Tables\Columns\TextColumn::make('nilai_pengetahuan'),
                Tables\Columns\TextColumn::make('guru.nama_guru'),
            ])
            ->filters([
                SelectFilter::make('nama_kelas')->relationship('kelas', 'nama_kelas')
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
