<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientPolicies extends Model
{
    use HasFactory;
    
    protected $table = 'client_policies';

    protected $fillable = [
    	'id',
        'client_id',
        'policy_id',
        'policy_type',
        'internal_status',
        'uw_status',
        'active',
        'creation_date',
        'monthprem',
        'propinsurer',
        'propinsurer_num',
        'left_our_agency',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function getPolicy()
    {
        $policyModels = [
            'canonly_policy' => \App\Models\CancerPolicy::class,
            'house_policy' => \App\Models\HousePolicy::class,
            'life_policy' => \App\Models\LifePolicy::class,
            'mortgage_policy' => \App\Models\MortgagePolicy::class,
            'pension_policy' => \App\Models\PensionPolicy::class,
            'peracc_policy' => \App\Models\PerAccPolicy::class,
            'commercial_policy' => \App\Models\CommercialPolicy::class,
            'motor_policy' => \App\Models\MotorPolicy::class,
        ];

        $model = $policyModels[strtolower($this->policy_type)] ?? null;

        return $model ? $model::find($this->policy_id) : null;
    }
}
