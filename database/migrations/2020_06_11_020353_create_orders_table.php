<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->bigIncrements('id'); // ID Платежа

            $table->integer('project')->default(1);  // ID Проекта

            $table->string('uuid')->nullable();  // UUID платежа

            $table->string('name')->nullable();  // Назначение платежа

            $table->unsignedBigInteger('user_id')->nullable(); // ID юзера
            $table->unsignedBigInteger('tariff_id')->nullable(); // ID тарифа если оплата доступа
            $table->unsignedBigInteger('product_id')->nullable(); // ID продукта если оплата из магаза

            $table->string('type')->nullable(); // Тип платежа

            $table->float('amount', 10, 2)->nullable(); // Стоимость товара
            $table->float('credited', 10, 2)->nullable(); // Сумма платежа
            $table->integer('intid')->default(0);  // ID в платежной системе
            $table->string('currency')->nullable();  // Валюта
            $table->string('method')->nullable();  // Метод оплаты
            $table->float('commission', 10, 2)->nullable(); // Коммиссия

            $table->integer('status')->default(0);  // Статус платежа

            $table->timestamp('created_at')->nullable(); // Дата создания
            $table->timestamp('updated_at')->nullable(); // Дата изменения
            $table->timestamp('deleted_at')->nullable(); // Дата удаления

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tariff_id')->references('id')->on('tariffs');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
