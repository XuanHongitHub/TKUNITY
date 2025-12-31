<?php

namespace App\Filament\Resources\MegaMenus\Pages;

use App\Filament\Resources\MegaMenus\MegaMenuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMegaMenus extends ListRecords
{
    protected static string $resource = MegaMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
