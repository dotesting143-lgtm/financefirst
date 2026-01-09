<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerAccPolicy extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'int';
    protected $table = 'per_acc_policy';

    protected $fillable = [
    	'id',
        'client_id',
        'type',
        'start_date',
        'renewal_date',
        'end_date',
        'coveramt',
        'propinsurer',
        'propinsurer_num',
        'curinsurer',
        'bentype',
        'covtype',
        'startimm1',
        'pricepledge1',
        'monthprem',
        'payfreq',
        'upfrontpay1',
        'fdate',
        'numpay',
        'needs_obj_text',
        'per_circ_text',
        'fin_sit_text',
        'risk_profile_text',
        'recommend_text'
    ];

    public function getFullPolicyId(): string
	{
	    return $this->getPrefix() . $this->id;
	}

	public function getPrefix() {
		return 'PA';
	}

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id');
    }

    public function getPolicyLabel() {
		return 'Personal Accident Policy';
	}

    public function clientPolicy()
    {
        return $this->hasOne(\App\Models\ClientPolicies::class, 'policy_id', 'id');
    }
}
