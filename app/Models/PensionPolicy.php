<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PensionPolicy extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'int';
    protected $table = 'pension_policy';

    protected $fillable = [
    	'id',
        'client_id',
		'type',
		'start_date',
		'end_date',
		'term',
		'propinsurer',
		'propinsurer_num',
		'aptype',
		'sptype',
		'intname',
		'intnum',
		'regcon',
		'sincon',
		'retage',
		'monthprem',
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
		return 'PP';
	}

    public function client()
	{
	    return $this->belongsTo(\App\Models\Client::class, 'client_id');
	}

	public function getPolicyLabel() {
		return 'Pension Policy';
	}

	public function clientPolicy()
	{
	    return $this->hasOne(\App\Models\ClientPolicies::class, 'policy_id', 'id');
	}
}
