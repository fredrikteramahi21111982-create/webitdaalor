<?php

namespace App\Filament\Resources\ImportantLinks;

use App\Filament\Resources\ImportantLinks\Pages\CreateImportantLink;
use App\Filament\Resources\ImportantLinks\Pages\EditImportantLink;
use App\Filament\Resources\ImportantLinks\Pages\ListImportantLinks;
use App\Filament\Resources\ImportantLinks\Schemas\ImportantLinkForm;
use App\Filament\Resources\ImportantLinks\Tables\ImportantLinksTable;
use App\Models\ImportantLink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ImportantLinkResource extends Resource
{
    protected static ?string $model = ImportantLink::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ImportantLinkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ImportantLinksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListImportantLinks::route('/'),
            'create' => CreateImportantLink::route('/create'),
            'edit' => EditImportantLink::route('/{record}/edit'),
        ];
    }
}
