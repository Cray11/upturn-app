<?php

namespace App\Filament\Admin\Resources\CultureGalleryResource\Pages;

use App\Filament\Admin\Resources\CultureGalleryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCultureGalleries extends ListRecords
{
    protected static string $resource = CultureGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
