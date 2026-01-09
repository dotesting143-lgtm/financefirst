<?php

namespace App\Livewire;

use App\Models\ClientPolicies;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProductCounts extends Component
{
    public $reportData = [];
    public $totalCount;
    public $totalTurnover;
    public $brokers;
    public $searchApplied = false;

    public $sdate;
    public $edate;
    public $postcode;
    public $broker;
    public $uwstatus = [];
    public $intstatus = [];

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
            && empty($this->postcode) 
            && empty($this->tbl_admin_users_id) 
            && empty($this->notfiled) 
            && empty($this->pending) 
            && empty($this->approved) 
            && empty($this->furtherinfo) 
            && empty($this->declined) 
            && empty($this->new) 
            && empty($this->withuw) 
            && empty($this->commissiondue)
			&& empty($this->closed)
            && empty($this->cancelled);
    }

    public function loadReportData()
    {
        $query = ClientPolicies::query()
        ->leftJoin('clients', 'client_policies.client_id', '=', 'clients.id');

        if (!empty($this->sdate)) {
            $query->whereDate('client_policies.created_at', '>=', $this->sdate);
        }

        if (!empty($this->edate)) {
            $query->whereDate('client_policies.created_at', '<=', $this->edate);
        }

        if ($this->postcode) {
            $query->where('clients.postcode', 'like', '%' . $this->postcode . '%');
        }

        if ($this->broker) {
            $query->where('clients.broker', $this->broker);
        }

        if (!empty($this->uwstatus)) {
            $query->whereIn('uw_status', $this->uwstatus);
        }

        if (!empty($this->intstatus)) {
            $query->whereIn('internal_status', $this->intstatus);
        }

        $report = $query->selectRaw('policy_type, COUNT(*) as product_count, SUM(monthprem) as product_turnover')
            ->groupBy('policy_type')
            ->orderBy('policy_type', 'asc')
            ->get();

        $this->reportData = $report->map(function ($item) {
            $displayPolicyType = $item->policy_type === 'canonly_policy'
                ? 'Cancer Policy'
                : ucwords(str_replace('_', ' ', $item->policy_type));

            return [
                'policy_type' => $displayPolicyType,
                'product_count' => $item->product_count,
                'product_turnover' => number_format($item->product_turnover, 2),
            ];
        });

        $this->totalCount = $report->sum('product_count');
        $this->totalTurnover = number_format($report->sum('product_turnover'), 2);
    }

    public function render()
    {
        return view('livewire.product-counts');
    }
}
