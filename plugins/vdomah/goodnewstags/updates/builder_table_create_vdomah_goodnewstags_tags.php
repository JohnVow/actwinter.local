<?php namespace Vdomah\GoodNewsTags\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateVdomahGoodnewstagsTags extends Migration
{
    public function up()
    {
        Schema::create('vdomah_goodnewstags_tags', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->unique('name');
            $table->unique('slug');
        });

        Schema::create('vdomah_goodnewstags_article_tag', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('article_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->unique(['article_id', 'tag_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('vdomah_goodnewstags_tags');
        Schema::dropIfExists('vdomah_goodnewstags_article_tag');
    }
}