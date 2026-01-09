<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'source_of_lead',
        'source_of_lead_sub',
        'broker',
        'title',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'relationship_status',
        'previous_surname',
        'address',
        'address2',
        'postcode',
        'county_of_birth',
        'eircode',
        'home_no',
        'work_no',
        'mobile_no',
        'email',
        'broker_email',
        'dependents',
        'smoked_in_last_12_months',
        'active',
        'is_scheme',
        'scheme_name',
        'left_our_agency',
        'vulnerable_person',
        'marketing_consent',
        'marketing_email',
        'marketing_post',
        'marketing_text',
        'employment_status',
        'employment_type',
        'net_salary_pm',
        'gross_basic_salary_pm',
        'overtime_pa',
        'overtime_freq',
        'bonus_pa',
        'bonus_freq',
        'commission_pa',
        'commission_freq',
        'gross_salary_total',
        'other_income_pa_non_rental',
        'other_income_pa_existing_rental',
        'other_income_pa_anticipated_rental',
        'other_income_pa_total_rental',
        'occupation',
        'employer',
        'employer_address1',
        'employer_address2',
        'length_service_yr',
        'length_service_mo',
        'prev_occupation',
        'prev_employer',
        'prev_employer_address1',
        'prev_employer_address2',
        'prev_length_service_yr',
        'prev_length_service_mo',
        'business_name',
        'business_nature',
        'business_add1',
        'business_add2',
        'date_estd',
        'business_role',
        'shareholding_pc',
        'net_profit_3yrs_avg',
        'drawings_3yrs_avg',
        'sec_title', 'sec_first_name', 'sec_last_name', 'sec_date_of_birth', 
        'sec_gender', 'sec_relationship_status', 'sec_previous_surname', 
        'sec_address', 'sec_address2', 'sec_postcode', 'sec_country_of_birth', 
        'sec_eircode', 'sec_home_no', 'sec_work_no', 'sec_mobile_no', 
        'sec_email', 'sec_dependents', 'sec_smoked_in_last_12_months', 
        'sec_employment_status', 'sec_employment_type', 'sec_net_salary_pm', 
        'sec_gross_basic_salary_pm', 'sec_overtime_pa', 'sec_overtime_freq', 
        'sec_bonus_pa', 'sec_bonus_freq', 'sec_commission_pa', 
        'sec_commission_freq', 'sec_gross_salary_total', 'sec_other_income_pa_non_rental', 
        'sec_other_income_pa_existing_rental', 'sec_other_income_pa_anticipated_rental', 
        'sec_other_income_pa_total_rental', 'sec_occupation', 'sec_employer', 
        'sec_employer_address1', 'sec_employer_address2', 'sec_length_service_yr', 
        'sec_length_service_mo', 'sec_prev_occupation', 'sec_prev_employer', 
        'sec_prev_employer_address1', 'sec_prev_employer_address2', 
        'sec_prev_length_service_yr', 'sec_prev_length_service_mo', 
        'sec_business_name', 'sec_business_nature', 'sec_business_add1', 
        'sec_business_add2', 'sec_date_estd', 'sec_business_role', 
        'sec_shareholding_pc', 'sec_net_profit_3yrs_avg', 'sec_drawings_3yrs_avg'
    ];

    protected $casts = [
        'left_our_agency'    => 'boolean',
        'marketing_consent' => 'boolean',
        'marketing_email'   => 'boolean',
        'marketing_post'    => 'boolean',
        'marketing_text'    => 'boolean',
        'is_scheme'         => 'boolean',
    ];

    public function policies()
    {
        return $this->hasMany(LifePolicy::class, 'client_id')
            ->union($this->hasMany(CancerPolicy::class, 'client_id'))
            ->union($this->hasMany(MortgagePolicy::class, 'client_id'))
            ->union($this->hasMany(HousePolicy::class, 'client_id'))
            ->union($this->hasMany(CommercialPolicy::class, 'client_id'))
            ->union($this->hasMany(PensionPolicy::class, 'client_id'))
            ->union($this->hasMany(PerAccPolicy::class, 'client_id'))
            ->union($this->hasMany(MotorPolicy::class, 'client_id'));
    }

}
