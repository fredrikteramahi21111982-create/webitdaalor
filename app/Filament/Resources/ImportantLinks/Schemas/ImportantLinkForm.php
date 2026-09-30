<?php

namespace App\Filament\Resources\ImportantLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ImportantLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Informasi Tautan')
                    ->description('Kelola daftar tautan penting yang akan ditampilkan di bagian bawah website (footer).')
                    ->schema([
                        TextInput::make('title')
                            ->label('Nama Tautan')
                            ->placeholder('Contoh: Kementerian Kominfo')
                            ->required(),
                        TextInput::make('url')
                            ->label('URL / Alamat Web')
                            ->url()
                            ->placeholder('Contoh: https://kominfo.go.id')
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Tampilkan Tautan Ini?')
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }
}
