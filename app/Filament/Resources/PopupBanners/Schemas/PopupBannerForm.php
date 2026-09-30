<?php

namespace App\Filament\Resources\PopupBanners\Schemas;

use Filament\Schemas\Schema;

class PopupBannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Konfigurasi Pop-up Banner')
                    ->description('Brosur/Flyer ini akan melayang (pop-up) di halaman beranda saat pengunjung baru datang.')
                    ->columns(['default' => 1, 'md' => 2])
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('title')
                            ->label('Judul / Keterangan Banner')
                            ->placeholder('Contoh: Pengumuman Hari Libur Nasional')
                            ->required()
                            ->columnSpan(['default' => 1, 'md' => 1]),
                            
                        \Filament\Forms\Components\TextInput::make('url')
                            ->label('Tautan URL (Opsional)')
                            ->placeholder('Contoh: https://... jika diklik menuju halaman tertentu')
                            ->url()
                            ->columnSpan(['default' => 1, 'md' => 1]),
                            
                        \Filament\Forms\Components\FileUpload::make('image_path')
                            ->label('Upload Gambar/Flyer')
                            ->image()
                            ->disk('public')
                            ->directory('popups')
                            ->required()
                            ->columnSpanFull(),
                            
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->label('Aktifkan Banner Ini?')
                            ->helperText('Hanya akan ada 1 banner aktif di halaman depan. Mengaktifkan ini tidak akan menonaktifkan yang lain otomatis (harap pastikan).')
                            ->default(false)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
