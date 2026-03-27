<?php
namespace App\Services\HR;

use App\Models\JobPosting;
use App\Models\User;

class JobPostingService
{
    /** Create a new job posting. */
    public function create(array $data, User $creator): JobPosting
    {
        return JobPosting::create([...$data, 'created_by' => $creator->id, 'status' => $data['status'] ?? 'draft']);
    }

    /** Publish a draft job posting. */
    public function publish(JobPosting $posting): JobPosting
    {
        $posting->update(['status' => 'open']);
        return $posting->fresh();
    }

    /** Close a job posting. */
    public function close(JobPosting $posting): JobPosting
    {
        $posting->update(['status' => 'closed']);
        return $posting->fresh();
    }
}
