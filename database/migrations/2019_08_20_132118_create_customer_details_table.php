    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->nullable();
            $table->string('address_arabic')->nullable();
            $table->string('street_is_arabic')->nullable();
            $table->string('building_number')->nullable();
            $table->string('area_arabic')->nullable();
            $table->string('pour')->nullable();
            $table->string('city_is_arabic')->nullable();
            $table->string('other_phones')->nullable();
            $table->string('social_status_arabic')->nullable();
            $table->string('mailbox')->nullable();
            $table->string('title_english')->nullable();
            $table->string('area_is_english')->nullable();
            $table->string('reason')->nullable();
            $table->string('name_is_English')->nullable();
            $table->string('issuing_id')->nullable();
            $table->string('city_is_english')->nullable();
            $table->string('street_is_english')->nullable();
            $table->string('customer_age')->nullable();
            $table->string('place_of_issue')->nullable();
            $table->string('social_status_english')->nullable();
            $table->string('number_of_family_members')->nullable();
            $table->string('accommodation_type')->nullable();
            $table->string('email')->nullable();
            $table->string('card_version_number')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('number_of_irritants')->nullable();
            $table->string('conservation')->nullable();
            $table->date('release_date')->nullable();
            $table->string('occupation')->nullable();
            $table->string('identity_type')->nullable();
            $table->integer('age_of_wife')->nullable();
            $table->integer('age_of_boys')->nullable();
            $table->integer('seniors')->nullable()->comment('1=yes,2=no')->nullable();
            $table->integer('patients')->nullable()->comment('1=yes,2=no')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('customer_details');
    }
}
