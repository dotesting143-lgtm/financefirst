<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProductNotes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AssignedNoteNotification;

class SendReminderNotes extends Command
{
    protected $signature = 'notes:send-reminders';
    protected $description = 'Send reminder emails for notes with today reminder date';

    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');

        $notes = ProductNotes::whereDate('reminder_date', $today)
            ->whereNotNull('assigned_to')
            ->get();

        foreach ($notes as $note) {
            $assignedUser = User::find($note->assigned_to);

            if (!$assignedUser) continue;

            $link = url('/product-notes?editnote=' . $note->id);

            $formatted = "Reminder for note created on " . $note->created_at->format('d/m/y g:ia') . "\n\n";
            $formatted .= $note->text . "\n";

            Mail::to($assignedUser->email)->send(
                new AssignedNoteNotification(
                    $formatted,
                    'System Reminder',
                    $note->subject,
                    $assignedUser->name,
                    $link
                )
            );
        }

        $this->info("Reminder emails sent successfully.");
    }
}
