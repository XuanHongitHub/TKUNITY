<?php

namespace App\Filament\Resources\MegaMenus\Pages;

use App\Filament\Resources\MegaMenus\MegaMenuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMegaMenu extends EditRecord
{
    protected static string $resource = MegaMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
