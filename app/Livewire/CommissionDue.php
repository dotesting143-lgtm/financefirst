<?php

namespace App\Livewire;

use App\Models\ClientPolicies;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CommissionDue extends Component
{
    public $brokers;
    public $broker = '';
    public $searchApplied = false;
    public $brokerStats = [];
    public $totals = [];

    public function mount()
    {
        $this->loadReportData();
        $this->brokers = User::orderBy('name', 'asc')->get();
    }

    public function search()
    {
        if($this->getIsDisabledProperty()) {
            session()->flash('message', 'You must select atleast 1 filter.');
            return false;
        }
        $this->searchApplied = true;
        $this->loadReportData();
    }
    public function getIsDisabledProperty()
    {
        return empty($this->broker);
    }

    public function loadReportData()
    {
        $query = ClientPolicies::select(
            DB::raw('COALESCE(clients.broker, "unknown") as broker'),
            DB::raw('COUNT(*) as count'),
            DB::raw('SUM(client_policies.monthprem) as total_monthprem')
        )
        ->leftJoin('clients', 'clients.id', '=', 'client_policies.client_id')
        ->where('client_policies.internal_status', 'commission due');

        if (!empty($this->broker)) {
            $query->where('clients.broker', $this->broker);
        }

        $rawData = $query
            ->groupBy('clients.broker')
            ->get();

        $this->brokerStats = [];
        $this->totals = [
            'total_count' => 0,
            'total_monthprem' => 0.00,
        ];

        foreach ($rawData as $row) {
            $broker = User::find($row->broker);

            $this->brokerStats[] = [
                'name' => $broker->name ?? 'Unknown',
                'total_count' => $row->count,
                'total_monthprem' => $row->total_monthprem,
            ];

            $this->totals['total_count'] += $row->count;
            $this->totals['total_monthprem'] += $row->total_monthprem;
        }
    }

    public function render()
    {
        return view('livewire.commission-due');
    }
}
