<?php

namespace App\Filament\Resources\ExternalLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExternalLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('url')
                    ->url()
                    ->required(),
                \Filament\Forms\Components\FileUpload::make('icon')
                    ->disk('public')
                    ->directory('icons')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/svg+xml', 'image/webp', 'image/gif'])
                    ->default(null),
            ]);
    }
}
