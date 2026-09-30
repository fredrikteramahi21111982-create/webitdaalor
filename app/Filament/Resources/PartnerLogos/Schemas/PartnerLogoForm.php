<?php

namespace App\Filament\Resources\PartnerLogos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PartnerLogoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama Instansi (Cth: BPK Perwakilan NTT)')
                    ->required(),
                TextInput::make('url')
                    ->label('Tautan Website Instansi')
                    ->url()
                    ->placeholder('https://ntt.bpk.go.id')
                    ->required(),
                \Filament\Forms\Components\Hidden::make('image')
                    ->default('auto'),
            ]);
    }
}
