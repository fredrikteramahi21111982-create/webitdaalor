<?php

namespace App\Filament\Resources\PopupBanners\Pages;

use App\Filament\Resources\PopupBanners\PopupBannerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPopupBanners extends ListRecords
{
    protected static string $resource = PopupBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
