<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HousePolicy extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'int';
	protected $table = 'house_policy';
    
    protected $fillable = [
    	'id',
        'client_id',
        'type',
        'start_date',
        'renewal_date',
        'end_date',
        'term',
        'buildtype',
        'buildcost',
        'contcost',
        'curinsurer',
        'propinsurer',
        'propinsurer_num',
        'smokealarm1',
        'approved1',
        'locktypes',
        'conyear',
        'contype',
        'flatroof',
        'noclaims',
        'claimdetails',
        'housetype1',
        'tenants',
        'lettype',
        'pricepledge1',
        'monthprem',
        'payfreq',
        'upfrontpay1',
        'numpay',
        'needs_obj_text',
        'per_circ_text',
        'fin_sit_text',
        'risk_profile_text',
        'recommend_text',
    ];

    public function getFullPolicyId(): string
	{
	    return $this->getPrefix() . $this->id;
	}

	public function getPrefix() {
		return 'HP';
	}

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id');
    }

    public function getPolicyLabel() {
		return 'House Policy';
	}

    public function clientPolicy()
    {
        return $this->hasOne(\App\Models\ClientPolicies::class, 'policy_id', 'id');
    }
}
