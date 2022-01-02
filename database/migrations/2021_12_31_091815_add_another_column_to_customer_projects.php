<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnotherColumnToCustomerProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_projects', function (Blueprint $table) {
            //
            $table->string('payment_status')->nullable()->after('customer_comments');
            $table->string('status')->nullable()->after('customer_comments');
            $table->timestamp('customer_completion_date')->nullable();
            $table->timestamp('objective_completion_date')->nullable();
            $table->timestamp('completion_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_projects', function (Blueprint $table) {
            //
        });
    }
}
