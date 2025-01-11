<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaLulusSemesterResource\Pages;
use App\Filament\Resources\SiswaLulusSemesterResource\RelationManagers;
use App\Models\SiswaLulusSemester;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiswaLulusSemesterResource extends Resource
{
    protected static ?string $model = SiswaLulusSemester::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 8;

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
                //
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
            'index' => Pages\ListSiswaLulusSemesters::route('/'),
            'create' => Pages\CreateSiswaLulusSemester::route('/create'),
            'edit' => Pages\EditSiswaLulusSemester::route('/{record}/edit'),
        ];
    }    
}
