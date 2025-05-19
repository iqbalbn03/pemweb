<?php

namespace App\Filament\Admin\Resources\SharingResource\Pages;

use App\Filament\Admin\Resources\SharingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSharing extends EditRecord
{
    protected static string $resource = SharingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
