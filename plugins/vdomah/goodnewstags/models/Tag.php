<?php namespace Vdomah\GoodNewsTags\Models;

use Model;
use Cms\Classes\Controller;
use Lovata\GoodNews\Models\Article;

/**
 * Model
 */
class Tag extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vdomah_goodnewstags_tags';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required|unique:vdomah_goodnewstags_tags',
    ];

    public $belongsToMany = [
        'articles' => [
            Article::class,
            'table' => 'vdomah_goodnewstags_article_tag',
        ],
    ];

    public $fillable = [
        'name',
    ];

    /**
     * Before create.
     *
     * @return void
     */
    public function beforeCreate()
    {
        $this->setInitialSlug();
    }

    /**
     * Set the initial slug.
     *
     * @return void
     */
    protected function setInitialSlug()
    {
        $this->slug = str_slug($this->name);
    }

    /**
     * Convert tag names to lower case
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = mb_strtolower($value);
    }

    /**
     * Sets the "url" attribute with a URL to this object
     *
     * @param string                    $pageName
     */
    public function getUrl($pageName)
    {
        $controller = Controller::getController();

        $params = [
            'id' => $this->id,
            'tags' => $this->slug,
        ];

        return $this->url = $controller->pageUrl($pageName, $params);
    }
}
