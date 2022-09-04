<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHdUserSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hd_user_subs', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->text('user_name');
            // $table->text('user_email');
            $table->text('user_roll');


            $table->text('hd_user_id')->nullable();
            $table->text('emp_id')->nullable();
            $table->text('branch')->nullable();
            $table->text('user_email')->nullable();
            $table->text('domain_id')->nullable();
            $table->text('emp_name')->nullable();
            $table->text('designation')->nullable();
            $table->text('emp_mobile')->nullable();


            $table->text('ubs')->nullable();
            $table->text('pbm')->nullable();
            $table->text('cps')->nullable();
            $table->text('beftn')->nullable();
            $table->text('rtgs')->nullable();
            $table->text('docudex')->nullable();
            $table->text('newdbcube')->nullable();
            $table->text('rbs')->nullable();
            $table->text('gefu')->nullable();
            $table->text('directbank')->nullable();
            $table->text('bkash')->nullable();
            $table->text('portal')->nullable();
            $table->text('rit')->nullable();
            $table->text('forex')->nullable();
            $table->text('csms')->nullable();
            $table->text('passport')->nullable();
            $table->text('nscreen')->nullable();
            $table->text('swift')->nullable();


            $table->text('newidcreate')->nullable();
            $table->text('amendment')->nullable();
            $table->text('transfer')->nullable();
            $table->text('enable')->nullable();
            $table->text('disable')->nullable();
            $table->text('passreset')->nullable();
    

            $table->text('lc_hd')->nullable();
            $table->text('corp_loan')->nullable();
            $table->text('data_entry')->nullable();
            $table->text('fund_transfer')->nullable();
            $table->text('dbl_clear')->nullable();
            $table->text('recon')->nullable();
            $table->text('money_market')->nullable();
            $table->text('cpccreortrade')->nullable();
            $table->text('dbl_fad')->nullable();
            $table->text('dbl_swift_msg')->nullable();
            $table->text('dbl_obu')->nullable();
            $table->text('dbl_asu')->nullable();
            $table->text('bank_gurantee')->nullable();
            $table->text('card_ops')->nullable();
            $table->text('adc_ops')->nullable();
            $table->text('call_center')->nullable();
            $table->text('foreign_ex')->nullable();
            $table->text('treasure')->nullable();
            $table->text('securities')->nullable();
            $table->text('ccy_rate')->nullable();
            $table->text('settle')->nullable();
            $table->text('business_ops')->nullable();
            $table->text('dbl_edo_ops')->nullable();
            $table->text('dbl_sms_admin')->nullable();
            $table->text('dbl_prod')->nullable();





            $table->text('depart_ubs')->nullable();
            $table->text('exist_user_id_ubs')->nullable();
            $table->text('special_role_ubs')->nullable();


            $table->text('depart_rtgs')->nullable();
            $table->text('roles_rtgs')->nullable();


            $table->text('depart_cps')->nullable();
            $table->text('exist_user_id_cps')->nullable();
            $table->text('roles_cps')->nullable();
            $table->text('special_role_cps')->nullable();


            $table->text('depart_beftn')->nullable();
            $table->text('exist_user_id_beftn')->nullable();
            $table->text('roles_beftn')->nullable();
            $table->text('special_role_beftn')->nullable();


            $table->text('depart_bkash')->nullable();
            $table->text('exist_user_id_bkash')->nullable();
            $table->text('roles_bkash')->nullable();


            
            $table->text('depart_directbank')->nullable();
            $table->text('exist_user_id_directbank')->nullable();
            $table->text('roles_directbank')->nullable();



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
        Schema::dropIfExists('hd_user_subs');
    }
}
