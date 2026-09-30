<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Informasi Komentar')
                    ->schema([
                        \Filament\Forms\Components\Select::make('post_id')
                            ->relationship('post', 'title')
                            ->searchable()
                            ->required()
                            ->label('Artikel Terkait'),
                        \Filament\Forms\Components\Select::make('parent_id')
                            ->relationship('parent', 'content')
                            ->searchable()
                            ->label('Balasan Untuk Komentar (Opsional)'),
                        TextInput::make('name')
                            ->label('Nama Penulis')
                            ->required(),
                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->default(null),
                        Textarea::make('content')
                            ->label('Isi Komentar')
                            ->required()
                            ->columnSpanFull(),
                        Toggle::make('is_approved')
                            ->label('Setujui Komentar Ini (Tampil di Publik)')
                            ->default(false),
                        Toggle::make('is_admin')
                            ->label('Ini adalah balasan dari Admin')
                            ->default(false),
                    ])->columns(2),
            ]);
    }
}
