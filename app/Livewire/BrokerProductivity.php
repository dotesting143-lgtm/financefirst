<?php

namespace App\Livewire;

use App\Models\ClientPolicies;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class BrokerProductivity extends Component
{
    public $brokers, $sdate, $edate, $broker, $reportsort;
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
        return empty($this->sdate) 
            && empty($this->edate) 
            && empty($this->tbl_admin_users_id) 
            && empty($this->reportsort);
    }

    public function loadReportData()
    {
        /*$query = ClientPolicies::select(
            'clients.broker',
            'client_policies.policy_type',
            DB::raw('COUNT(*) as count'),
            DB::raw('SUM(client_policies.monthprem) as total_monthprem')
        )
        ->join('clients', 'clients.id', '=', 'client_policies.client_id');*/

        $query = ClientPolicies::select(
            DB::raw('COALESCE(clients.broker, "unknown") as broker'),
            'client_policies.policy_type',
            DB::raw('COUNT(*) as count'),
            DB::raw('SUM(client_policies.monthprem) as total_monthprem')
        )
        ->leftJoin('clients', 'clients.id', '=', 'client_policies.client_id');

        if (!empty($this->sdate)) {
            $query->whereDate('client_policies.created_at', '>=', $this->sdate);
        }

        if (!empty($this->edate)) {
            $query->whereDate('client_policies.created_at', '<=', $this->edate);
        }

        if (!empty($this->broker)) {
            $query->where('clients.broker', $this->broker);
        }

        // Then group and get the results
        $rawData = $query
            ->groupBy('clients.broker', 'client_policies.policy_type')
            ->get();

        $grouped = $rawData->groupBy('broker');

        $this->brokerStats = [];
        $this->totals = [
            'total_count' => 0,
            'total_monthprem' => 0.00,
        ];

        // Policy type map: DB name => short name for view
        $policyMap = [
            'life_policy' => 'life',
            'house_policy' => 'house',
            'motor_policy' => 'motor',
            'mortgage_policy' => 'mortgage',
            'commercial_policy' => 'commercial',
            'pension_policy' => 'pension',
            'peracc_policy' => 'pap',
            'canonly_policy' => 'cancer',
        ];

        foreach ($policyMap as $mappedType) {
            $this->totals[$mappedType . '_count'] = 0;
            $this->totals[$mappedType . '_monthprem'] = 0.00;
        }

        foreach ($grouped as $brokerId => $data) {
            $broker = User::find($brokerId);

            // Start with all zeros
            $brokerData = [
                'name' => $broker->name ?? 'Unknown',
                'total_count' => 0,
                'total_monthprem' => 0.00,
            ];

            foreach ($policyMap as $short => $mapped) {
                $brokerData[$mapped . '_count'] = 0;
                $brokerData[$mapped . '_monthprem'] = 0.00;
            }

            foreach ($data as $row) {
                $mappedType = $policyMap[$row->policy_type] ?? null;

                if ($mappedType) {
                    $brokerData[$mappedType . '_count'] = $row->count;
                    $brokerData[$mappedType . '_monthprem'] = $row->total_monthprem;
                    $brokerData['total_count'] += $row->count;
                    $brokerData['total_monthprem'] += $row->total_monthprem;

                    $this->totals[$mappedType . '_count'] += $row->count;
                    $this->totals[$mappedType . '_monthprem'] += $row->total_monthprem;
                    $this->totals['total_count'] += $row->count;
                    $this->totals['total_monthprem'] += $row->total_monthprem;
                }
            }

            $this->brokerStats[] = $brokerData;
        }
        if (!empty($this->reportsort)) {
            $sortBy = $this->reportsort . '_monthprem';

            // Debug to ensure the key exists in the array
            if (!empty($this->brokerStats) && array_key_exists($sortBy, $this->brokerStats[0])) {
                $this->brokerStats = collect($this->brokerStats)->sortByDesc(function ($broker) use ($sortBy) {
                    return $broker[$sortBy] ?? 0;
                })->values()->toArray();
            }
        }
    }


    public function render()
    {
        return view('livewire.broker-productivity');
    }
}
