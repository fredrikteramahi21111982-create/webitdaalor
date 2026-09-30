<?php

namespace App\Filament\Resources\ImportantLinks\Pages;

use App\Filament\Resources\ImportantLinks\ImportantLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListImportantLinks extends ListRecords
{
    protected static string $resource = ImportantLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
