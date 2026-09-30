<?php

namespace App\Filament\Resources\ImportantLinks\Pages;

use App\Filament\Resources\ImportantLinks\ImportantLinkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditImportantLink extends EditRecord
{
    protected static string $resource = ImportantLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

