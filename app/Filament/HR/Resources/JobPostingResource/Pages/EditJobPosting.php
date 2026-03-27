<?php
namespace App\Filament\HR\Resources\JobPostingResource\Pages;
use App\Filament\HR\Resources\JobPostingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJobPosting extends EditRecord
{
    protected static string $resource = JobPostingResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
