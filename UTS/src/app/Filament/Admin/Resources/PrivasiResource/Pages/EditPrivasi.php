<?php

namespace App\Filament\Admin\Resources\PrivasiResource\Pages;

use App\Filament\Admin\Resources\PrivasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrivasi extends EditRecord
{
    protected static string $resource = PrivasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
