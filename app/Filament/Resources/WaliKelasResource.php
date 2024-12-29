<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaliKelasResource\Pages;
use App\Filament\Resources\WaliKelasResource\RelationManagers;
use App\Models\Guru;
use App\Models\RefKelas;
use App\Models\WaliKelas;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaliKelasResource extends Resource
{
    protected static ?string $model = WaliKelas::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Data Wali Kelas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_kelas')
                    ->label('Kelas')
                    ->options(RefKelas::all()->pluck('nama_kelas', 'id'))
                    ->searchable()
                    ->required(),
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
                Tables\Columns\TextColumn::make('guru.nama_guru'),
                Tables\Columns\TextColumn::make('kelas.nama_kelas')->label('Kelas'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListWaliKelas::route('/'),
            'create' => Pages\CreateWaliKelas::route('/create'),
            'edit' => Pages\EditWaliKelas::route('/{record}/edit'),
        ];
    }
}
