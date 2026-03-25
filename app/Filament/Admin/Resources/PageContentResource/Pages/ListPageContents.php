<?php

namespace App\Filament\Admin\Resources\PageContentResource\Pages;

use App\Filament\Admin\Resources\PageContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPageContents extends ListRecords
{
    protected static string $resource = PageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
