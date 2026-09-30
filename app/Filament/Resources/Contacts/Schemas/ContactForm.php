<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    Section::make('Informasi Kontak Utama')
                        ->description('Alamat kantor, email, dan nomor WhatsApp.')
                        ->schema([
                            Textarea::make('address')
                                ->label('Alamat Lengkap')
                                ->placeholder('Contoh: Jalan El Tari Nomor 12...')
                                ->rows(3)
                                ->columnSpanFull(),
                                
                            TextInput::make('email')
                                ->label('Alamat Email')
                                ->email()
                                ->placeholder('contoh@email.com'),
                                
                            TextInput::make('whatsapp')
                                ->label('Nomor WhatsApp')
                                ->placeholder('08xxxxxxxxxx'),
                        ])->columnSpan(1),
                        
                    Section::make('Sosial Media & Lokasi')
                        ->description('Tautan ke akun sosial media dan Google Maps.')
                        ->schema([
                            TextInput::make('facebook')
                                ->label('Facebook URL')
                                ->url(),
                            TextInput::make('instagram')
                                ->label('Instagram URL')
                                ->url(),
                            TextInput::make('youtube')
                                ->label('YouTube URL')
                                ->url(),
                            TextInput::make('tiktok')
                                ->label('TikTok URL')
                                ->url(),
                            TextInput::make('linkedin')
                                ->label('LinkedIn URL')
                                ->url(),
                                
                            Textarea::make('map_url')
                                ->label('Google Maps Embed URL / Iframe src')
                                ->placeholder('https://maps.google.com/maps?q=-8.213857,124.546446&hl=id&z=16&output=embed')
                                ->columnSpanFull(),
                        ])->columnSpan(1),
                ]),
                Section::make('Widget Instagram (Untuk Halaman Depan)')
                    ->description('Tempelkan kode Embed/Script HTML dari layanan pihak ketiga (seperti Elfsight/SnapWidget) di sini untuk menampilkan galeri Instagram di Halaman Utama.')
                    ->schema([
                        Textarea::make('instagram_widget_code')
                            ->label('Kode Script Widget')
                            ->placeholder('<script src="https://apps.elfsight.com/p/platform.js" defer></script><div class="elfsight-app-xxx"></div>')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
                    
                Section::make('Pengaturan Sekapur Sirih')
                    ->description('Teks sambutan dan profil pimpinan di halaman utama.')
                    ->columns(['default' => 1, 'md' => 2])
                    ->schema([
                        TextInput::make('foreword_title')
                            ->label('Judul Bagian')
                            ->default('Sekapur Sirih')
                            ->required(),
                        TextInput::make('foreword_name')
                            ->label('Nama Lengkap Pimpinan')
                            ->default('Romelus Djobo, SE')
                            ->required(),
                        TextInput::make('foreword_position')
                            ->label('Jabatan / Posisi')
                            ->default('Inspektur Daerah Kab. Alor')
                            ->required()
                            ->columnSpanFull(),
                        \Filament\Forms\Components\RichEditor::make('foreword_content')
                            ->label('Narasi Sambutan (Teks)')
                            ->required()
                            ->columnSpanFull(),
                        \Filament\Forms\Components\FileUpload::make('foreword_image')
                            ->label('Foto Pimpinan')
                            ->image()
                            ->disk('public')
                            ->directory('profiles')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
