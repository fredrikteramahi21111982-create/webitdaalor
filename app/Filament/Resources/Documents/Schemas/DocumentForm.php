<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                \Filament\Forms\Components\Select::make('document_category_id')
                    ->relationship('category', 'name')
                    ->label('Kategori Dokumen')
                    ->required(),
                \Filament\Forms\Components\Select::make('year')
                    ->options(array_combine(range(date('Y'), 2020), range(date('Y'), 2020)))
                    ->label('Tahun')
                    ->required(),
                \Filament\Forms\Components\FileUpload::make('file_path')
                    ->disk('public')
                    ->directory('documents')
                    ->required(),
                DatePicker::make('published_at'),
            ]);
    }
}
