<?php
namespace App\Filament\HR\Resources\ApplicationResource\Pages;
use App\Filament\HR\Resources\ApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
