<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialPolicy extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'int';
    protected $table = 'commercial_policy';

    protected $fillable = [
    	'id',
        'client_id',
		'type',
		'start_date',
		'renewal_date',
		'end_date',
		'term',
		'busdesc',
		'curinsurer',
		'propinsurer',
		'propinsurer_num',
		'targetprem',
		'locdesc',
		'conwalls',
		'confloor',
		'conroof',
		'constory',
		'conheattype',
		'extblank',
		'secalarm',
		'seccctv',
		'secwin',
		'secdoor',
		'dambuild',
		'damfix',
		'damstock',
		'damplant',
		'damgross',
		'damworkings',
		'damrent',
		'damempliab',
		'damclwage',
		'damoswage',
		'damppl',
		'damturnover',
		'damcomputer',
		'dammoney',
		'claimdate1',
		'claimdetails1',
		'claimamt1',
		'claimreserv1',
		'claimdate2',
		'claimdetails2',
		'claimamt2',
		'claimreserv2',
		'claimdate3',
		'claimdetails3',
		'claimamt3',
		'claimreserv3',
		'claimdate4',
		'claimdetails4',
		'claimamt4',
		'claimreserv4',
		'claimdate5',
		'claimdetails5',
		'claimamt5',
		'claimreserv5',
		'pricepledge1',
		'po_monthprem',
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
		return 'CP';
	}

    public function client()
	{
	    return $this->belongsTo(\App\Models\Client::class, 'client_id');
	}

	public function getPolicyLabel() {
		return 'Commercial Policy';
	}

	public function clientPolicy()
	{
	    return $this->hasOne(\App\Models\ClientPolicies::class, 'policy_id', 'id');
	}
}
