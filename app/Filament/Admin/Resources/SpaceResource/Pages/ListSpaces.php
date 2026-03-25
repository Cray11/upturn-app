<?php
namespace App\Filament\Admin\Resources\SpaceResource\Pages;
use App\Filament\Admin\Resources\SpaceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListSpaces extends ListRecords
{
    protected static string $resource = SpaceResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
