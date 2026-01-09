<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CancerPolicy extends Model
{
	use HasFactory;
	public $incrementing = false;
    protected $keyType = 'int';
	protected $table = 'cancer_policy';
    protected $fillable = [
    	'id',
        'client_id',
        'type',
        'start_date',
		'renewal_date',
		'end_date',
		'term',
		'curinsurer',
		'propinsurer',
		'propinsurer_num',
		'cover',
		'bentype',
		'covtype',
		'startimm1',
		'payfreq',
		'upfrontpay1',
		'monthprem',
		'fdate1',
		'numpay',
		'pricepledge1',
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
		return 'CA';
	}

    public function client()
	{
	    return $this->belongsTo(\App\Models\Client::class, 'client_id');
	}

	public function getPolicyLabel() {
		return 'Cancer Policy';
	}

	public function clientPolicy()
	{
	    return $this->hasOne(\App\Models\ClientPolicies::class, 'policy_id', 'id');
	}
}
