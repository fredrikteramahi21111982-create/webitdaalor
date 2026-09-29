<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->nullable(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                \Filament\Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->disk('public')
                    ->image(),
                TextInput::make('video_url')
                    ->label('Video URL (YouTube)')
                    ->url()
                    ->nullable(),
                DatePicker::make('published_at'),
            ]);
    }
}
