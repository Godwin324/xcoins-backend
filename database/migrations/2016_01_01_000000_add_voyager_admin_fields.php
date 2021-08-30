<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddVoyagerAdminFields extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('admins', function ($table) {
            if (!Schema::hasColumn('admins', 'avatar')) {
                $table->string('avatar')->nullable()->after('email')->default('users/default.png');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasColumn('admins', 'avatar')) {
            Schema::table('admins', function ($table) {
                $table->dropColumn('avatar');
            });
        }

    }
}
