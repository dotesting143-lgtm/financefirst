<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductNotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_id',
        'first_name',
        'last_name',
        'created_by',
		'assigned_to',
		'subject',
		'text',
		'active',
		'policy_type',
		'policy_id',
		'reminder_id',
		'reminder_date',
		'reminder_to',
    ];

    public function getFullPolicyId(): string
	{
	    return $this->getPrefix() . $this->policy_id;
	}

	public function getPrefix() {
		if($this->policy_type == 'life_policy') {
			return 'LFP';
		} elseif($this->policy_type == 'mortgage_policy') {
			return 'MRP';
		} elseif($this->policy_type == 'house_policy') {
			return 'HP';
		} elseif($this->policy_type == 'commercial_policy') {
			return 'CP';
		} elseif($this->policy_type == 'pension_policy') {
			return 'PP';
		} elseif($this->policy_type == 'canonly_policy') {
			return 'CA';
		} elseif($this->policy_type == 'peracc_policy') {
			return 'PA';
		} elseif($this->policy_type == 'motor_policy') {
			return 'MP';
		}
		return '';
	}

	public function getPolicy() {
		if($this->policy_type == 'life_policy') {
			return $this->lifePolicy();
		} elseif($this->policy_type == 'mortgage_policy') {
			return $this->mortgagePolicy();
		} elseif($this->policy_type == 'house_policy') {
			return $this->housePolicy();
		} elseif($this->policy_type == 'commercial_policy') {
			return $this->commercialPolicy();
		} elseif($this->policy_type == 'pension_policy') {
			return $this->pensionPolicy();
		} elseif($this->policy_type == 'canonly_policy') {
			return $this->cancerPolicy();
		} elseif($this->policy_type == 'peracc_policy') {
			return $this->perAccPolicy();
		} elseif($this->policy_type == 'motor_policy') {
			return $this->motorPolicy();
		}
		return null;
	}

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function assignTo()
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to');
    }

    public function lifePolicy()
	{
	    return $this->belongsTo(\App\Models\LifePolicy::class, 'policy_id');
	}

	public function mortgagePolicy()
	{
	    return $this->belongsTo(\App\Models\MortgagePolicy::class, 'policy_id');
	}

	public function housePolicy()
	{
	    return $this->belongsTo(\App\Models\HousePolicy::class, 'policy_id');
	}

	public function commercialPolicy()
	{
	    return $this->belongsTo(\App\Models\CommercialPolicy::class, 'policy_id');
	}

	public function pensionPolicy()
	{
	    return $this->belongsTo(\App\Models\PensionPolicy::class, 'policy_id');
	}

	public function cancerPolicy()
	{
	    return $this->belongsTo(\App\Models\CancerPolicy::class, 'policy_id');
	}

	public function perAccPolicy()
	{
	    return $this->belongsTo(\App\Models\PerAccPolicy::class, 'policy_id');
	}

	public function motorPolicy()
	{
	    return $this->belongsTo(\App\Models\MotorPolicy::class, 'policy_id');
	}

	public function getLastUpdatedDate()
	{
	    $date = self::where('policy_id', $this->policy_id)
	                ->orderByDesc('updated_at')
	                ->value('updated_at');

	    return $date ? \Carbon\Carbon::parse($date)->format('d-m-Y') : null;
	}

	public function getClientId()
	{
	    // Simple direct query approach
	    $clientPolicy = \App\Models\ClientPolicies::where('policy_id', $this->policy_id)->first();
	    
	    if ($clientPolicy && $clientPolicy->client_id) {
	        return $clientPolicy->client_id;
	    }
	    
	    return null;
	}

}
