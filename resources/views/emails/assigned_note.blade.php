<p>Dear {{ $assignedTo }},</p>

<p>You have been assigned a new note by {{ $assignedBy }}.</p>

<p><strong>Note Subject:</strong> {{ $subjectLine }}</p>

<p>
    <a href="{{ $link }}">Click here to view & edit this note</a>
</p>

<pre style="background: #f9f9f9; padding: 10px; border-left: 3px solid #ccc;">
{{ $noteText }}
</pre>

<p>Regards,<br>{{ $assignedBy }}</p>
