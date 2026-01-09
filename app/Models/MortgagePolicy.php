<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MortgagePolicy extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'int';
    protected $table = 'mortgage_policy';
  
    protected $fillable = [
    	'id',
        'client_id',
		'type',
		'start_date',
		'end_date',
		'term',
		'monthprem',
		'coveramt',
		'propinsurer',
		'propinsurer_num',
		'propadd1',
		'propadd2',
		'proptype',
		'proprooms',
		'propcontype1',
		'propuse1',
		'propyear',
		'propyearsrun',
		'propprice',
		'propvalue',
		'guarname',
		'guardob',
		'guaradd1',
		'guaradd2',
		'guarhomeno',
		'guarmobile',
		'guaroccup',
		'guarincome',
		'guarrelapp',
		'guaremail',
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
		return 'MRP';
	}

    public function client()
	{
	    return $this->belongsTo(\App\Models\Client::class, 'client_id');
	}

	public function getPolicyLabel() {
		return 'Mortgage Policy';
	}

	public function clientPolicy()
	{
	    return $this->hasOne(\App\Models\ClientPolicies::class, 'policy_id', 'id');
	}
}
