<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductNotes as ProductNotesModel;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\AssignedNoteNotification;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class ProductNotes extends Component
{
    use WithPagination;

    public $created_by, $assigned_to, $subject, $text, $active, $policy_type, $policy_id, $reminder_id, $reminder_date, $reminder_to, $client_name, $notes_history_text, $uw_status, $internal_status, $new_notes;
    public $users, $user_filter, $inputString_name, $inputString_product_type, $inputString_ponum;
    public $searchApplied = false;
    public $isOpen = 0;
    public $original_internal_status, $original_uw_status, $original_assigned_to, $original_reminder_date;
    public $form_submitted = false;
    public $subjectcustom;
    public bool $viewAll = false;
    public $sort_by = 'updated_at';
    public $sort_direction = 'desc';
    public $productnote;
    public $usersFilter;


    protected $rules = [
        'created_by' => 'required|string|max:255',
        'assigned_to' => 'nullable|string|max:255',
        'subject' => 'nullable|string|max:65000',
        'text' => 'nullable|string|max:65000',
        'active' => 'nullable|string|max:255',
        'policy_type' => 'nullable|string|max:255',
        'policy_id' => 'nullable|string|max:255',
        'reminder_id' => 'nullable|string|max:255',
        'reminder_date' => 'required|date',
        'reminder_to' => 'nullable|exists:clients,id',
    ];

    public function mount() {
        $this->users = User::orderBy('name', 'asc')->get();

        $loggedInUser = auth()->user();

        if ($loggedInUser->role == 2) {
             $this->usersFilter = User::where('id', $loggedInUser->id)
            ->orderBy('name', 'asc')
            ->get();
        } elseif ($loggedInUser->role == 3) {
            $this->usersFilter = User::where(function ($q) use ($loggedInUser) {
                $q->where('role', 2)
                  ->orWhere('id', $loggedInUser->id);
            })
            ->orderBy('name', 'asc')
            ->get();
        } else {
            $this->usersFilter = User::orderBy('name', 'asc')->get();
        }

        if (request()->has('editnote')) {
            $this->edit(request()->get('editnote'));
        }
    }

    private function getFields() {
        return collect($this->rules)->keys()->mapWithKeys(fn($field) => [$field => $this->$field])->toArray();
    }

   public function search()
    {
		if($this->getIsDisabledProperty()) {
            session()->flash('message', 'You must select atleast 1 filter.');
            return false;
        }
        $this->searchApplied = true;
         $this->resetPage();
		
    }

	public function getIsDisabledProperty()
    {
        return empty($this->inputString_name) 
            && empty($this->inputString_product_type) 
            && empty($this->inputString_ponum) 
            && empty($this->user_filter) ;
          
    }
  

    public function getInsurer($productnote) {
        $insurer = '';
        $id = $productnote->policy_id;

        switch ($productnote->policy_type) {
            case 'life_policy':
                $policy = \App\Models\LifePolicy::find($id);
                if ($policy) {
                    $insurer = $policy->propinsurer;
                }
                break;
            case 'mortgage_policy':
                $policy = \App\Models\MortgagePolicy::find($id);
                if ($policy) {
                    $insurer = $policy->propinsurer;
                }
                break;
            case 'house_policy':
                $policy = \App\Models\HousePolicy::find($id);
                if ($policy) {
                    $insurer = $policy->propinsurer;
                }
                break;
            case 'commercial_policy':
                $policy = \App\Models\CommercialPolicy::find($id);
                if ($policy) {
                    $insurer = $policy->propinsurer;
                }
                break;  
            case 'pension_policy':
                $policy = \App\Models\PensionPolicy::find($id);
                if ($policy) {
                    $insurer = $policy->propinsurer;
                }
                break;
            case 'canonly_policy':
                $policy = \App\Models\CancerPolicy::find($id);
                if ($policy) {
                    $insurer = $policy->propinsurer;
                }
                break;
            case 'peracc_policy':
                $policy = \App\Models\PerAccPolicy::find($id);
                if ($policy) {
                    $insurer = $policy->propinsurer;
                }
                break;
            case 'motor_policy':
                $policy = \App\Models\MotorPolicy::find($id);
                if ($policy) {
                    $insurer = $policy->propinsurer;
                }
                break;
        }
        return $insurer;
    }

    public function render()
    {
        if (! $this->searchApplied) {
            return view('livewire.product-notes', ['allproductnotes' => collect()]);
        }

        // 1) Pick LATEST row per policy (UNFILTERED) by MAX(id)
        $latestIds = ProductNotesModel::query()
            ->selectRaw('MAX(id) as id')
            ->groupBy('policy_id')
            ->pluck('id');

        if ($latestIds->isEmpty()) {
            return view('livewire.product-notes', ['allproductnotes' => collect()]);
        }

        // 2) Fetch those latest rows; join for name/insurer filters later
        $query = ProductNotesModel::query()
            ->with(['createdBy','assignTo']) // relations used in the table
            ->whereIn('product_notes.id', $latestIds);

        // Optional joins only if we need to filter by client name or show insurer cleanly
        $needsClientJoin = !empty($this->inputString_name)
        || $this->sort_by === 'insurer'
        || $this->sort_by === 'first_name';

        if ($needsClientJoin) {
            $query->leftJoin('client_policies', 'client_policies.id', '=', 'product_notes.policy_id')
                  ->leftJoin('clients', 'clients.id', '=', 'client_policies.client_id')
                  ->addSelect('product_notes.*', 'client_policies.propinsurer as insurer_name',
                              'clients.first_name as client_first_name', 'clients.last_name as client_last_name');
        }

        // 3) NOW apply filters (on the latest rows)
        // role / assignment
        $role = auth()->user()->role;
        $loggedInUser = auth()->user();
        if ($role == 2) {
            /*$query->where('product_notes.assigned_to', auth()->id());*/
            $query->where(function ($q) {
                $q->where('product_notes.assigned_to', auth()->id())
                  ->orWhere('product_notes.created_by', auth()->id());
            });
        } elseif ($role == 3 && $this->user_filter) { 
            $query->where('product_notes.assigned_to', $this->user_filter);
        } elseif ($role == 3) { 
            $userIds = User::where('role', 2)->pluck('id')->toArray();
            /*$query->where(function ($q) use ($loggedInUser, $userIds) {
                    $q->where('product_notes.assigned_to', $loggedInUser->id)
                      ->orWhereIn('product_notes.assigned_to', $userIds); 
                });*/
            $query->where(function ($q) use ($loggedInUser, $userIds) {
                $q->whereIn('product_notes.assigned_to', $userIds)
                  ->orWhere('product_notes.assigned_to', $loggedInUser->id)
                  ->orWhere('product_notes.created_by', auth()->id());
            });
        } elseif (!empty($this->user_filter)) {
            $query->where('product_notes.assigned_to', $this->user_filter);
        }

        // product type, po num (policy)
        if (!empty($this->inputString_product_type)) {
            $query->where('product_notes.policy_type', $this->inputString_product_type);
        }
        if (!empty($this->inputString_ponum)) {
            $query->where('product_notes.policy_id', $this->inputString_ponum);
        }

        // name filter — filter by canonical client name (NOT the note’s stored name)
        if (!empty($this->inputString_name)) {
            $needle = '%'.trim($this->inputString_name).'%';
            $query->where(function($q) use ($needle) {
                $q->whereRaw("CONCAT(COALESCE(clients.first_name,''),' ',COALESCE(clients.last_name,'')) LIKE ?", [$needle]);
            });
        }

        // 4) Get the dataset (no DB order yet)
        $rows = $query->get()->values();

        // 5) Sort IN MEMORY (as requested) at the very end
        $desc = $this->sort_direction === 'desc';
        $sorted = $rows->sortBy(function($n){
            switch ($this->sort_by) {
                case 'first_name':
                    return mb_strtolower(trim(($n->client_first_name ?? '').' '.($n->client_last_name ?? '')));
                case 'subject':
                    return mb_strtolower($n->subject ?? '');
                case 'insurer':
                    // from join; fallback to relation path if missing
                    return mb_strtolower($n->insurer_name ?? ($n->getPolicy?->clientPolicy?->propinsurer ?? ''));
                case 'created_by':
                    return mb_strtolower($n->createdBy?->name ?? '');
                case 'assigned_to':
                    return mb_strtolower($n->assignTo?->name ?? '');
                case 'id':
                    return (int) $n->id;
                case 'updated_at':
                default:
                    return optional($n->updated_at)->getTimestamp() ?? 0;
            }
        }, SORT_REGULAR, $desc)->values();

        // 6) Manual pagination on the sorted collection
        if ($this->viewAll) {
            $final = $sorted;
        } else {
            $pageName     = 'page'; // Livewire's default page param
            $currentPage  = Paginator::resolveCurrentPage($pageName);
            $perPage      = 20;

            $items = $sorted->slice(($currentPage - 1) * $perPage, $perPage)->values();

            $final = new LengthAwarePaginator(
                $items,
                $sorted->count(),
                $perPage,
                $currentPage,
                [
                    'path'     => Paginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        }


        return view('livewire.product-notes', ['allproductnotes' => $final]);
    }


    public function sortBy($field)
    {
        if ($this->sort_by === $field) {
            $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_by = $field;
            $this->sort_direction = 'asc';
        }

        $this->resetPage(); // Reset pagination to page 1 on sort
    }

    public function viewAllNotes()
    {
        $this->viewAll = true;
    }

    public function resetPaginationView()
    {
        $this->viewAll = false;
        $this->resetPage();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->reset(['form_submitted']);
        $this->isOpen = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->reset([
            'isOpen',     // Close the modal
        ]);

        // Reset form fields dynamically based on rules
        foreach ($this->rules as $field => $rule) {
            $this->$field = null;
        }
        $this->reset(['form_submitted']);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        // original note clicked (may be one of many notes for the policy)
        $originalNote = ProductNotesModel::findOrFail($id);
        $this->productnote = $id;

        // get the latest note for that policy to show history / populate fields
        $productnote = ProductNotesModel::where('policy_id', $originalNote->policy_id)
            ->orderByDesc('id')
            ->first();

        // if no productnote found (very unlikely because $originalNote exists), fallback to original
        if (! $productnote) {
            $productnote = $originalNote;
        }


        foreach ($this->rules as $field => $rule) {
            if ($field === 'reminder_date') {
                if (!empty($productnote->reminder_date)) {
                    $date = Carbon::parse($productnote->reminder_date);
                    // If reminder date is in the past OR empty → set today
                    if ($date->isPast()) {
                        $this->reminder_date = Carbon::today()->format('d-m-Y');
                    } else {
                        $this->reminder_date = $date->format('d-m-Y');
                    }
                } else {
                    // If empty → set today
                    $this->reminder_date = Carbon::today()->format('d-m-Y');
                }
            } else {
                $this->$field = $productnote->$field ?? null;
            }
        }

        // Try to get client name from client_policies -> clients (preferred / authoritative)
        $clientName = null;

        if (! empty($originalNote->policy_id)) {
            $clientPolicy = \App\Models\ClientPolicies::find($originalNote->policy_id);
            if ($clientPolicy && ! empty($clientPolicy->client_id)) {
                $client = \App\Models\Client::find($clientPolicy->client_id);
                if ($client) {
                    $clientName = trim(($client->first_name ?? '') . ' ' . ($client->last_name ?? ''));
                }
            }
        }

        // Fallback: if we couldn't resolve the client via policies/clients, use values stored on the note
        if (empty($clientName)) {
            $clientName = trim(($originalNote->first_name ?? '') . ' ' . ($originalNote->last_name ?? ''));
        }

        // Final assignment (ensure not null)
        $this->client_name = $clientName ?: '';

        // history text & client policy statuses
        $this->notes_history_text = $productnote->text ?? '';

        $clientPolicyRecord = \App\Models\ClientPolicies::find($productnote->policy_id);
        $this->uw_status = $clientPolicyRecord?->uw_status;
        $this->internal_status = $clientPolicyRecord?->internal_status;

        $this->new_notes = null;
        $this->openModal();

        $this->original_internal_status = $clientPolicyRecord?->internal_status;
        $this->original_uw_status = $clientPolicyRecord?->uw_status;
        $this->original_assigned_to = $productnote->assigned_to ?? null;
        $this->subjectcustom = ($productnote->subject ?? '') 
            . ' (' . ($productnote->getFullPolicyId() ?? '') . ') '
            . '(' . ($productnote->getPolicy?->clientPolicy?->propinsurer_num ?? '') . ')';
        $this->original_reminder_date = ! empty($productnote->reminder_date)
            ? \Carbon\Carbon::parse($productnote->reminder_date)->format('d-m-Y')
            : null;
    }


    public function submitNote()
    {
        $this->validate([
            'assigned_to' => 'nullable|integer|exists:users,id',
            'subject' => 'nullable|string|max:65000',
            'new_notes' => 'nullable|string|max:65000',
            'reminder_date' => 'nullable|date_format:d-m-Y',
            'uw_status' => 'nullable|string|max:255',
            'internal_status' => 'nullable|string|max:255',
        ]);

        $timestamp = Carbon::now(); // Keep this as a Carbon object
        $createdby = auth()->user()->name;

        $formatted = "note left by user {$createdby} on " 
           . $timestamp->format('d/m/y') 
           . " at " 
           . $timestamp->format('g:ia') 
           . "\n";

        if ($this->internal_status !== $this->original_internal_status) {
            $formatted .= "Internal Status Changed: {$this->internal_status}\n";
        }

        if ($this->uw_status !== $this->original_uw_status) {
            $formatted .= "U/W Status Changed: {$this->uw_status}\n";
        }

        $assignedToEmail = User::find($this->assigned_to)?->email;
        $assignedToName = User::find($this->assigned_to)?->name ?? 'User';

        if ($this->assigned_to != $this->original_assigned_to) {
            $assignedToName = User::find($this->assigned_to)?->name ?? 'User';
            $assignedToEmail = User::find($this->assigned_to)?->email;
            $formatted .= "Reassigned To: {$assignedToName}\n";
        }

        if (
            $this->reminder_date &&
            $this->reminder_date !== $this->original_reminder_date
        ) {
            $formatted .= "Reminder Date: {$this->reminder_date}\n";
        }

        $formatted .= $this->new_notes . "\n";
        $formatted .= str_repeat('-', 58) . "\n";

        $fullText = $formatted . $this->notes_history_text;

        $clientPolicy = \App\Models\ClientPolicies::find($this->policy_id);
        if ($clientPolicy) {
            $clientPolicy->uw_status = $this->uw_status;
            $clientPolicy->internal_status = $this->internal_status;
            $clientPolicy->save();
        }

        ProductNotesModel::create([
            'policy_id'     => $this->policy_id,
            'policy_type'   => $this->policy_type,
            'created_by'    => auth()->user()->id,
            'assigned_to'   => $this->assigned_to,
            'subject'       => $this->subject,
            'text'          => $fullText,
            'reminder_date' => $this->reminder_date
                ? Carbon::createFromFormat('d-m-Y', $this->reminder_date)
                : null,
            'first_name'    => explode(' ', $this->client_name)[0] ?? null,
            'last_name'     => explode(' ', $this->client_name)[1] ?? null,
        ]);

        $this->notes_history_text = ProductNotesModel::where('policy_id', $this->policy_id)
            ->orderByDesc('id')
            ->pluck('text')
            ->implode("\n\n");

        //$this->closeModal();
        $this->new_notes = null;
        $this->form_submitted = true;

        $link = url('/product-notes?editnote=' . $this->productnote);

        if (!empty($assignedToEmail)) {
            //$customeemail = "dotesting143143@gmail.com";
            Mail::to($assignedToEmail)->send(
                new AssignedNoteNotification(
                    $formatted,
                    auth()->user()->name,
                    $this->subject,
                    $assignedToName,
                    $link
                )
            );

        }

    }

}
