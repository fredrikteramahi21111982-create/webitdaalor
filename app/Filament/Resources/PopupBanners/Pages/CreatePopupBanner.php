<?php

namespace App\Filament\Resources\PopupBanners\Pages;

use App\Filament\Resources\PopupBanners\PopupBannerResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePopupBanner extends CreateRecord
{
    protected static string $resource = PopupBannerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
