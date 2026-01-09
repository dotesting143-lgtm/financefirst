<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PaymentTracker as PaymentTrackerModel;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\User;

class PaymentTracker extends Component
{
    use WithPagination;

    public $inputString_name;
    public $inputString_phone;
    public $inputString_policy;
    public $inputString_assigned_to_id;
    public $inputString_status;
    public $isSearchPerformed = false;

    public $client_id, $policy_no, $broker, $insurer, $premium, $last_paid, $arrears_amount, $payments_missed, $meeting_date, $follow_up_date, $status, $client_inactive, $notes;
    public $payment_id; // For edit functionality
    public $isOpen = false;
    public $isLoading = false;
    public $brokers = [];

    protected $rules = [
        'client_id' => 'required|exists:clients,id', // Make sure the clients table exists
        'policy_no' => 'required|string',
        'broker' => 'nullable|string',
        'insurer' => 'required|string',
        'premium' => 'required|numeric|min:0',
        'last_paid' => 'required|date_format:d-m-Y',
        'arrears_amount' => 'required|numeric|min:0',
        'payments_missed' => 'integer|min:0',
        'meeting_date' => 'required|date_format:d-m-Y',
        'follow_up_date' => 'nullable|date_format:d-m-Y',
        'status' => 'required|in:open,closed',
        'client_inactive' => 'nullable|boolean',
        'notes' => 'required|string',
    ];

    public function mount()
    {
        $this->brokers = User::getByRole(2); // Fetch brokers with role ID 2
    }

    public function render()
    {
        $this->isLoading = true;
        // Build the query for payment trackers
        $query = PaymentTrackerModel::query()
            ->with('client') // Eager load the client relationship
            ->latest();

        // Apply search filters
        if ($this->inputString_name || $this->inputString_phone || $this->inputString_policy || $this->inputString_assigned_to_id || $this->inputString_status) {
            $this->isSearchPerformed = true; // Set search state to true

            if ($this->inputString_name) {
                $query->whereHas('client', function ($q) {
                    $q->where('first_name', 'like', '%' . $this->inputString_name . '%')
                      ->orWhere('last_name', 'like', '%' . $this->inputString_name . '%');
                });
            }

            if ($this->inputString_phone) {
                $query->whereHas('client', function ($q) {
                    $q->where('home_no', 'like', '%' . $this->inputString_phone . '%')
                      ->orWhere('work_no', 'like', '%' . $this->inputString_phone . '%')
                      ->orWhere('mobile_no', 'like', '%' . $this->inputString_phone . '%');
                });
            }

            if ($this->inputString_policy) {
                $query->where('policy_no', 'like', '%' . $this->inputString_policy . '%');
            }

            if ($this->inputString_assigned_to_id) {
                $query->where('broker', $this->inputString_assigned_to_id);
            }

            if ($this->inputString_status) {
                $query->where('status', $this->inputString_status);
            }
        } else {
            $this->isSearchPerformed = false; // Set search state to false
        }

        // Fetch filtered payments
        $payments = $query->paginate(10);

        $this->dispatch('initDropdowns');
        $this->isLoading = false;
        return view('livewire.payment-tracker', [
            'payments' => $payments,
        ]);
    }

    public function create()
    {
        $this->resetInput();
        $this->client_inactive = 0;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate();

        $this->last_paid = $this->formatDateForDatabase($this->last_paid);
        $this->meeting_date = $this->formatDateForDatabase($this->meeting_date);
        $this->follow_up_date = $this->formatDateForDatabase($this->follow_up_date);

        PaymentTrackerModel::create($this->only([
            'client_id', 'policy_no', 'broker', 'insurer', 'premium', 'last_paid',
            'arrears_amount', 'payments_missed', 'meeting_date', 'follow_up_date',
            'status', 'client_inactive', 'notes'
        ]));

        session()->flash('message', 'Payment record created successfully.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $payment = PaymentTrackerModel::findOrFail($id);

        // Convert dates from Y-m-d (database format) to d-m-Y (frontend format)
        $this->last_paid = $payment->last_paid ? Carbon::parse($payment->last_paid)->format('d-m-Y') : null;
        $this->meeting_date = $payment->meeting_date ? Carbon::parse($payment->meeting_date)->format('d-m-Y') : null;
        $this->follow_up_date = $payment->follow_up_date ? Carbon::parse($payment->follow_up_date)->format('d-m-Y') : null;

        // Fill other fields
        $this->fill($payment->toArray());
        $this->payment_id = $id;
        $this->isOpen = true;
    }

    public function update()
    {
        $this->validate();

        // Convert dates to MySQL format (YYYY-MM-DD)
        $this->last_paid = $this->formatDateForDatabase($this->last_paid);
        $this->meeting_date = $this->formatDateForDatabase($this->meeting_date);
        $this->follow_up_date = $this->formatDateForDatabase($this->follow_up_date);

        $payment = PaymentTrackerModel::find($this->payment_id);
        if ($payment) {
            $payment->update($this->only([
                'client_id', 'policy_no', 'broker', 'insurer', 'premium', 'last_paid',
                'arrears_amount', 'payments_missed', 'meeting_date', 'follow_up_date',
                'status', 'client_inactive', 'notes'
            ]));
            session()->flash('message', 'Payment record updated successfully.');
        } else {
            session()->flash('error', 'Payment record not found.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        PaymentTrackerModel::find($id)?->delete();
        session()->flash('message', 'Payment record deleted successfully.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInput();
        $this->resetErrorBag(); // Clear validation errors
    }

    private function resetInput()
    {
        $this->reset(['client_id', 'policy_no', 'broker', 'insurer', 'premium', 'last_paid', 'arrears_amount', 'payments_missed', 'meeting_date', 'follow_up_date', 'status', 'client_inactive', 'notes', 'payment_id']);
    }

    /**
     * Convert date from frontend format (DD-MM-YYYY) to database format (YYYY-MM-DD).
     *
     * @param string|null $date
     * @return string|null
     */
    private function formatDateForDatabase($date)
    {
        if ($date) {
            return Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        }
        return null;
    }
}