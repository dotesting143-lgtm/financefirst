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
            $table->string('first_name', 30)->nullable()->change();
            $table->string('last_name', 30)->nullable()->change();
            $table->string('gender', 15)->nullable()->change();
            $table->string('relationship_status', 20)->nullable()->change();
            $table->string('previous_surname', 30)->nullable()->change();
            $table->string('postcode', 30)->nullable()->change();
            $table->string('county_of_birth', 20)->nullable()->change();
            $table->string('eircode', 30)->nullable()->change();
            $table->string('home_no', 30)->nullable()->change();
            $table->string('work_no', 30)->nullable()->change();
            $table->string('mobile_no', 30)->nullable()->change();
            $table->string('email', 50)->nullable()->change();
            $table->string('broker_email', 50)->nullable()->change();
            $table->string('employment_status', 30)->nullable()->change();
            $table->string('employment_type', 30)->nullable()->change();
            $table->string('overtime_freq', 30)->nullable()->change();
            $table->string('bonus_freq', 30)->nullable()->change();
            $table->string('commission_freq', 30)->nullable()->change();
            $table->string('occupation', 100)->nullable()->change();
            $table->string('employer', 100)->nullable()->change();
            $table->string('length_service_yr', 10)->nullable()->change();
            $table->string('length_service_mo', 10)->nullable()->change();
            $table->string('prev_occupation', 50)->nullable()->change();
            $table->string('prev_employer', 50)->nullable()->change();
            $table->string('prev_length_service_yr', 30)->nullable()->change();
            $table->string('prev_length_service_mo', 30)->nullable()->change();
            $table->string('business_name', 30)->nullable()->change();
            $table->string('business_nature', 30)->nullable()->change();
            $table->string('business_role', 30)->nullable()->change();
            $table->string('shareholding_pc', 30)->nullable()->change();
            $table->string('sec_title', 10)->nullable()->change();
            $table->string('sec_first_name', 30)->nullable()->change();
            $table->string('sec_last_name', 30)->nullable()->change();
            $table->date('sec_date_of_birth')->nullable()->change();
            $table->string('sec_gender', 15)->nullable()->change();
            $table->string('sec_relationship_status', 30)->nullable()->change();
            $table->string('sec_previous_surname', 30)->nullable()->change();
            $table->string('sec_postcode', 30)->nullable()->change();
            $table->string('sec_country_of_birth', 30)->nullable()->change();
            $table->string('sec_eircode', 30)->nullable()->change();
            $table->string('sec_home_no', 30)->nullable()->change();
            $table->string('sec_mobile_no', 30)->nullable()->change();
            $table->string('sec_email', 30)->nullable()->change();
            $table->string('sec_dependents', 30)->nullable()->change();
            $table->string('sec_employment_status', 30)->nullable()->change();
            $table->string('sec_employment_type', 30)->nullable()->change();
            $table->string('sec_overtime_freq', 30)->nullable()->change();
            $table->string('sec_bonus_freq', 30)->nullable()->change();
            $table->string('sec_commission_freq', 30)->nullable()->change();
            $table->string('sec_occupation', 30)->nullable()->change();
            $table->string('sec_employer', 30)->nullable()->change();
            $table->string('sec_length_service_yr', 30)->nullable()->change();
            $table->string('sec_length_service_mo', 30)->nullable()->change();
            $table->string('sec_prev_occupation', 30)->nullable()->change();
            $table->string('sec_prev_employer', 30)->nullable()->change();
            $table->string('sec_prev_length_service_yr', 30)->nullable()->change();
            $table->string('sec_prev_length_service_mo', 30)->nullable()->change();
            $table->string('sec_business_name', 30)->nullable()->change();
            $table->string('sec_business_nature', 30)->nullable()->change();
            $table->string('source_of_lead_sub', 30)->nullable()->change();
            $table->string('source_of_lead', 30)->nullable()->change();
            $table->string('broker', 10)->nullable()->change();
            $table->string('title', 10)->nullable()->change();

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
	            $table->string($column, 50)->nullable()->change();
	        }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
};
