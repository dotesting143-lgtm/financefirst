<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client as ClientModel;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class Clients extends Component
{
	use WithPagination;
	protected $paginationTheme = 'tailwind';

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

    public $isOpen = 0;
    public $brokers = [];
	public $brokersFilter = [];
    public $isCreateMode = false;

    protected $listeners = ['updateDateOfBirth'];
    public $searchApplied = false;

    public $inputString_source_of_lead;
    public $inputString_source_of_lead_sub;
    public $inputString_broker;
    public $inputString_name;
    public $inputString_policytype;
    public $inputString_product_type;
    public $inputString_county_of_birth;
    public $inputString_email;
    public $inputString_poid;
    public $inputStringphnum;
    public $inputString_ponum;
    public $inputString_address;
    public $inputString_yearc;
    public $closed_clients;
    public $policytype;
    public $propinsurer;
    public $product_type;
    public $isLoading = false;
    public $sort_by = 'Name';
    public $sort_direction = 'asc';
    public $activeProdTab = 'tab1';
    public bool $viewAll = false;

	public $phoneSearchResults = [];
	public $selectedClients = [];

	public $inputString_email_address;
	public $is_scheme = null;
	public $scheme_name = null;
	public $inputString_is_scheme;
	public $inputString_scheme_name;
	public $left_our_agency = 0;
	public $vulnerable_person;

	public $marketing_consent;
	public $marketing_email = 0;
	public $marketing_post = 0;
	public $marketing_text = 0;

	public $inputString_left_our_agency;
	public $inputString_vulnerable_person;


    protected $rules = [
	    // Primary Client Fields
	    'source_of_lead' => 'nullable|string|max:255',
	    'source_of_lead_sub' => 'nullable|string|max:255',
	    'broker' => 'nullable|string|max:255',
	    'title' => 'required|string|max:50',
	    'first_name' => 'required|string|max:255',
	    'last_name' => 'required|string|max:255',
	    'date_of_birth' => 'required|date_format:d/m/Y',
	    'gender' => 'required|string|max:50',
	    'relationship_status' => 'required|string|max:50',
	    'previous_surname' => 'nullable|string|max:255',
	    'address' => 'required|string|max:255',
	    'address2' => 'nullable|string|max:255',
	    'postcode' => 'nullable|string|max:20',
	    'county_of_birth' => 'nullable|string|max:50',
	    'eircode' => 'nullable|string|max:20',
	    'home_no' => 'nullable|string|max:20',
	    'work_no' => 'nullable|string|max:20',
	    'mobile_no' => 'required|string|max:20',
	    'email' => 'nullable|email|max:255|unique:clients,email',
	    'dependents' => 'nullable|integer|min:0',
	    'smoked_in_last_12_months' => 'nullable|boolean',
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
	    'is_scheme'   => 'nullable|boolean',
		'scheme_name' => 'nullable|string|max:255',
		'left_our_agency'    => 'nullable|boolean',
		'vulnerable_person' => 'nullable|string|in:Yes,No',
		'marketing_consent' => 'nullable|boolean',
		'marketing_email'   => 'nullable|boolean',
		'marketing_post'    => 'nullable|boolean',
		'marketing_text'    => 'nullable|boolean',

	    // Secondary Client Fields
	    'sec_title' => 'nullable|string|max:50',
	    'sec_first_name' => 'nullable|string|max:255',
	    'sec_last_name' => 'nullable|string|max:255',
	    'sec_date_of_birth' => 'nullable|date_format:d/m/Y',
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

	/*public function mount() {
		$this->brokers = User::orderBy('name', 'asc')->get();
		if (request()->has('openclient')) {
	        $clientId = request()->get('openclient');
	        $this->edit($clientId); // same method you already have
	    }
	}*/
	public function mount() {
	    $this->brokers = User::orderBy('name', 'asc')->get();

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
	    	$this->brokersFilter = $this->brokersFilter
		    ->map(fn ($u) => [
		        'id' => $u->id,
		        'name' => $u->name,
		    ])
		    ->prepend([
		        'id' => 'nobroker',
		        'name' => '-- NO BROKER --',
		    ]);
		}
	    
	    if (request()->has('openclient')) {
	        $clientId = request()->get('openclient');
	        $this->edit($clientId);
	        
	        if (request()->has('tab')) {
	            $this->setActiveTab(request()->get('tab'));
	        }
	    }
	}

	public function setActiveTab($tab)
	{
	    $this->activeProdTab = match($tab) {
	        'archived' => 'tab6',
	        'active' => 'tab4',
	        'products' => 'tab4',
	        default => 'tab1'
	    };
	}

	public function search()
    {
		if($this->getIsDisabledProperty()) {
            session()->flash('message', 'You must select atleast 1 filter.');
            return false;
        }
		
        $this->resetPage();
        $this->searchApplied = true;

        $this->dispatch('scroll-to-results');
		
    }

	public function getIsDisabledProperty()
    {
        return empty($this->inputString_source_of_lead) 
            && empty($this->inputString_name) 
            && empty($this->inputString_email_address)
            && empty($this->inputString_broker) 
            && empty($this->inputString_county_of_birth) 
            && empty($this->inputString_email) 
            && empty($this->inputString_poid)
            && empty($this->inputString_ponum) 
            && empty($this->inputString_policytype) 
            && empty($this->inputString_product_type) 
            && empty($this->closed_clients) 
            && empty($this->propinsurer) 
            && empty($this->inputStringphnum)
			&& empty($this->inputString_address)
            && empty($this->inputString_yearc)
            && empty($this->inputString_is_scheme)
    		&& empty($this->inputString_scheme_name)
    		&& empty($this->inputString_left_our_agency)
			&& empty($this->inputString_vulnerable_person);
    }

	public function render()
    {
		$query = ClientModel::from('clients')
    	->leftJoin('users', 'clients.broker', '=', 'users.id')
    	->select('clients.*', 'users.name as broker_name');

        $role = auth()->user()->role;
        $this->isLoading = true;
        if ($this->searchApplied) {
            if ($this->inputString_source_of_lead) {
                $query->where('source_of_lead', $this->inputString_source_of_lead);
            }
            if ($this->inputString_source_of_lead_sub) {
                $query->where('source_of_lead_sub', $this->inputString_source_of_lead_sub);
            }
			if ($this->inputString_name) {
			    $query->where(function ($q) {
			        $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$this->inputString_name}%"])
			          ->orWhereRaw("CONCAT(sec_first_name, ' ', sec_last_name) LIKE ?", ["%{$this->inputString_name}%"]);
			    });
			}

			if ($this->inputString_email_address) {
			    $query->where('clients.email', 'like', '%' . $this->inputString_email_address . '%');
			}
			
			$loggedInUser = auth()->user();

			if($role == 2) {
				$query->where('broker', $loggedInUser->id);
			} elseif ($role == 3 && $this->inputString_broker) {
                $query->where('broker', $this->inputString_broker);
            } elseif ($role == 3) {
			    // BrokerPlus: only self + brokers (role 2)
			    $brokerIds = User::where('role', 2)->pluck('id')->toArray();
			    $query->where(function ($q) use ($loggedInUser, $brokerIds) {
			        $q->where('broker', $loggedInUser->id)      // self
			          ->orWhereIn('broker', $brokerIds);        // brokers (role 2 only)
			    });
			} elseif ($this->inputString_broker === 'nobroker') {
			    // Clients with no broker OR deleted broker
			    $query->where(function ($q) {
			        $q->whereNull('clients.broker')
			          ->orWhereNull('users.id'); // broker deleted
			    });
			} elseif ($this->inputString_broker) {
			    // Normal broker filter
			    $query->where('clients.broker', $this->inputString_broker);
			}

            if ($this->inputString_county_of_birth) {
                $query->where('county_of_birth', $this->inputString_county_of_birth);
            }

			if ($this->inputString_email === 'Yes') {
				$query->whereNotNull('clients.email')->where('clients.email', '<>', '');
			} elseif ($this->inputString_email === 'No') {
				$query->where(function($q) {
					$q->whereNull('clients.email')->orWhere('clients.email', '');
				});
			}

            if ($this->inputStringphnum) {
			    $query->where(function ($q) {
			        $q->where('home_no', 'like', "%{$this->inputStringphnum}%")
			          ->orWhere('work_no', 'like', "%{$this->inputStringphnum}%")
			          ->orWhere('mobile_no', 'like', "%{$this->inputStringphnum}%");
			    });
			}
            if ($this->inputString_address) {
			    $query->where(DB::raw("CONCAT(address, ' ', address2)"), 'like', "%{$this->inputString_address}%");
			}

			if ($this->inputString_yearc) {
				$query->whereYear('clients.created_at', $this->inputString_yearc);
			}

            if ($this->inputString_policytype) {
	            $clientIds = DB::table('life_policy')
	                ->where('type', $this->inputString_policytype)
	                ->pluck('client_id') // Get matching client IDs
	                ->toArray();

	            $query->whereIn('clients.id', $clientIds); // Filter clients by found IDs
	        }
	        if ($this->propinsurer) {
	            $tables = [
	                'client_policies',
	            ];

	            $clientIds = collect();

	            foreach ($tables as $table) {
	                $clientIds = $clientIds->merge(
	                    DB::table($table)
	                        ->where('propinsurer', $this->propinsurer)
	                        ->pluck('client_id')
	                );
	            }

	            $query->whereIn('clients.id', $clientIds->unique()->toArray());
	        }
	        if ($this->inputString_ponum) {
	            $tables = [
	                'client_policies',
	            ];

	            $clientIds = collect();

	            foreach ($tables as $table) {
	                $clientIds = $clientIds->merge(
	                    DB::table($table)
	                        //->where('propinsurer_num', $this->inputString_ponum)
	                        ->where('propinsurer_num', 'like', "%{$this->inputString_ponum}%")
	                        ->pluck('client_id')
	                );
	            }

	            $query->whereIn('clients.id', $clientIds->unique()->toArray());
	        }
	        if ($this->inputString_poid) {
	            $tables = [
	                'client_policies',
	            ];

	            $clientIds = collect();

	            foreach ($tables as $table) {
	                $clientIds = $clientIds->merge(
	                    DB::table($table)
	                        ->where('policy_id', $this->inputString_poid)
	                        ->pluck('client_id')
	                );
	            }

	            $query->whereIn('clients.id', $clientIds->unique()->toArray());
	        }
	        if ($this->inputString_product_type) {
	            $productTables = [
	                'Cancer Only' => 'cancer_policy',
	                'Commercial Policy' => 'commercial_policy',
	                'House Policy' => 'house_policy',
	                'Life Policy' => 'life_policy',
	                'Motor Policy' => 'motor_policy',
	                'Mortgage' => 'mortgage_policy',
	                'Pension' => 'pension_policy',
	                'Personal Accident' => 'per_acc_policy',
	            ];

	            if (isset($productTables[$this->inputString_product_type])) {
	                $clientIds = DB::table($productTables[$this->inputString_product_type])
	                    ->pluck('client_id')
	                    ->toArray();

	                $query->whereIn('clients.id', $clientIds);
	            }
	        }
	        /*if ($this->closed_clients === 'No') {
			    $tables = ['client_policies'];
			    $closedClientIds = collect();
			    foreach ($tables as $table) {
			        $closedClientIds = $closedClientIds->merge(
			            DB::table($table)
			                ->where('internal_status', 'Closed') // assuming status column marks closed policies
			                ->pluck('client_id')
			        );
			    }
			    $query->whereNotIn('clients.id', $closedClientIds->unique()->toArray());
			}*/
			if ($this->closed_clients === 'No') {
			    $clientsWithNoActive = DB::table('client_policies')
		        ->select('client_id')
		        ->groupBy('client_id')
		        ->havingRaw("SUM(CASE WHEN internal_status = 'Active' THEN 1 ELSE 0 END) = 0")
		        ->pluck('client_id')
		        ->toArray();
			    $query->whereNotIn('clients.id', $clientsWithNoActive);
			}
            if ($this->sort_by) {
	            switch ($this->sort_by) {
	                case 'Name':
	                    $query->orderBy('first_name', 'asc'); // Sort by first name
	                    break;
	                case 'Service Length':
	                    $query->orderBy('length_service_yr', 'desc'); // Sort by service length
	                    break;
	                case 'Broker':
			            $query->orderBy('users.name', $this->sort_direction);
			            break;
			        default:
			            $query->orderBy($this->sort_by, $this->sort_direction);
			            break;
	            }
	        }

	        if ($this->inputString_is_scheme === 'Yes') {
			    $query->where('clients.is_scheme', 1);
			} elseif ($this->inputString_is_scheme === 'No') {
			    $query->where(function ($q) {
			        $q->where('clients.is_scheme', 0)
			          ->orWhereNull('clients.is_scheme');
			    });
			}

			if ($this->inputString_scheme_name) {
			    $query->where('clients.scheme_name', 'like', '%' . $this->inputString_scheme_name . '%');
			}

			if ($this->inputString_left_our_agency === 'Yes') {
			    $query->where('clients.left_our_agency', 1);
			} elseif ($this->inputString_left_our_agency === 'No') {
			    $query->where(function ($q) {
			        $q->where('clients.left_our_agency', 0)
			          ->orWhereNull('clients.left_our_agency');
			    });
			}

			if ($this->inputString_vulnerable_person === 'Yes') {
			    $query->where('clients.vulnerable_person', 'Yes');
			} elseif ($this->inputString_vulnerable_person === 'No') {
			    $query->where('clients.vulnerable_person', 'No');
			}


	        $this->dispatch('scrollToResults');
        }
        $this->isLoading = false;
        $allClientsQuery = clone $query;
        return view('livewire.clients', [
		    'allclients' => $this->searchApplied
		        ? ($this->viewAll ? $query->get() : $query->paginate(20))
		        : collect(),
		    'totalResults' => $this->searchApplied
            ? $allClientsQuery->count()
            : 0,
		]);
    }

    public function viewAllClients()
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
    public function create()
    {
    	$this->resetInputFields();
        $this->openModal();
        $this->isCreateMode = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
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
	        'client_id',  // Reset client ID
	        'isOpen',     // Close the modal
	    ]);

	    // Reset form fields dynamically based on rules
	    foreach ($this->rules as $field => $rule) {
	        $this->$field = null;
	    }

	    $this->js("
	        if (window.history.replaceState) {
	            const url = new URL(window.location);
	            url.searchParams.delete('openclient');
	            url.searchParams.delete('activetab');
	            url.searchParams.delete('tab');
	            window.history.replaceState({}, '', url);
	        }
	    ");
	}
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
	{
	    foreach ($this->rules as $field => $rule) {

	        // Reset booleans properly (checkboxes)
	        if (str_contains($rule, 'boolean')) {
	            $this->$field = false;
	        } else {
	            $this->$field = null;
	        }
	    }
	}

     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
	{
	    $this->rules['email'] = 'nullable|email|max:255|unique:clients,email,' . $this->client_id;
	    $this->rules['sec_email'] = 'nullable|email|max:255|unique:clients,email,' . $this->client_id;

	    // Make both DOB rules explicitly d/m/Y
	    $this->rules['date_of_birth'] = 'nullable|date_format:d/m/Y';
	    $this->rules['sec_date_of_birth'] = 'nullable|date_format:d/m/Y';

	    if ((int)$this->is_scheme === 1) {
		    $this->rules['scheme_name'] = 'required|string|max:255';
		}

	    $this->validate($this->rules);

	    $fields = $this->getFields();

	    // -------- Primary DOB --------
	    if (!empty($this->date_of_birth)) {
	        try {
	            $fields['date_of_birth'] = Carbon::createFromFormat('d/m/Y', $this->date_of_birth)
	                ->format('Y-m-d');
	        } catch (\Exception $e) {
	            \Log::error("Invalid Date Format for DOB: {$this->date_of_birth} - " . $e->getMessage());
	            $fields['date_of_birth'] = null;
	        }
	    } else {
	        $fields['date_of_birth'] = null;
	    }

	    // -------- Secondary DOB --------
	    if (!empty($this->sec_date_of_birth)) {
	        try {
	            // UI format: d/m/Y
	            $secdob = Carbon::createFromFormat('d/m/Y', $this->sec_date_of_birth)
	                ->format('Y-m-d');
	        } catch (\Exception $e) {
	            // Optional fallback if old data is Y-m-d
	            try {
	                $secdob = Carbon::createFromFormat('Y-m-d', $this->sec_date_of_birth)
	                    ->format('Y-m-d');
	            } catch (\Exception $e2) {
	                \Log::error("Invalid Date Format for sec DOB: {$this->sec_date_of_birth} - " . $e2->getMessage());
	                $secdob = null;
	            }
	        }

	        $fields['sec_date_of_birth'] = $secdob;
	    } else {
	        // IMPORTANT: send NULL, not ''
	        $fields['sec_date_of_birth'] = null;
	    }

	    // -------- Existing nullable dates --------
	    $nullableDates = ['date_estd', 'sec_date_estd'];
	    foreach ($nullableDates as $field) {
	        if (empty($this->$field)) {
	            $fields[$field] = null;
	        }
	    }

	    // -------- Existing ints / booleans --------
	    $nullableInts = ['active'];
	    foreach ($nullableInts as $field) {
	        if ($this->$field === '' || $this->$field === null) {
	            $fields[$field] = 1; // or 0 as you prefer
	        }
	    }

	    $fields['smoked_in_last_12_months'] =
	        $this->smoked_in_last_12_months !== '' ? (int) $this->smoked_in_last_12_months : 0;

	    $fields['sec_smoked_in_last_12_months'] =
	        $this->sec_smoked_in_last_12_months !== '' ? (int) $this->sec_smoked_in_last_12_months : null;

	    ClientModel::updateOrCreate(['id' => $this->client_id], $fields);

	    session()->flash('message',
	        $this->client_id ? 'Client data updated successfully.' : 'Client data created successfully.'
	    );

	    $this->closeModal();
	    $this->resetInputFields();
	}

    public function sortBy($field)
	{
	    if ($this->sort_by === $field) {
	        $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
	    } else {
	        $this->sort_by = $field;
	        $this->sort_direction = 'asc';
	    }

	    $this->resetPage();
	}

    private function getFields() {
        return collect($this->rules)->keys()->mapWithKeys(fn($field) => [$field => $this->$field])->toArray();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
	{
	    $client = ClientModel::findOrFail($id);
	    $this->client_id = $id;

	    // First load all non-date fields as-is
	    foreach ($this->rules as $field => $rule) {
	        if (in_array($field, ['date_of_birth', 'sec_date_of_birth', 'date_estd', 'sec_date_estd'])) {
	            // skip date fields here, we handle them below
	            continue;
	        }

	        if (isset($client->$field)) {
	            $this->$field = $client->$field;
	        }
	    }

	    // Now handle date fields: DB (Y-m-d) -> UI (d/m/Y)
	    $this->date_of_birth = $client->date_of_birth
	        ? Carbon::parse($client->date_of_birth)->format('d/m/Y')
	        : null;

	    $this->sec_date_of_birth = $client->sec_date_of_birth
	        ? Carbon::parse($client->sec_date_of_birth)->format('d/m/Y')
	        : null;

	    // Optional: if these are also text inputs with flatpickr in d/m/Y
	    $this->date_estd = $client->date_estd
	        ? Carbon::parse($client->date_estd)->format('d/m/Y')
	        : null;

	    $this->sec_date_estd = $client->sec_date_estd
	        ? Carbon::parse($client->sec_date_estd)->format('d/m/Y')
	        : null;

	    if (request()->has('tab')) {
	        $tab = request()->get('tab');
	        if ($tab === 'products') {
	            $this->activeProdTab = 'tab4';
	        }
	    }

	    $this->openModal();
	    $this->isCreateMode = false;
	}

     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        ClientModel::find($id)->delete();
        session()->flash('message', 'Client deleted successfully.');
    }

    public function getBroker($brokerId)
    {
        return User::where('id', $brokerId)->value('name');
    }

    public function searchPhoneNumbers()
	{
	    $search = $this->inputStringphnum;

	    if (strlen($search) > 0) {
	        $this->phoneSearchResults = ClientModel::query()
	            ->select('home_no', 'work_no', 'mobile_no')
	            ->where(function ($query) use ($search) {
	                $query->where('home_no', 'like', "{$search}%")
	                      ->orWhere('work_no', 'like', "{$search}%")
	                      ->orWhere('mobile_no', 'like', "{$search}%");
	            })
	            ->limit(10)
	            ->get()
	            ->map(function ($client) {
	                return collect([$client->home_no, $client->work_no, $client->mobile_no])
	                    ->filter()
	                    ->all();
	            })
	            ->flatten()
	            ->unique()
	            ->values()
	            ->toArray();
	    } else {
	        $this->phoneSearchResults = [];
	    }
	}

	public function selectPhoneNumber($number)
	{
	    $this->inputStringphnum = $number;
	    $this->phoneSearchResults = [];
	}

	public function bulkDelete()
	{
	    if (empty($this->selectedClients)) {
	        return;
	    }

	    // Delete all selected clients
	    ClientModel::whereIn('id', $this->selectedClients)->delete();

	    $count = count($this->selectedClients);

	    // Clear selection
	    $this->selectedClients = [];

	    // Reset pagination so we don't get to an empty page
	    $this->resetPage();

	    session()->flash('message', $count . ' client(s) deleted successfully.');
	}

	/**
	* Export selected clients as CSV and stream download.
	*/
	public function bulkExport()
	{
	    if (empty($this->selectedClients)) {
	        $this->dispatchBrowserEvent('notification', [
	            'type' => 'error',
	            'message' => 'No clients selected for export.'
	        ]);
	        return;
	    }

	    // Load selected clients with broker name
	    $clients = ClientModel::from('clients')
	        ->leftJoin('users', 'clients.broker', '=', 'users.id')
	        ->whereIn('clients.id', $this->selectedClients)
	        ->select('clients.*', 'users.name as broker_name')
	        ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), 'asc')
	        ->get();

	    $now = Carbon::now()->format('Ymd_His');
	    $filename = "clients_export_{$now}.csv";

	    $headers = [
	        'Content-Type' => 'text/csv; charset=UTF-8',
	        'Content-Disposition' => "attachment; filename=\"{$filename}\"",
	    ];

	    $callback = function () use ($clients) {
	        $out = fopen('php://output', 'w');

	        // UTF-8 BOM so Excel detects UTF-8 correctly
	        fwrite($out, "\xEF\xBB\xBF");

	        // CSV header row - single Name column
	        $headings = [
	            'ID',
	            'Name',
	            'Address 1',
	            'Address 2',
	            'Postcode',
	            'Eircode',
	            'County of Birth',
	            'Date of Birth',
	            'Home No',
	            'Work No',
	            'Mobile No',
	            'Email',
	            'Broker',
	        ];
	        fputcsv($out, $headings);

	        foreach ($clients as $c) {
	            $name = trim("{$c->first_name} {$c->last_name}");
	            $dob = $c->date_of_birth ? Carbon::parse($c->date_of_birth)->format('d/m/Y') : '';

	            $row = [
	                $c->id,
	                $name,
	                $c->address,
	                $c->address2,
	                $c->postcode,
	                $c->eircode,
	                $c->county_of_birth,
	                $dob,
	                $c->home_no,
	                $c->work_no,
	                $c->mobile_no,
	                $c->email,
	                $c->broker_name ?? '',
	            ];

	            fputcsv($out, $row);
	        }

	        fclose($out);
	    };

	    return response()->streamDownload($callback, $filename, $headers);
	}

	public function updatedIsScheme($value)
	{
	    if ((int) $value === 0) {
	        $this->scheme_name = null;
	    }
	}

	public function updatedInputStringIsScheme($value)
	{
	    if ($value !== 'Yes') {
	        $this->inputString_scheme_name = null;
	    }
	}

	public function updatedMarketingConsent($value)
	{
	    if ((int)$value !== 1) {
	        $this->marketing_email = 0;
	        $this->marketing_post  = 0;
	        $this->marketing_text  = 0;
	    }
	}

	public function updatedInputStringLeftOurAgency($value)
	{
	    if ($value === '') {
	        $this->inputString_left_our_agency = null;
	    }
	}

	public function updatedInputStringVulnerablePerson($value)
	{
	    if ($value === '') {
	        $this->inputString_vulnerable_person = null;
	    }
	}


}
