<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Services\Inquiry\InquiryService;
use Illuminate\Http\RedirectResponse;

class ContactInquiryController extends Controller
{
    public function store(StoreInquiryRequest $request, InquiryService $inquiryService): RedirectResponse
    {
        $inquiryService->store([
            ...$request->validated(),
            'source' => 'website',
        ]);

        return back()->with('success', 'Your inquiry has been received. Our team will reach out using the contact details you provided.');
    }
}
