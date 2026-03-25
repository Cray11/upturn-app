<?php
namespace App\Filament\Admin\Resources\SpaceResource\Pages;
use App\Filament\Admin\Resources\SpaceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditSpace extends EditRecord
{
    protected static string $resource = SpaceResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
