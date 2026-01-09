<?php

namespace App\Livewire;

use App\Models\ClientPolicies;
use Livewire\Component;
use App\Models\User;
use App\Models\Client;
use App\Models\ProductNotes;
use Illuminate\Support\Facades\DB;


class PaymentTrackerReport extends Component
{   
    public $brokers, $sdate, $edate, $broker, $propinsurer, $status;
    public $searchApplied = false;
    public $reportData = [];

    protected $rules = [
        'sdate' => 'required|date',
        'edate' => 'required|date',
        'broker' => 'nullable',
        'propinsurer' => 'nullable',
        'status' => 'nullable',
    ];

    protected $messages = [
        'sdate.required' => 'The start date is required.',
        'edate.required' => 'The end date is required.',
    ];

    public function mount()
    {
        $this->loadReportData();
        $this->brokers = User::orderBy('name', 'asc')->get();
    }

    public function search()
    {
        $this->validate();
        $this->searchApplied = true;
        $this->loadReportData();
    }

    public function loadReportData()
    {
        $query = ClientPolicies::query()
        ->select(
            'clients.first_name as client_first_name',
            'clients.last_name as client_last_name',
            'users.name as broker_name', // changed here
            'client_policies.policy_id',
            'product_notes.text'
        )
        ->join('clients', 'clients.id', '=', 'client_policies.client_id')
        ->leftJoin('users', 'users.id', '=', 'clients.broker') // join users table here
        ->leftJoin('product_notes', function($join) {
            $join->on('product_notes.policy_id', '=', 'client_policies.policy_id');
        });

        if (!empty($this->sdate)) {
            $query->whereDate('client_policies.created_at', '>=', $this->sdate);
        }
        if (!empty($this->edate)) {
            $query->whereDate('client_policies.created_at', '<=', $this->edate);
        }
        if (!empty($this->propinsurer)) {
            $query->where('client_policies.propinsurer', $this->propinsurer);
        }
        if (!empty($this->broker)) {
            $query->where('clients.broker', $this->broker);
        }
        if (!empty($this->status)) {
            $query->where('client_policies.internal_status', $this->status);
        }

        $this->reportData = $query->get();
    }

    public function render()
    {
        return view('livewire.payment-tracker-report');
    }
}
