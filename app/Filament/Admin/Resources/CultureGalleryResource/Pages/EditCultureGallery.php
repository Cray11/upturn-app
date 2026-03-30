<?php

namespace App\Filament\Admin\Resources\CultureGalleryResource\Pages;

use App\Filament\Admin\Resources\CultureGalleryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCultureGallery extends EditRecord
{
    protected static string $resource = CultureGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
