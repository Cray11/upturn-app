<?php
namespace App\Services\Inquiry;

use App\Models\Inquiry;
use App\Models\User;
use App\Notifications\Inquiry\InquiryReceivedNotification;
use App\Notifications\Inquiry\InquiryReplyNotification;

class InquiryService
{
    /** Store a new inquiry from the public contact form. */
    public function store(array $data): Inquiry
    {
        $inquiry = Inquiry::create([...$data, 'status' => 'new', 'source' => $data['source'] ?? 'website']);

        User::role('admin')->each(fn($admin) =>
            $admin->notify(new InquiryReceivedNotification($inquiry))
        );

        return $inquiry;
    }

    /** Reply to an inquiry or add an internal note. */
    public function reply(Inquiry $inquiry, User $sender, string $message, bool $isInternal = false): void
    {
        $inquiry->replies()->create([
            'user_id'          => $sender->id,
            'message'          => $message,
            'is_internal_note' => $isInternal,
            'sent_at'          => now(),
        ]);

        if (!$isInternal) {
            $inquiry->update(['status' => 'in_progress', 'replied_at' => now()]);
        }
    }

    /** Assign an inquiry to a staff member. */
    public function assign(Inquiry $inquiry, User $user): void
    {
        $inquiry->update(['assigned_to' => $user->id]);
    }

    /** Update the status of an inquiry. */
    public function updateStatus(Inquiry $inquiry, string $status): void
    {
        $inquiry->update(['status' => $status]);
    }

    /** Attach tags to an inquiry (replaces existing). */
    public function tag(Inquiry $inquiry, array $tags): void
    {
        $inquiry->tags()->delete();
        foreach ($tags as $tag) {
            $inquiry->tags()->create(['tag' => $tag]);
        }
    }
}
