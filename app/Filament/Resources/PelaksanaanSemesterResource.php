<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelaksanaanSemesterResource\Pages;
use App\Filament\Resources\PelaksanaanSemesterResource\RelationManagers;
use App\Models\PelaksanaanSemester;
use App\Models\RefTahunAjaran;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PelaksanaanSemesterResource extends Resource
{
    protected static ?string $model = PelaksanaanSemester::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tahun_ajaran')
                    ->label('Tahun Ajaran')
                    ->options(RefTahunAjaran::all()->pluck('tahun_ajaran', 'tahun_ajaran'))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('semester')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                    ])
                    ->required(),
                Toggle::make('status_aktif')->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')->rowIndex(),
                Tables\Columns\TextColumn::make('tahun_ajaran'),
                Tables\Columns\TextColumn::make('semester'),
                ToggleColumn::make('status_aktif'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePelaksanaanSemesters::route('/'),
        ];
    }
}
