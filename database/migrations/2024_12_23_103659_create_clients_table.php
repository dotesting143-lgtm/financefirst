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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('source_of_lead')->nullable(); // Dropdown
            $table->string('broker')->nullable(); // Dropdown
            $table->string('title')->nullable(); // Text
            $table->string('first_name'); // Required text
            $table->string('last_name'); // Required text
            $table->date('date_of_birth')->nullable(); // Datepicker
            $table->string('gender')->nullable(); // Dropdown
            $table->string('relationship_status')->nullable(); // Dropdown
            $table->string('previous_surname')->nullable(); // Text
            $table->text('address')->nullable(); // Textarea
            $table->string('postcode')->nullable(); // Text
            $table->string('county_of_birth')->nullable(); // Dropdown
            $table->string('eircode')->nullable(); // Text
            $table->string('home_no')->nullable(); // Text
            $table->string('work_no')->nullable(); // Text
            $table->string('mobile_no')->nullable(); // Text
            $table->string('email')->unique(); // Email (unique)
            $table->integer('dependents')->nullable(); // Numeric
            $table->boolean('smoked_in_last_12_months')->default(0);
            $table->boolean('active')->default(true);
            $table->text('address2')->nullable();
            $table->string('broker_email')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('employment_type')->nullable();
            $table->decimal('net_salary_pm', 10, 2)->nullable();
            $table->decimal('gross_basic_salary_pm', 10, 2)->nullable();
            $table->decimal('overtime_pa', 10, 2)->nullable();
            $table->string('overtime_freq')->nullable();
            $table->decimal('bonus_pa', 10, 2)->nullable();
            $table->string('bonus_freq')->nullable();
            $table->decimal('commission_pa', 10, 2)->nullable();
            $table->string('commission_freq')->nullable();
            $table->decimal('gross_salary_total', 10, 2)->nullable();
            $table->decimal('other_income_pa_non_rental', 10, 2)->nullable();
            $table->decimal('other_income_pa_existing_rental', 10, 2)->nullable();
            $table->decimal('other_income_pa_anticipated_rental', 10, 2)->nullable();
            $table->decimal('other_income_pa_total_rental', 10, 2)->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer')->nullable();
            $table->text('employer_address1')->nullable();
            $table->text('employer_address2')->nullable();
            $table->string('length_service_yr')->nullable();
            $table->string('length_service_mo')->nullable();
            $table->string('prev_occupation')->nullable();
            $table->string('prev_employer')->nullable();
            $table->text('prev_employer_address1')->nullable();
            $table->text('prev_employer_address2')->nullable();
            $table->string('prev_length_service_yr')->nullable();
            $table->string('prev_length_service_mo')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_nature')->nullable();
            $table->text('business_add1')->nullable();
            $table->text('business_add2')->nullable();
            $table->date('date_estd')->nullable();
            $table->string('business_role')->nullable();
            $table->string('shareholding_pc')->nullable();
            $table->decimal('net_profit_3yrs_avg', 10, 2)->nullable();
            $table->decimal('drawings_3yrs_avg', 10, 2)->nullable();
            $table->string('sec_title')->nullable();
            $table->string('sec_first_name')->nullable();
            $table->string('sec_last_name')->nullable();
            $table->string('sec_date_of_birth')->nullable();
            $table->string('sec_gender')->nullable();
            $table->string('sec_relationship_status')->nullable();
            $table->string('sec_previous_surname')->nullable();
            $table->text('sec_address')->nullable();
            $table->text('sec_address2')->nullable();
            $table->string('sec_postcode')->nullable();
            $table->string('sec_country_of_birth')->nullable();
            $table->string('sec_eircode')->nullable();
            $table->string('sec_home_no')->nullable();
            $table->string('sec_work_no')->nullable();
            $table->string('sec_mobile_no')->nullable();
            $table->string('sec_email')->nullable();
            $table->string('sec_dependents')->nullable();
            $table->boolean('sec_smoked_in_last_12_months')->default(false);
            $table->string('sec_employment_status')->nullable();
            $table->string('sec_employment_type')->nullable();
            $table->decimal('sec_net_salary_pm', 10, 2)->nullable();
            $table->decimal('sec_gross_basic_salary_pm', 10, 2)->nullable();
            $table->decimal('sec_overtime_pa', 10, 2)->nullable();
            $table->string('sec_overtime_freq')->nullable();
            $table->decimal('sec_bonus_pa', 10, 2)->nullable();
            $table->string('sec_bonus_freq')->nullable();
            $table->decimal('sec_commission_pa', 10, 2)->nullable();
            $table->string('sec_commission_freq')->nullable();
            $table->decimal('sec_gross_salary_total', 10, 2)->nullable();
            $table->decimal('sec_other_income_pa_non_rental', 10, 2)->nullable();
            $table->decimal('sec_other_income_pa_existing_rental', 10, 2)->nullable();
            $table->decimal('sec_other_income_pa_anticipated_rental', 10, 2)->nullable();
            $table->decimal('sec_other_income_pa_total_rental', 10, 2)->nullable();
            $table->string('sec_occupation')->nullable();
            $table->string('sec_employer')->nullable();
            $table->text('sec_employer_address1')->nullable();
            $table->text('sec_employer_address2')->nullable();
            $table->string('sec_length_service_yr')->nullable();
            $table->string('sec_length_service_mo')->nullable();
            $table->string('sec_prev_occupation')->nullable();
            $table->string('sec_prev_employer')->nullable();
            $table->text('sec_prev_employer_address1')->nullable();
            $table->text('sec_prev_employer_address2')->nullable();
            $table->string('sec_prev_length_service_yr')->nullable();
            $table->string('sec_prev_length_service_mo')->nullable();
            $table->string('sec_business_name')->nullable();
            $table->string('sec_business_nature')->nullable();
            $table->text('sec_business_add1')->nullable();
            $table->text('sec_business_add2')->nullable();
            $table->date('sec_date_estd')->nullable();
            $table->text('sec_business_role')->nullable();
            $table->text('sec_shareholding_pc')->nullable();
            $table->decimal('sec_net_profit_3yrs_avg', 10, 2)->nullable();
            $table->decimal('sec_drawings_3yrs_avg', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
