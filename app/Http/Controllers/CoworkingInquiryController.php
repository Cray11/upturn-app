<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoworkingInquiryRequest;
use App\Services\Inquiry\InquiryService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class CoworkingInquiryController extends Controller
{
    public function store(
        StoreCoworkingInquiryRequest $request,
        InquiryService $inquiryService
    ): RedirectResponse {
        $data = $request->validated();

        $messageLines = [
            'Co-working booking request details:',
            'Space type: '.$data['space_type'],
            'Preferred date: '.Carbon::parse($data['booking_date'])->format('F j, Y'),
            'Preferred time: '.Carbon::createFromFormat('H:i', $data['booking_time'])->format('g:i A'),
        ];

        $inquiryService->store([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact_no' => $data['contact_no'],
            'business_name' => null,
            'service_interest' => 'Co-Working Space',
            'message' => implode(PHP_EOL, $messageLines),
            'source' => 'website',
        ]);

        return redirect()
            ->route('co-working')
            ->withFragment('booking-form')
            ->with('success', 'Your booking request has been received. Our team will contact you to confirm availability.');
    }
}
