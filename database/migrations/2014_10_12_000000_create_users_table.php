<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id')->unique();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('sss')->nullable();
            $table->string('philhealth')->nullable();
            $table->string('pagibig')->nullable();
            $table->string('tin')->nullable();
            $table->string('nationality')->nullable();
            $table->string('civil_status')->nullable();
            $table->longText('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood_type')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('employment_corporate_name')->nullable();
            $table->string('employment_company_brand')->nullable();
            $table->string('employment_company_store_branch')->nullable();
            $table->date('employement_date_hired')->nullable();
            $table->date('employement_date_resigned')->nullable();
            $table->string('employment_position')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('password', 120);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
