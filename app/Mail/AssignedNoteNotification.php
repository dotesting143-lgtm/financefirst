<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AssignedNoteNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $noteText;
    public $assignedBy;
    public $subjectLine;
    public $assignedTo;
    public $link;

    public function __construct($noteText, $assignedBy, $subjectLine, $assignedTo, $link)
    {
        $this->noteText   = $noteText;
        $this->assignedBy = $assignedBy;
        $this->subjectLine = $subjectLine;
        $this->assignedTo  = $assignedTo;
        $this->link        = $link;
    }

    public function build()
    {
        return $this->subject("New Note Assigned: {$this->subjectLine}")
            ->view('emails.assigned_note');
    }
}