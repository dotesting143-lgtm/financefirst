<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
	        $table->string('first_name', 30)->change();
            $table->string('last_name', 30)->change();
            $table->string('gender', 15)->change();
            $table->string('relationship_status', 20)->change();
            $table->string('previous_surname', 30)->change();
            $table->string('postcode', 30)->change();
            $table->string('county_of_birth', 20)->change();
            $table->string('eircode', 30)->change();
            $table->string('home_no', 30)->change();
            $table->string('work_no', 30)->change();
            $table->string('mobile_no', 30)->change();
            $table->string('email', 50)->change();
            $table->string('broker_email', 50)->change();
            $table->string('employment_status', 30)->change();
            $table->string('employment_type', 30)->change();
            $table->string('overtime_freq', 30)->change();
            $table->string('bonus_freq', 30)->change();
            $table->string('commission_freq', 30)->change();
            $table->string('occupation', 100)->change();
            $table->string('employer', 100)->change();
            $table->string('length_service_yr', 10)->change();
            $table->string('length_service_mo', 10)->change();
            $table->string('prev_occupation', 50)->change();
            $table->string('prev_employer', 50)->change();
            $table->string('prev_length_service_yr', 30)->change();
            $table->string('prev_length_service_mo', 30)->change();
            $table->string('business_name', 30)->change();
            $table->string('business_nature', 30)->change();
            $table->string('business_role', 30)->change();
            $table->string('shareholding_pc', 30)->change();
            $table->string('sec_title', 10)->change();
            $table->string('sec_first_name', 30)->change();
            $table->string('sec_last_name', 30)->change();
            $table->date('sec_date_of_birth')->change();
            $table->string('sec_gender', 15)->change();
            $table->string('sec_relationship_status', 30)->change();
            $table->string('sec_previous_surname', 30)->change();
            $table->string('sec_postcode', 30)->change();
            $table->string('sec_country_of_birth', 30)->change();
            $table->string('sec_eircode', 30)->change();
            $table->string('sec_home_no', 30)->change();
            $table->string('sec_mobile_no', 30)->change();
            $table->string('sec_email', 30)->change();
            $table->string('sec_dependents', 30)->change();
            $table->string('sec_employment_status', 30)->change();
            $table->string('sec_employment_type', 30)->change();
            $table->string('sec_overtime_freq', 30)->change();
            $table->string('sec_bonus_freq', 30)->change();
            $table->string('sec_commission_freq', 30)->change();
            $table->string('sec_occupation', 30)->change();
            $table->string('sec_employer', 30)->change();
            $table->string('sec_length_service_yr', 30)->change();
            $table->string('sec_length_service_mo', 30)->change();
            $table->string('sec_prev_occupation', 30)->change();
            $table->string('sec_prev_employer', 30)->change();
            $table->string('sec_prev_length_service_yr', 30)->change();
            $table->string('sec_prev_length_service_mo', 30)->change();
            $table->string('sec_business_name', 30)->change();
            $table->string('sec_business_nature', 30)->change();

            $columns = [
	            'gross_salary_total',
	            'sec_other_income_pa_non_rental',
	            'sec_other_income_pa_existing_rental',
	            'sec_other_income_pa_anticipated_rental',
	            'sec_other_income_pa_total_rental',
	            'sec_commission_pa',
	            'sec_bonus_pa',
	            'sec_overtime_pa',
	            'sec_gross_basic_salary_pm',
	            'sec_net_salary_pm',
	            'sec_net_profit_3yrs_avg',
	            'sec_drawings_3yrs_avg',
	            'net_profit_3yrs_avg',
	            'drawings_3yrs_avg',
	            'gross_salary_total',
	            'other_income_pa_non_rental',
	            'other_income_pa_existing_rental',
	            'other_income_pa_anticipated_rental',
	            'other_income_pa_total_rental',
	            'commission_pa',
	            'bonus_pa',
	            'overtime_pa',
	            'gross_basic_salary_pm',
	            'net_salary_pm',
	        ];

	        foreach ($columns as $column) {
	            $table->string($column, 50)->change();
	        }
	    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $columns = [
	            'gross_salary_total',
	            'sec_other_income_pa_non_rental',
	            'sec_other_income_pa_existing_rental',
	            'sec_other_income_pa_anticipated_rental',
	            'sec_other_income_pa_total_rental',
	            'sec_commission_pa',
	            'sec_bonus_pa',
	            'sec_overtime_pa',
	            'sec_gross_basic_salary_pm',
	            'sec_net_salary_pm',
	            'sec_net_profit_3yrs_avg',
	            'sec_drawings_3yrs_avg',
	            'net_profit_3yrs_avg',
	            'drawings_3yrs_avg',
	            'gross_salary_total',
	            'other_income_pa_non_rental',
	            'other_income_pa_existing_rental',
	            'other_income_pa_anticipated_rental',
	            'other_income_pa_total_rental',
	            'commission_pa',
	            'bonus_pa',
	            'overtime_pa',
	            'gross_basic_salary_pm',
	            'net_salary_pm',
	        ];

	        foreach ($columns as $column) {
	            $table->decimal($column, 10, 2)->change();
	        }
        });
    }
};
