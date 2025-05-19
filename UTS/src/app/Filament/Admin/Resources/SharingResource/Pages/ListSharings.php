<?php

namespace App\Filament\Admin\Resources\SharingResource\Pages;

use App\Filament\Admin\Resources\SharingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSharings extends ListRecords
{
    protected static string $resource = SharingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
