<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->description('Tentukan judul, kategori, dan tahun dokumen.')
                    ->columns(['default' => 1, 'md' => 3])
                    ->schema([
                        TextInput::make('title')
                            ->label('Nama/Judul Dokumen')
                            ->placeholder('Masukkan nama atau judul dokumen')
                            ->required()
                            ->columnSpan(['default' => 1, 'md' => 1]),
                            
                        Select::make('document_category_id')
                            ->relationship('category', 'name')
                            ->label('Kategori Dokumen')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(['default' => 1, 'md' => 1]),
                            
                        Select::make('year')
                            ->options(array_combine(range(date('Y') + 1, 2010), range(date('Y') + 1, 2010)))
                            ->label('Tahun Dokumen')
                            ->searchable()
                            ->required()
                            ->columnSpan(['default' => 1, 'md' => 1]),
                    ]),
                    
                Section::make('Berkas Dokumen')
                    ->description('Unggah file dokumen dan atur tanggal tayang.')
                    ->columns(['default' => 1, 'md' => 2])
                    ->schema([
                        FileUpload::make('file_path')
                            ->label('File Dokumen (PDF, Word, Excel)')
                            ->disk('public')
                            ->directory('documents')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->maxSize(51200) // 50MB
                            ->downloadable()
                            ->openable()
                            ->required()
                            ->columnSpan(['default' => 1, 'md' => 1]),
                            
                        DatePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->default(now())
                            ->required()
                            ->columnSpan(['default' => 1, 'md' => 1]),
                    ]),
            ]);
    }
}
