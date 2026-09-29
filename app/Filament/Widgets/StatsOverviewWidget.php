<?php

namespace App\Filament\Widgets;

use App\Models\Document;
use App\Models\ExternalLink;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', Post::count())
                ->description('Jumlah publikasi berita')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary'),
                
            Stat::make('Dokumen Publik', Document::count())
                ->description('File peraturan & dokumen')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
                
            Stat::make('Aplikasi Layanan', ExternalLink::count())
                ->description('Layanan WBS, SPIP, dll')
                ->descriptionIcon('heroicon-m-link')
                ->color('warning'),
        ];
    }
}
