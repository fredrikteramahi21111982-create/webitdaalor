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
                    ->required(),
                FileUpload::make('image')
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/svg+xml', 'image/webp', 'image/gif'])
                    ->required(),
            ]);
    }
}
