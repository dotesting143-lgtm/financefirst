<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\DocumentStorage;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUpload extends Component
{
    use WithFileUploads;

    public $title;
    public $file;
    public $client_id;
    public $uploadedFiles;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $rules = [
        'title' => 'required|string|max:255',
        'file' => 'required|file|max:51200', // Max 50MB
        'client_id' => 'nullable|exists:clients,id',
    ];

    public function mount($client_id = null)
    {
        $this->client_id = $client_id;
    }

    public function uploadFile()
    {
        $this->validate();

        $folderPath = "uploads/documents/{$this->client_id}";

        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        $filename = Str::random(10) . '-' . $this->file->getClientOriginalName();

        $this->file->storeAs($folderPath, $filename, 'public');

        //$downloadLink = asset("storage/{$folderPath}/{$filename}");
        $downloadLink = "/storage/{$folderPath}/{$filename}";

        DocumentStorage::create([
            'title'         => $this->title,
            'filename'      => $filename,
            'uploaded_by'   => Auth::id(),
            'client_id'     => $this->client_id,
            'download_link' => $downloadLink,
        ]);

        session()->flash('message', 'File uploaded successfully.');

        $this->reset(['title', 'file']);
        $this->loadUploadedFiles();
    }

    public function loadUploadedFiles()
    {
        $this->uploadedFiles = DocumentStorage::where('client_id', $this->client_id)
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();
    }

    public function delete($id)
    {
        DocumentStorage::find($id)->delete();
        session()->flash('message', 'Document deleted successfully.');
    }

    public function render()
    {
        $this->loadUploadedFiles();

        return view('livewire.file-upload', [
            'uploadedFiles' => $this->uploadedFiles
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

}
