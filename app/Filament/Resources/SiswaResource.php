<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use App\Models\RefKelas;
use Filament\Forms\Components\Section;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Forms\Components\FileUpload;
use Livewire\TemporaryUploadedFile;
use Filament\Infolists\Components\TextEntry;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Data Siswa';
    
    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Peserta Didik')
                ->description('Isi data peserta didik dengan benar')
                ->schema([
                    Forms\Components\TextInput::make('nama_siswa')
                        ->required()
                        ->maxLength(20),
                    Forms\Components\TextInput::make('nisn')
                        ->required()
                        ->maxLength(20),
                    Forms\Components\TextInput::make('tempat_lahir')
                        ->required()
                        ->maxLength(10),
                    Forms\Components\DatePicker::make('tanggal_lahir')
                        ->required(),
                    Forms\Components\Select::make('jenis_kelamin')
                        ->options([
                            'Laki-laki' => 'Laki-laki',
                            'Perempuan' => 'Perempuan',
                        ])
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
                    Forms\Components\TextInput::make('anak_ke')
                        ->required()
                        ->maxLength(2),

                    Forms\Components\TextInput::make('alamat_siswa')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\TextInput::make('telepon_siswa')
                        ->tel()
                        ->required(),
                ])->columns(2),
            Section::make('Kelas Pertama')
                ->description('Isi data kelas pertama dengan benar')
                ->schema([
                    Forms\Components\Select::make('id_kelas_pertama')
                        ->label('Kelas Pertama')
                        ->options(RefKelas::all()->pluck('nama_kelas', 'id'))
                        ->searchable()
                        ->required(),
                    Forms\Components\DatePicker::make('tanggal_pertama_diterima')
                        ->required(),
                    Forms\Components\Select::make('semester_pertama_diterima')
                        ->options([
                            '1' => '1',
                            '2' => '2',
                        ])
                        ->required(),
                ])->columns(3),
            Section::make('Data Sekolah Asal')
                ->description('Isi data sekolah asal dengan benar')
                ->schema([
                    Forms\Components\TextInput::make('asal_sekolah')
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make('tahun_ijazah')
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make('nomor_ijazah')
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make('nomor_shun')
                        ->label('Nomor SHUN (opsional)')
                        ->maxLength(50),
                    Forms\Components\TextInput::make('tahun_shun')
                        ->label('Tahun SHUN (opsional)')
                        ->maxLength(50),
                ])->columns(3),
            Section::make('Data Orang Tua/Wali')
                ->description('Isi data orang tua/wali dengan benar')
                ->schema([
                    Forms\Components\TextInput::make('nama_ayah')
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make('nama_ibu')
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make('pekerjaan_ayah')
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make('pekerjaan_ibu')
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make('alamat_ortu')
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make('telepon_ortu')
                        ->tel()
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make('nama_wali')
                        ->label('Nama Wali (opsional)')
                        ->maxLength(50),
                    Forms\Components\TextInput::make('pekerjaan_wali')
                        ->label('Pekerjaan Wali (opsional)')
                        ->maxLength(50),
                    Forms\Components\TextInput::make('alamat_wali')
                        ->label('Alamat Wali (opsional)')
                        ->maxLength(50),
                    Forms\Components\TextInput::make('telepon_wali')
                        ->label('Telepon Wali (opsional)')
                        ->tel(),
                ])->columns(2),
            FileUpload::make('pas_foto')
                ->label('Upload Pas Foto (maks. 1MB)')
                ->directory('Pas-Foto-Siswa')
                ->image()
                ->required()
                ->maxSize(1024)
                ->getUploadedFileNameForStorageUsing(
                    fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                        ->prepend('pas-foto-'),
                )
                ->columnSpan(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('nama_siswa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nisn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin'),
                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('pas_foto')
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }    
}
