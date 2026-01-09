<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client as ClientModel;
use App\Models\LifePolicy;
use App\Models\CancerPolicy;
use App\Models\MortgagePolicy;
use App\Models\HousePolicy;
use App\Models\CommercialPolicy;
use App\Models\PensionPolicy;
use App\Models\PerAccPolicy;
use App\Models\MotorPolicy;
use App\Models\ClientPolicies;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Products extends Component
{
    use WithPagination;

    public $clients, $first_name, $last_name, $client_id;

    public $source_of_lead, $source_of_lead_sub, $broker, $title, $date_of_birth, 
           $gender, $relationship_status, $previous_surname, $address, $address2, 
           $postcode, $county_of_birth, $eircode, $home_no, $work_no, $mobile_no, 
           $email, $dependents, $smoked_in_last_12_months = 0, $employment_status, 
           $employment_type, $net_salary_pm, $gross_basic_salary_pm, $overtime_pa, 
           $overtime_freq, $bonus_pa, $bonus_freq, $commission_pa, $commission_freq, 
           $gross_salary_total, $other_income_pa_non_rental, $other_income_pa_existing_rental, 
           $other_income_pa_anticipated_rental, $other_income_pa_total_rental, $occupation, 
           $employer, $employer_address1, $employer_address2, $length_service_yr, 
           $length_service_mo, $prev_occupation, $prev_employer, $prev_employer_address1, 
           $prev_employer_address2, $prev_length_service_yr, $prev_length_service_mo, 
           $business_name, $business_nature, $business_add1, $business_add2, $date_estd, 
           $business_role, $shareholding_pc, $net_profit_3yrs_avg, $drawings_3yrs_avg, $active = true;

    public $sec_title, $sec_first_name, $sec_last_name, $sec_date_of_birth, 
        $sec_gender, $sec_relationship_status, $sec_previous_surname, $sec_address, 
        $sec_address2, $sec_postcode, $sec_country_of_birth, $sec_eircode, 
        $sec_home_no, $sec_work_no, $sec_mobile_no, $sec_email, $sec_dependents, 
        $sec_smoked_in_last_12_months = 0, $sec_employment_status, $sec_employment_type, 
        $sec_net_salary_pm, $sec_gross_basic_salary_pm, $sec_overtime_pa, $sec_overtime_freq, 
        $sec_bonus_pa, $sec_bonus_freq, $sec_commission_pa, $sec_commission_freq, 
        $sec_gross_salary_total, $sec_other_income_pa_non_rental, $sec_other_income_pa_existing_rental, 
        $sec_other_income_pa_anticipated_rental, $sec_other_income_pa_total_rental, $sec_occupation, 
        $sec_employer, $sec_employer_address1, $sec_employer_address2, $sec_length_service_yr, 
        $sec_length_service_mo, $sec_prev_occupation, $sec_prev_employer, $sec_prev_employer_address1, 
        $sec_prev_employer_address2, $sec_prev_length_service_yr, $sec_prev_length_service_mo, 
        $sec_business_name, $sec_business_nature, $sec_business_add1, $sec_business_add2, 
        $sec_date_estd, $sec_business_role, $sec_shareholding_pc, $sec_net_profit_3yrs_avg, $sec_drawings_3yrs_avg;

    public $policytype, $inputString_ponum, $sdate, $fdate, $product_type, $propinsurer, $inputString_phnum, $inputString_street, $inputString_yearc, 
    $inputString_poid, $intstatus;
    public $users, $brokers_filter, $inputString_name, $searchContactNumber;
    public $searchApplied = false;
    public $search = '';
    public $isOpen = 0;
    public $activeProdTab = 'tab4';
    public bool $viewAll = false;
    public $brokers = [];
    public $brokersFilter = [];
    public $selectedPolicies = [];
    public $left_our_agency_filter = '';

    protected $rules = [
        // Primary Client Fields
        'source_of_lead' => 'nullable|string|max:255',
        'source_of_lead_sub' => 'nullable|string|max:255',
        'broker' => 'nullable|string|max:255',
        'title' => 'required|string|max:50',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'gender' => 'required|string|max:50',
        'relationship_status' => 'required|string|max:50',
        'previous_surname' => 'nullable|string|max:255',
        'address' => 'required|string|max:255',
        'address2' => 'nullable|string|max:255',
        'postcode' => 'required|string|max:20',
        'county_of_birth' => 'required|string|max:50',
        'eircode' => 'nullable|string|max:20',
        'home_no' => 'required|string|max:20',
        'work_no' => 'required|string|max:20',
        'mobile_no' => 'required|string|max:20',
        'email' => 'nullable|email|max:255|unique:clients,email',
        'dependents' => 'nullable|integer|min:0',
        'smoked_in_last_12_months' => 'required|boolean',
        'employment_status' => 'nullable|string|max:50',
        'employment_type' => 'nullable|string|max:50',
        'net_salary_pm' => 'nullable|numeric|min:0',
        'gross_basic_salary_pm' => 'nullable|numeric|min:0',
        'overtime_pa' => 'nullable|numeric|min:0',
        'overtime_freq' => 'nullable|string|max:50',
        'bonus_pa' => 'nullable|numeric|min:0',
        'bonus_freq' => 'nullable|string|max:50',
        'commission_pa' => 'nullable|numeric|min:0',
        'commission_freq' => 'nullable|string|max:50',
        'gross_salary_total' => 'nullable|numeric|min:0',
        'other_income_pa_non_rental' => 'nullable|numeric|min:0',
        'other_income_pa_existing_rental' => 'nullable|numeric|min:0',
        'other_income_pa_anticipated_rental' => 'nullable|numeric|min:0',
        'other_income_pa_total_rental' => 'nullable|numeric|min:0',
        'occupation' => 'nullable|string|max:255',
        'employer' => 'nullable|string|max:255',
        'employer_address1' => 'nullable|string|max:255',
        'employer_address2' => 'nullable|string|max:255',
        'length_service_yr' => 'nullable|integer|min:0',
        'length_service_mo' => 'nullable|integer|min:0',
        'prev_occupation' => 'nullable|string|max:255',
        'prev_employer' => 'nullable|string|max:255',
        'prev_employer_address1' => 'nullable|string|max:255',
        'prev_employer_address2' => 'nullable|string|max:255',
        'prev_length_service_yr' => 'nullable|integer|min:0',
        'prev_length_service_mo' => 'nullable|integer|min:0',
        'business_name' => 'nullable|string|max:255',
        'business_nature' => 'nullable|string|max:255',
        'business_add1' => 'nullable|string|max:255',
        'business_add2' => 'nullable|string|max:255',
        'date_estd' => 'nullable|date',
        'business_role' => 'nullable|string|max:255',
        'shareholding_pc' => 'nullable|numeric|min:0|max:100',
        'net_profit_3yrs_avg' => 'nullable|numeric|min:0',
        'drawings_3yrs_avg' => 'nullable|numeric|min:0',
        'active' => 'nullable|boolean',

        // Secondary Client Fields
        'sec_title' => 'nullable|string|max:50',
        'sec_first_name' => 'nullable|string|max:255',
        'sec_last_name' => 'nullable|string|max:255',
        'sec_date_of_birth' => 'nullable|date',
        'sec_gender' => 'nullable|string|max:50',
        'sec_relationship_status' => 'nullable|string|max:50',
        'sec_previous_surname' => 'nullable|string|max:255',
        'sec_address' => 'nullable|string|max:255',
        'sec_address2' => 'nullable|string|max:255',
        'sec_postcode' => 'nullable|string|max:20',
        'sec_country_of_birth' => 'nullable|string|max:50',
        'sec_eircode' => 'nullable|string|max:20',
        'sec_home_no' => 'nullable|string|max:20',
        'sec_work_no' => 'nullable|string|max:20',
        'sec_mobile_no' => 'nullable|string|max:20',
        'sec_email' => 'nullable|email|max:255|unique:clients,email',
        'sec_dependents' => 'nullable|integer|min:0',
        'sec_smoked_in_last_12_months' => 'nullable|boolean',
        'sec_employment_status' => 'nullable|string|max:50',
        'sec_employment_type' => 'nullable|string|max:50',
        'sec_net_salary_pm' => 'nullable|numeric|min:0',
        'sec_gross_basic_salary_pm' => 'nullable|numeric|min:0',
        'sec_overtime_pa' => 'nullable|numeric|min:0',
        'sec_overtime_freq' => 'nullable|string|max:50',
        'sec_bonus_pa' => 'nullable|numeric|min:0',
        'sec_bonus_freq' => 'nullable|string|max:50',
        'sec_commission_pa' => 'nullable|numeric|min:0',
        'sec_commission_freq' => 'nullable|string|max:50',
        'sec_gross_salary_total' => 'nullable|numeric|min:0',
        'sec_other_income_pa_non_rental' => 'nullable|numeric|min:0',
        'sec_other_income_pa_existing_rental' => 'nullable|numeric|min:0',
        'sec_other_income_pa_anticipated_rental' => 'nullable|numeric|min:0',
        'sec_other_income_pa_total_rental' => 'nullable|numeric|min:0',
        'sec_occupation' => 'nullable|string|max:255',
        'sec_employer' => 'nullable|string|max:255',
        'sec_employer_address1' => 'nullable|string|max:255',
        'sec_employer_address2' => 'nullable|string|max:255',
        'sec_length_service_yr' => 'nullable|integer|min:0',
        'sec_length_service_mo' => 'nullable|integer|min:0',
        'sec_prev_occupation' => 'nullable|string|max:255',
        'sec_prev_employer' => 'nullable|string|max:255',
        'sec_prev_employer_address1' => 'nullable|string|max:255',
        'sec_prev_employer_address2' => 'nullable|string|max:255',
        'sec_prev_length_service_yr' => 'nullable|integer|min:0',
        'sec_prev_length_service_mo' => 'nullable|integer|min:0',
        'sec_business_name' => 'nullable|string|max:255',
        'sec_business_nature' => 'nullable|string|max:255',
        'sec_business_add1' => 'nullable|string|max:255',
        'sec_business_add2' => 'nullable|string|max:255',
        'sec_date_estd' => 'nullable|date',
        'sec_business_role' => 'nullable|string|max:255',
        'sec_shareholding_pc' => 'nullable|numeric|min:0',
        'sec_net_profit_3yrs_avg' => 'nullable|numeric|min:0',
        'sec_drawings_3yrs_avg' => 'nullable|numeric|min:0',
    ];


    public $sortField = 'id'; // default sort field
    public $sortDirection = 'asc'; // default sort direction

    public function mount() {
        //$this->brokers = User::orderBy('name', 'asc')->get();
        $this->brokers = User::orderBy('name', 'asc')
            ->get()
            ->map(fn ($u) => [
                'id' => $u->id,
                'name' => $u->name,
            ])
            ->prepend([
                'id' => 'nobroker',
                'name' => '-- NO BROKER --',
            ]);

        $loggedInUser = auth()->user();

        if ($loggedInUser->role == 2) {
             $this->brokersFilter = User::where('id', $loggedInUser->id)
            ->orderBy('name', 'asc')
            ->get();
        } elseif ($loggedInUser->role == 3) {
            $this->brokersFilter = User::where(function ($q) use ($loggedInUser) {
                $q->where('role', 2)
                  ->orWhere('id', $loggedInUser->id);
            })
            ->orderBy('name', 'asc')
            ->get();
        } else {
            $this->brokersFilter = User::orderBy('name', 'asc')->get();
        }
    }

    public function productsearch()
    {
   
        /*if($this->getIsDisabledProperty()) {
            session()->flash('message', 'You must select atleast 1 filter.');
            return false;
        }*/
        $this->searchApplied = true;
        $this->resetPage();
    }

    public function getIsDisabledProperty()
    {
        return empty($this->inputString_name) 
            && empty($this->policytype) 
            && empty($this->sdate) 
            && empty($this->fdate) 
            && empty($this->product_type) 
            && empty($this->brokers_filter) 
            && empty($this->propinsurer) 
            && empty($this->inputString_phnum) 
            && empty($this->inputString_street) 
            && empty($this->inputString_yearc) 
            && empty($this->inputString_poid) 
            && empty($this->intstatus) 
            && empty($this->inputString_ponum);
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->reset([
            'client_id',  // Reset client ID
            'isOpen',     // Close the modal
        ]);

        foreach ($this->rules as $field => $rule) {
            $this->$field = null;
        }
    }

    public function edit($id)
    {
        $client = ClientModel::findOrFail($id);
        $this->client_id = $id;
        foreach ($this->rules as $field => $rule) {
            $this->$field = $client->$field;
        }
    
        $this->openModal();
    }

    public function render()
    {
        if(!$this->searchApplied) {
            return view('livewire.products', [
                'policies' => []
            ]);
        }
        $user = auth()->user();
        $role =$user->role;
        $brokerid = null;
        if($role == 2 ) {
           $brokerid = $user->id ;
        }
        
        $policies = collect();

        // Array of all policy models
        $policyModels = [
            LifePolicy::class,
            CancerPolicy::class,
            MortgagePolicy::class,
            HousePolicy::class,
            CommercialPolicy::class,
            PensionPolicy::class,
            PerAccPolicy::class,
            MotorPolicy::class,
        ];

        if ($this->product_type) {
            $policyModels = array_filter($policyModels, function ($model) {
                return class_basename($model) === $this->product_type;
            });
        }


        foreach ($policyModels as $model) {
            $brokerFilter = $brokerid ?? $this->brokers_filter;

            $query = $model::with('client')
                ->when($this->inputString_name, function ($query) {
                    return $query->whereHas('client', function ($q) {
                        $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $this->inputString_name . '%']);
                    });
                })
                ->when($this->inputString_phnum, function ($query) {
                    return $query->whereHas('client', function ($q) {
                        $q->where('home_no', 'like', '%' . $this->inputString_phnum . '%');
                    });
                })

                ->when($this->inputString_street, function ($query) {
                    return $query->whereHas('client', function ($q) {
                        $q->where('address', 'like', '%' . $this->inputString_street . '%');
                    });
                })
                ->when($brokerFilter === 'nobroker', function ($query) {
                    return $query->whereHas('client', function ($q) {
                        $q->whereNull('clients.broker')
                          ->orWhereNotIn('clients.broker', function ($sub) {
                              $sub->select('id')->from('users');
                          });
                    });
                })

                ->when($brokerFilter && $brokerFilter !== 'nobroker', function ($query) use ($brokerFilter) {
                    return $query->whereHas('client', function ($q) use ($brokerFilter) {
                        $q->where('broker', $brokerFilter);
                    });
                })

                ->when($this->policytype, function ($query) {
                    return $query->where('type', 'like', '%' . $this->policytype . '%');
                })

                ->when($this->sdate || $this->fdate, function ($query) {
                    try {
                        $startDate = $this->sdate ? \Carbon\Carbon::createFromFormat('d-m-Y', $this->sdate)->format('Y-m-d') : null;
                        $endDate   = $this->fdate ? \Carbon\Carbon::createFromFormat('d-m-Y', $this->fdate)->format('Y-m-d') : null;
                    } catch (\Exception $e) {
                        $startDate = $this->sdate;
                        $endDate   = $this->fdate;
                    }
                    if ($startDate && $endDate) {
                        return $query->whereBetween('end_date', [$startDate, $endDate]);
                    } elseif ($startDate) {
                        return $query->where('start_date', '>=', $startDate);
                    } elseif ($endDate) {
                        return $query->where('end_date', '<=', $endDate);
                    }
                })

                ->when($this->propinsurer, function ($query) {
                    return $query->where('propinsurer', 'like', '%' . $this->propinsurer . '%');
                })
                ->when($this->inputString_poid, function ($query) {
                    return $query->where('id', '=', $this->inputString_poid);
                })
                ->when($this->inputString_ponum, function ($query) {
                    return $query->whereHas('clientPolicy', function ($q) {
                        $q->where('propinsurer_num', 'like', '%' . $this->inputString_ponum . '%');
                    });
                })
                ->when($this->intstatus, function ($query) {
                    return $query->whereHas('clientPolicy', function ($q) {
                        $q->where('internal_status', 'like', '%' . $this->intstatus . '%');
                    });
                })
                ->when($this->inputString_yearc, function ($query) {
                    return $query->whereHas('clientPolicy', function ($q) {
                        $q->whereYear('creation_date', 'like', '%' . $this->inputString_yearc . '%');
                    });
                })
                ->when($this->left_our_agency_filter !== '', function ($query) {
                    $query->whereHas('clientPolicy', function ($q) {
                        $q->where(
                            'left_our_agency',
                            (int) $this->left_our_agency_filter
                        );
                    });
                });

            $policies = $policies->merge($query->get());
        }

        //Enrich each policy with derived attributes
        $policies->transform(function ($policy) {
            $policy->propinsurer     = $this->getPropInsurer($policy->id);
            $policy->propinsurer_num = $this->getPropInsurerNumByPolicyId($policy->id);
            $policy->internal_status = $this->getInternalStatus($policy->id);
            $policy->uw_status       = $this->getUwStatus($policy->id);
            $policy->broker          = $this->getBroker($policy->client_id);
            $policy->left_our_agency = (bool) ClientPolicies::where('policy_id', $policy->id)->value('left_our_agency');
            return $policy;
        });


        if ($this->sortField) {
            if ($this->sortDirection === 'asc') {
                $policies = $policies->sortBy(function ($policy) {
                    return data_get($policy, $this->sortField);
                });
            } else {
                $policies = $policies->sortByDesc(function ($policy) {
                    return data_get($policy, $this->sortField);
                });
            }
        }

        $totalItems = $policies->count();

        if ($this->viewAll) {
            return view('livewire.products', [
                'policies' => $policies,
                'totalResults' => $totalItems,
            ]);
        }

       

        $perPage = 20;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $totalItems = $policies->count();

        $currentItems = $policies->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedPolicies = new LengthAwarePaginator(
            $currentItems,
            $totalItems,
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('livewire.products', [
            'policies' => $paginatedPolicies,
            'totalResults' => $totalItems,
        ]);
    }

    public function viewAllProducts()
    {
        $this->viewAll = true;
    }

    public function resetPaginationView()
    {
        $this->viewAll = false;
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    private function getFields()
    {
        return collect($this->rules)
            ->keys()
            ->mapWithKeys(fn ($field) => [$field => $this->$field])
            ->toArray();
    }

    public function store()
    {
        // Make sure email uniqueness works with edit too
        $this->rules['email'] = 'nullable|email|max:255|unique:clients,email,' . $this->client_id;
        $this->rules['sec_email'] = 'nullable|email|max:255|unique:clients,email,' . $this->client_id;

        $this->validate($this->rules);

        $fields = $this->getFields();

        // Normalise nullable date fields if needed
        $nullableDates = ['date_of_birth', 'sec_date_of_birth', 'date_estd', 'sec_date_estd'];
        foreach ($nullableDates as $field) {
            if (empty($this->$field)) {
                $fields[$field] = null;
            }
        }

        // Normalise booleans / flags if you want (example)
        $fields['smoked_in_last_12_months'] =
            $this->smoked_in_last_12_months !== '' ? (int) $this->smoked_in_last_12_months : 0;

        $fields['sec_smoked_in_last_12_months'] =
            $this->sec_smoked_in_last_12_months !== '' ? (int) $this->sec_smoked_in_last_12_months : null;

        ClientModel::updateOrCreate(['id' => $this->client_id], $fields);

        session()->flash('message',
            $this->client_id ? 'Client data updated successfully.' : 'Client data created successfully.'
        );

        $this->closeModal();
    }


    public function getPropInsurerNumByPolicyId($policyId)
    {
        return ClientPolicies::where('policy_id', $policyId)->value('propinsurer_num');
    }

    public function getPropInsurer($policyId)
    {
        return ClientPolicies::where('policy_id', $policyId)->value('propinsurer');
    }

    public function getInternalStatus($policyId)
    {
        return ClientPolicies::where('policy_id', $policyId)->value('internal_status');
    }

    public function getUwStatus($policyId)
    {
        return ClientPolicies::where('policy_id', $policyId)->value('uw_status');
    }

    public function getBroker($clientId)
    {
        $brokerId = ClientModel::where('id', $clientId)->value('broker');
        return User::where('id', $brokerId)->value('name');
    }

    public function remove($policyId)
    {
        // Loop through all policy models to find the one matching this ID
        $policyModels = [
            \App\Models\LifePolicy::class,
            \App\Models\CancerPolicy::class,
            \App\Models\MortgagePolicy::class,
            \App\Models\HousePolicy::class,
            \App\Models\CommercialPolicy::class,
            \App\Models\PensionPolicy::class,
            \App\Models\PerAccPolicy::class,
            \App\Models\MotorPolicy::class,
        ];

        foreach ($policyModels as $model) {
            $policy = $model::find($policyId);

            if ($policy) {
                $clientPolicy = $policy->clientPolicy;
                if ($clientPolicy) {
                    $clientPolicy->delete();
                }

                $policy->delete();

                session()->flash('success', 'Policy deleted successfully');
                break;
            }
        }
    }

    public function bulkRemove()
    {
        if (empty($this->selectedPolicies)) {
            return;
        }

        $policyModels = [
            LifePolicy::class,
            CancerPolicy::class,
            MortgagePolicy::class,
            HousePolicy::class,
            CommercialPolicy::class,
            PensionPolicy::class,
            PerAccPolicy::class,
            MotorPolicy::class,
        ];

        $deletedCount = 0;

        foreach ($this->selectedPolicies as $policyId) {
            foreach ($policyModels as $model) {
                $policy = $model::find($policyId);

                if ($policy) {
                    $clientPolicy = $policy->clientPolicy;
                    if ($clientPolicy) {
                        $clientPolicy->delete();
                    }

                    $policy->delete();
                    $deletedCount++;
                    break; // move to next selected ID
                }
            }
        }

        // clear selection + reset page
        $this->selectedPolicies = [];
        $this->resetPage();

        if ($deletedCount > 0) {
            session()->flash('success', $deletedCount . ' policy(s) deleted successfully');
        }
    }

}
