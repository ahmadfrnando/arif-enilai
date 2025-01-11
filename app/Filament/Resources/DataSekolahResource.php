<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataSekolahResource\Pages;
use App\Filament\Resources\DataSekolahResource\RelationManagers;
use App\Models\DataSekolah;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataSekolahResource extends Resource
{
    protected static ?string $model = DataSekolah::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_sekolah')->required(),
                Forms\Components\TextInput::make('nama_kepsek')->required(),
                Forms\Components\TextInput::make('nama_operator')->required(),
                Forms\Components\TextInput::make('akreditasi')->required(),
                Forms\Components\TextInput::make('kurikulum')->required(),
                Forms\Components\DateTimePicker::make('waktu'),
                Forms\Components\TextInput::make('npsn')->numeric()->required(),
                Forms\Components\TextInput::make('status')->required(),
                Forms\Components\TextInput::make('bentuk_pendidikan')->required(),
                Forms\Components\TextInput::make('status_kepemilikan')->required(),
                Forms\Components\TextInput::make('sk_pendirian_sekolah')->required(),
                Forms\Components\DatePicker::make('tanggal_sk_pendirian_sekolah'),
                Forms\Components\TextInput::make('sk_izin_operasional')->required(),
                Forms\Components\DatePicker::make('tanggal_sk_izin_operasional')->required(),
                Forms\Components\TextInput::make('kebutuhan_khusus')->required(),
                Forms\Components\TextInput::make('nama_bank')->required(),
                Forms\Components\TextInput::make('cabang_bank')->required(),
                Forms\Components\TextInput::make('nama_rekening')->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')->rowIndex(),
                Tables\Columns\TextColumn::make('nama_sekolah'),
                Tables\Columns\TextColumn::make('nama_kepsek'),
                Tables\Columns\TextColumn::make('nama_operator'),
                Tables\Columns\TextColumn::make('akreditasi'),
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
            'index' => Pages\ListDataSekolahs::route('/'),
            'create' => Pages\CreateDataSekolah::route('/create'),
            'edit' => Pages\EditDataSekolah::route('/{record}/edit'),
        ];
    }    
}
