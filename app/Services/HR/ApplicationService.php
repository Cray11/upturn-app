<?php
namespace App\Services\HR;

use App\Models\Application;
use App\Models\ApplicationStage;
use App\Models\JobPosting;
use App\Models\User;
use App\Notifications\HR\ApplicationReceivedNotification;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ApplicationService
{
    /** Submit a new job application from the public careers portal. */
    public function submit(JobPosting $posting, array $data, ?UploadedFile $resume = null): Application
    {
        if ($resume) {
            $data['resume_path'] = $resume->store('resumes', 'private');
        }

        $application = $posting->applications()->create([
            ...$data,
            'status' => 'new',
        ]);

        $this->addStage($application, 'Application Received', null, 'pending', 'Auto-logged on submission.');

        User::query()
            ->get()
            ->filter(fn (User $user) => $user->hasPortalRole(['hr']))
            ->each(fn (User $hr) => $hr->notify(new ApplicationReceivedNotification($application)));

        return $application;
    }

    /** Move an application to the next pipeline stage. */
    public function addStage(
        Application $application,
        string $stageName,
        ?User $reviewer,
        string $result = 'pending',
        string $notes = ''
    ): ApplicationStage {
        return $application->stages()->create([
            'stage_name'  => $stageName,
            'reviewed_by' => $reviewer?->id,
            'result'      => $result,
            'notes'       => $notes,
            'reviewed_at' => now(),
        ]);
    }

    /** Update the overall application status. */
    public function updateStatus(Application $application, string $status, string $remarks = ''): void
    {
        $application->update(['status' => $status, 'remarks' => $remarks]);
    }

    /** Return a signed temporary URL for downloading a resume. */
    public function resumeUrl(Application $application): string
    {
        return Storage::disk('private')->temporaryUrl($application->resume_path, now()->addMinutes(15));
    }
}
