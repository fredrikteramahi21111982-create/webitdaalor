<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Berita')
                    ->description('Tentukan judul, kategori, dan waktu tayang berita.')
                    ->columns(['default' => 1, 'md' => 2])
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Berita')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->placeholder('Masukkan judul berita di sini...'),
                            
                        TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('judul-berita-otomatis'),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->label('Kategori Berita')
                            ->searchable()
                            ->preload()
                            ->required(),
                            
                        DatePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->default(now())
                            ->required(),
                    ]),
                    
                Section::make('Isi Konten Utama')
                    ->description('Tuliskan berita lengkap Anda pada editor di bawah ini.')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Teks Berita')
                            ->required()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('posts')
                            ->columnSpanFull(),
                    ]),
                    
                Section::make('Media Pendukung')
                    ->description('Tambahkan gambar sampul atau tautan video YouTube agar berita lebih menarik.')
                    ->columns(['default' => 1, 'md' => 2])
                    ->schema([
                        FileUpload::make('image')
                            ->label('Gambar Sampul (Thumbnail)')
                            ->disk('public')
                            ->directory('posts')
                            ->image()
                            ->imageEditor()
                            ->columnSpan(1),
                            
                        TextInput::make('video_url')
                            ->label('Video URL (YouTube)')
                            ->placeholder('Contoh: https://youtube.com/watch?v=...')
                            ->url()
                            ->nullable()
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
