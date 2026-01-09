<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorPolicy extends Model
{
	use HasFactory;
	public $incrementing = false;
    protected $keyType = 'int';
	protected $table = 'motor_policy';

    protected $fillable = [
    	'id',
        'client_id',
		'type',
		'start_date',
		'renewal_date',
		'end_date',
		'term',
		'motortype',
		'value',
		'insuretype',
		'curinsurer',
		'propinsurer',
		'propinsurer_num',
		'make',
		'model',
		'year',
		'registration',
		'security',
		'parking',
		'license1',
		'licenseyears',
		'noclaims',
		'claimdetails',
		'pricepledge1',
		'monthprem',
		'payfreq',
		'upfrontpay1',
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
		return 'MP';
	}

    public function client()
	{
	    return $this->belongsTo(\App\Models\Client::class, 'client_id');
	}

	public function getPolicyLabel() {
		return 'Motor Policy';
	}

	public function clientPolicy()
	{
	    return $this->hasOne(\App\Models\ClientPolicies::class, 'policy_id', 'id');
	}
}
