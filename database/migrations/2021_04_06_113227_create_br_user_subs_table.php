<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrUserSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('br_user_subs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->text('user_name');
            $table->text('user_email');
            $table->text('user_roll');
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
            $table->text('manager')->nullable();
            $table->text('manops')->nullable();
            $table->text('genralbank_ubs')->nullable();
            $table->text('credit_ubs')->nullable();
            $table->text('foreigntrade')->nullable();
            $table->text('tellerorcash')->nullable();
            $table->text('view_ubs')->nullable();
            $table->text('checker_rtgs')->nullable();
            $table->text('maker_rtgs')->nullable();
            $table->text('report_view_rtgs')->nullable();
            $table->text('scanman')->nullable();
            $table->text('outward_check_cps')->nullable();
            $table->text('outward_make_cps')->nullable();
            $table->text('report_view_cps')->nullable();
            $table->text('maker_beftn')->nullable();
            $table->text('check_beftn')->nullable();
            $table->text('report_view_beftn')->nullable();
            $table->text('general_bank_bkash')->nullable();
            $table->text('tellerorcash_bkash')->nullable();
            $table->text('general_client_admin_directbank')->nullable();
            $table->text('user_submit_directbank')->nullable();
            $table->text('lock_unlock_client')->nullable();
            $table->text('client_activation_maker')->nullable();
            $table->text('client_activation_checker')->nullable();
            $table->text('general_admin_foradmin')->nullable();
            $table->text('admin_activation_maker_directbank')->nullable();
            $table->text('admin_activation_checker_directbank')->nullable();
            $table->text('lock_unlock_admin_directbank')->nullable();
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
        Schema::dropIfExists('br_user_subs');
    }
}
