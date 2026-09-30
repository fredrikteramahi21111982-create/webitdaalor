<?php

namespace App\Filament\Resources\HeroBanners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HeroBannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Upload Wallpaper')
                    ->description('Gambar akan ditampilkan sebagai latar belakang berjalan (slideshow) di halaman beranda.')
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Gambar Wallpaper')
                            ->image()
                            ->directory('hero-banners')
                            ->visibility('public')
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Aktifkan Gambar Ini?')
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }
}
