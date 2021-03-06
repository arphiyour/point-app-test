<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointPurchasingInvoiceDetailFixedAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_purchasing_fixed_assets_invoice_detail', function ($table) {
            $table->increments('id');
            
            $table->integer('fixed_assets_invoice_id')->unsigned()->index('point_purchasing_fixed_assets_invoice_detail_index');
            $table->foreign('fixed_assets_invoice_id', 'point_purchasing_fixed_assets_invoice_detail_foreign')
                ->references('id')->on('point_purchasing_fixed_assets_invoice')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('coa_id')->unsigned()->index('fa_invoice_detail_coa_index');
            $table->foreign('coa_id', 'fa_invoice_detail_coa_foreign')
                ->references('id')->on('coa')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->integer('allocation_id')->unsigned()->index('point_purchasing_fixed_assets_invoice_detail_allocation_index');
            $table->foreign('allocation_id', 'point_purchasing_fixed_assets_invoice_detail_allocation_foreign')
                ->references('id')->on('allocation')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->decimal('quantity', 16, 4);
            $table->decimal('price', 16, 4);
            $table->decimal('discount', 16, 4);
            $table->string('unit');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('point_purchasing_fixed_assets_invoice_detail');
    }
}
