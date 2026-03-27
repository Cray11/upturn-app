<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Models\JobPosting;
use App\Services\HR\ApplicationService;
use Illuminate\Http\RedirectResponse;

class CareerApplicationController extends Controller
{
    public function store(
        StoreJobApplicationRequest $request,
        JobPosting $jobPosting,
        ApplicationService $applicationService
    ): RedirectResponse {
        abort_unless($jobPosting->status === 'open', 404);

        $applicationService->submit(
            $jobPosting,
            $request->safe()->except('resume'),
            $request->file('resume')
        );

        return redirect()
            ->route('careers.show', $jobPosting)
            ->with('success', 'Application submitted. The HR team has been notified.');
    }
}
