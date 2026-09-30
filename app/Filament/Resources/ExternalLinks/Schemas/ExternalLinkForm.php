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
                    ->label('Nama Layanan / Aplikasi')
                    ->required(),
                TextInput::make('url')
                    ->label('Tautan (URL)')
                    ->url()
                    ->required(),
                \Filament\Forms\Components\Hidden::make('icon')
                    ->default(null),
            ]);
    }
}
