<?php

namespace App\Filament\Resources\ImportantLinks\Pages;

use App\Filament\Resources\ImportantLinks\ImportantLinkResource;
use Filament\Resources\Pages\CreateRecord;

class CreateImportantLink extends CreateRecord
{
    protected static string $resource = ImportantLinkResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

