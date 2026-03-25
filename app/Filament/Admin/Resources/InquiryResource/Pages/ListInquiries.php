<?php
namespace App\Filament\Admin\Resources\InquiryResource\Pages;
use App\Filament\Admin\Resources\InquiryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListInquiries extends ListRecords
{
    protected static string $resource = InquiryResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
