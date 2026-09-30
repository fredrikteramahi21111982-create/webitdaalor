<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Halaman')
                    ->description('Tentukan judul dan media untuk halaman statis ini.')
                    ->columns(['default' => 1, 'md' => 3])
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Halaman')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->placeholder('Contoh: Profil Instansi, Visi Misi')
                            ->columnSpan(['default' => 1, 'md' => 1]),
                        
                        TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('contoh-slug-halaman')
                            ->columnSpan(['default' => 1, 'md' => 1]),
                            
                        FileUpload::make('image')
                            ->label('Gambar Banner Halaman (Opsional)')
                            ->image()
                            ->disk('public')
                            ->directory('pages')
                            ->columnSpan(['default' => 1, 'md' => 1]),
                    ]),
                    
                Section::make('Konten Utama')
                    ->description('Tuliskan isi utama halaman pada editor di bawah ini.')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Isi Konten')
                            ->required()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('pages')
                            ->columnSpanFull(),
                    ]),
                    
                Section::make('Bagian Tambahan (Opsional)')
                    ->description('Gunakan fitur ini jika Anda ingin menambahkan sub-bagian khusus seperti Visi, Misi, atau Tupoksi.')
                    ->schema([
                        Repeater::make('extra_sections')
                            ->label('')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Bagian')
                                    ->placeholder('Contoh: Visi, Misi, Struktur Organisasi, dll.')
                                    ->required(),
                                RichEditor::make('content')
                                    ->label('Isi Bagian')
                                    ->required(),
                            ])
                            ->addActionLabel('Tambah Bagian Baru')
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->columns(1)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
