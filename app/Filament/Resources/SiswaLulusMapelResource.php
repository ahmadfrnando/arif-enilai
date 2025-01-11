<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaLulusMapelResource\Pages;
use App\Filament\Resources\SiswaLulusMapelResource\RelationManagers;
use App\Models\SiswaLulusMapel;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiswaLulusMapelResource extends Resource
{
    protected static ?string $model = SiswaLulusMapel::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama_siswa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('semester'),
                Tables\Columns\TextColumn::make('mapel.nama_mapel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelas.nama_kelas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guru.nama_guru')
                    ->searchable(),
                BadgeColumn::make('id_status')
                    ->enum([
                        '1' => 'Lulus',
                        '2' => 'Tidak Lulus',
                    ])
                    ->colors([
                        'success' => '1',
                        'danger' => '2',
                    ])
                    ->label('status')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSiswaLulusMapels::route('/'),
            'create' => Pages\CreateSiswaLulusMapel::route('/create'),
            'edit' => Pages\EditSiswaLulusMapel::route('/{record}/edit'),
        ];
    }
}
