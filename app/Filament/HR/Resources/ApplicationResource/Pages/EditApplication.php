<?php
namespace App\Filament\HR\Resources\ApplicationResource\Pages;
use App\Filament\HR\Resources\ApplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditApplication extends EditRecord
{
    protected static string $resource = ApplicationResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
