<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LifePolicy extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'int';

    protected $table = 'life_policy';
  
    protected $fillable = [
    	'id',
        'client_id',
		'type',
		'start_date',
		'renewal_date',
		'end_date',
		'active',
		'term',
		'curinsurer',
		'propinsurer',
		'coveramt_1',
		'coveramt_2',
		'specill_1',
		'specill_2',
		'specill_type_11',
		'specill_type_21',
		'hoscash_1',
		'hoscash_2',
		'occclass1_11',
		'occclass1_21',
		'acccover_1',
		'acccover_2',
		'occclass2_11',
		'occclass2_21',
		'height_ft_1',
		'height_ft_2',
		'height_in_1',
		'height_in_2',
		'height_me_1',
		'height_me_2',
		'height_cm_1',
		'height_cm_2',
		'weight_st_1',
		'weight_st_2',
		'weight_lb_1',
		'weight_lb_2',
		'weight_kg_1',
		'weight_kg_2',
		'guarantee1',
		'infprotect1',
		'startimm1',
		'index1',
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
		return 'LFP';
	}

    public function client()
	{
	    return $this->belongsTo(\App\Models\Client::class, 'client_id');
	}

	public function getPolicyLabel() {
		return 'Life Policy';
	}

	public function clientPolicy()
	{
	    return $this->hasOne(\App\Models\ClientPolicies::class, 'policy_id', 'id');
	}
}
