<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NilaiResource\Pages;
use App\Filament\Resources\NilaiResource\RelationManagers;
use App\Models\Nilai;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Guru;
use App\Models\RefKelas;
use App\Models\RefMapel;
use App\Models\Siswa;
use Filament\Tables\Filters\SelectFilter;


class NilaiResource extends Resource
{
    protected static ?string $model = Nilai::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'Data Nilai';

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
                Forms\Components\TextInput::make('nilai')->numeric()->required(),
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
                Tables\Columns\TextColumn::make('kelas.nama_kelas'),
                Tables\Columns\TextColumn::make('siswa.nama_siswa'),
                Tables\Columns\TextColumn::make('mapel.nama_mapel'),
                Tables\Columns\TextColumn::make('nilai'),
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
            'index' => Pages\ListNilais::route('/'),
            'create' => Pages\CreateNilai::route('/create'),
            'edit' => Pages\EditNilai::route('/{record}/edit'),
        ];
    }    
}
