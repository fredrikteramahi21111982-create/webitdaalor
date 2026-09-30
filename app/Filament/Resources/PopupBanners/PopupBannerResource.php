<?php

namespace App\Filament\Resources\PopupBanners;

use App\Filament\Resources\PopupBanners\Pages\CreatePopupBanner;
use App\Filament\Resources\PopupBanners\Pages\EditPopupBanner;
use App\Filament\Resources\PopupBanners\Pages\ListPopupBanners;
use App\Filament\Resources\PopupBanners\Schemas\PopupBannerForm;
use App\Filament\Resources\PopupBanners\Tables\PopupBannersTable;
use App\Models\PopupBanner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PopupBannerResource extends Resource
{
    protected static ?string $model = PopupBanner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PopupBannerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PopupBannersTable::configure($table);
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
            'index' => ListPopupBanners::route('/'),
            'create' => CreatePopupBanner::route('/create'),
            'edit' => EditPopupBanner::route('/{record}/edit'),
        ];
    }
}
