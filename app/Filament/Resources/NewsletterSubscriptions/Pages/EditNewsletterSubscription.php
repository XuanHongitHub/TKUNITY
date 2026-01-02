<?php

namespace App\Filament\Resources\NewsletterSubscriptions\Pages;

use App\Filament\Resources\NewsletterSubscriptions\NewsletterSubscriptionResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditNewsletterSubscription extends EditRecord
{
    protected static string $resource = NewsletterSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
