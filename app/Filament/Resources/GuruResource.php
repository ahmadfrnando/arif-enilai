<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;
use App\Filament\Resources\GuruResource\RelationManagers;
use App\Models\Guru;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\RefMapel;
use Filament\Forms\Components\Section;
use Livewire\TemporaryUploadedFile;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data Guru';

    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Guru')
                    ->description('Isi data guru dengan benar')
                    ->schema([
                        Forms\Components\TextInput::make('nama_guru')
                            ->required()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('username')
                            ->required()
                            ->unique()
                            ->maxLength(20),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('tempat_lahir')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\DatePicker::make('tanggal_lahir')
                            ->required(),
                        Forms\Components\Select::make('agama')
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Budha' => 'Budha',
                                'Konghucu' => 'Konghucu',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal_mulai_tugas')
                            ->required(),
                        Forms\Components\TextInput::make('jabatan')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('jenis_sekolah')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('jurusan')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('tahun_sttb')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\Select::make('id_mapel')
                            ->label('Mapel')
                            ->options(RefMapel::all()->pluck('nama_mapel', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('penataran_yang_pernah_diikutin')
                            ->maxLength(10),
                        Forms\Components\TextInput::make('keterangan')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('pas_foto')
                            ->label('Upload Pas Foto (maks. 1MB)')
                            ->image()
                            ->directory('Pas-Foto-Guru')
                            ->maxSize(1024)
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend('pas-foto-'),
                            ),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('nama_guru')
                    ->searchable(),
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin'),
                Tables\Columns\TextColumn::make('jabatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mapel.nama_mapel')
                    ->searchable(),
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
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}
