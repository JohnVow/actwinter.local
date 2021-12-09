<?php namespace Site21\Fields\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;


class AddspansizecommentField extends Migration
{
    const TABLE_NAME = 'site21_shopaholic_fields';
    
    public function up()
    {
        if (
            !Schema::hasTable(self::TABLE_NAME) || 
            Schema::hasColumn(self::TABLE_NAME, 'span')  || 
            Schema::hasColumn(self::TABLE_NAME, 'size') || 
            Schema::hasColumn(self::TABLE_NAME, 'comment')
        ) {
            return;
        }

        Schema::table(self::TABLE_NAME, function (Blueprint $obTable)
        {
            $obTable->string('span')->nullable();
            $obTable->string('size')->nullable();
            $obTable->string('comment')->nullable();
        });
    }

    public function down()
    {
        if (!Schema::hasTable(self::TABLE_NAME) || !Schema::hasColumn(self::TABLE_NAME, 'span') || !Schema::hasColumn(self::TABLE_NAME, 'size') || !Schema::hasColumn(self::TABLE_NAME, 'comment')) {
            return;
        }

        Schema::table(self::TABLE_NAME, function (Blueprint $obTable)
        {
            $obTable->dropColumn(['span', 'size', 'comment']);
        });
    }
}