<?php

namespace App\Livewire;

use App\Models\ClientPolicies;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class InsurerReport extends Component
{
    public $insurers, $sdate, $edate, $propinsurer, $reportsort;
    public $searchApplied = false;
    public $insurerStats = [];
    public $totals = [];

    public function mount()
    {
        $this->loadReportData();
        $this->insurers = ClientPolicies::select(DB::raw("COALESCE(NULLIF(propinsurer, ''), 'Not Selected on Policies') as propinsurer"))
        ->distinct()
        ->orderBy('propinsurer')
        ->pluck('propinsurer');
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
            && empty($this->propinsurer) 
            && empty($this->reportsort);
    }

    public function loadReportData()
    {
       $query = ClientPolicies::select(
            DB::raw("COALESCE(NULLIF(client_policies.propinsurer, ''), 'Not Selected on Policies') as propinsurer"),
            'client_policies.policy_type',
            DB::raw('COUNT(*) as count'),
            DB::raw('SUM(client_policies.monthprem) as total_monthprem')
            );

            if (!empty($this->sdate)) {
                $query->whereDate('client_policies.created_at', '>=', $this->sdate);
            }

            if (!empty($this->edate)) {
                $query->whereDate('client_policies.created_at', '<=', $this->edate);
            }

            if (!empty($this->propinsurer)) {
                $query->where('client_policies.propinsurer', $this->propinsurer);
            }

           
            $rawData = $query
                ->groupBy('client_policies.propinsurer', 'client_policies.policy_type')
                ->get();

        $grouped = $rawData->groupBy('propinsurer');


        $this->insurerStats = [];
        $this->totals = [
            'total_count' => 0,
            'total_monthprem' => 0.00,
        ];

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

        foreach ($grouped as $insurer => $data) {
            $insurerData = [
                'name' => $insurer,
                'total_count' => 0,
                'total_monthprem' => 0.00,
            ];

            foreach ($policyMap as $short => $mapped) {
                $insurerData[$mapped . '_count'] = 0;
                $insurerData[$mapped . '_monthprem'] = 0.00;
            }

            foreach ($data as $row) {
                $mappedType = $policyMap[$row->policy_type] ?? null;

                if ($mappedType) {
                    $insurerData[$mappedType . '_count'] = $row->count;
                    $insurerData[$mappedType . '_monthprem'] = $row->total_monthprem;
                    $insurerData['total_count'] += $row->count;
                    $insurerData['total_monthprem'] += $row->total_monthprem;

                    $this->totals[$mappedType . '_count'] += $row->count;
                    $this->totals[$mappedType . '_monthprem'] += $row->total_monthprem;
                    $this->totals['total_count'] += $row->count;
                    $this->totals['total_monthprem'] += $row->total_monthprem;
                }
            }

            $this->insurerStats[] = $insurerData;
        }

        if (!empty($this->reportsort)) {
            $sortBy = $this->reportsort . '_monthprem';

            if (!empty($this->insurerStats) && array_key_exists($sortBy, $this->insurerStats[0])) {
                $this->insurerStats = collect($this->insurerStats)->sortByDesc(function ($insurer) use ($sortBy) {
                    return $insurer[$sortBy] ?? 0;
                })->values()->toArray();
            }
        }
    }

    public function render()
    {
        return view('livewire.insurer-report');
    }
}
