<?php namespace Site21\Fields\Models;

use Model;
use Schema;

/**
 * Field Model
 */
class Field extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'site21_shopaholic_fields';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'name'      => 'required',
        'slug'      => 'required|unique:site21_shopaholic_fields',
        'type'      => 'required',
        'module'    => 'required',
        'tab'       => 'required',
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = ['settings'];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];



    function getModuleTable($module, $get = FALSE){
        $moduleTable = [
            'product'    => 'lovata_shopaholic_products',
            'offer'      => 'lovata_shopaholic_offers',
            'category'   => 'lovata_shopaholic_categories',
            'brand'      => 'lovata_shopaholic_brands',
        ];
        if($get == 'key') {
            $obTable = array_keys($moduleTable, $module);
        } else {
            $obTable = $moduleTable[$module];
        }
        return $obTable;
    }

    public function afterCreate()
    {
        $obTable = $this->getModuleTable($this->module);
        if (!Schema::hasTable($obTable) || Schema::hasColumn($obTable, $this->slug)) {
            return;
        }
        
        Schema::table($obTable, function ($table) {
            $type = [
                'text'       => 'string',
                'textarea'   => 'text',
                'number' =>  'integer',
                'email' => 'string',
                'switch' => 'string',
            ];
            $obType = $type[$this->type];
            $table->$obType($this->slug)->nullable();
        });
    }


    public function afterDelete()
    {
        Schema::table($this->getModuleTable($this->module), function ($table) {
            $table->dropColumn($this->slug);
        });
    }

    public function afterUpdate()
    {
        if ($this->slug != $this->original['slug']) {
            Schema::table($this->getModuleTable($this->module), function ($table) {
                $table->renameColumn($this->original['slug'], $this->slug);
            }); 
        }
    }


    public function getTypeOptions() {
        return [
            'text' => 'site21.fields::lang.type.text',
            'textarea' => 'site21.fields::lang.type.textarea',
            'number' =>  'site21.fields::lang.type.number',
            'email' =>  'site21.fields::lang.type.email',
            'switch' =>  'site21.fields::lang.type.switch',
        ];
    }

    public function getModuleOptions() {
        return [
            'product' => 'site21.fields::lang.module.product',
            'offer' => 'site21.fields::lang.module.offer',
            'category' => 'site21.fields::lang.module.category',
            'brand' => 'site21.fields::lang.module.brand'
        ];
    }

    public function getTabOptions($value, $data)
    {
        $module = isset($data->module) ? $data->module : key($this->getModuleOptions());
        $options = [
            0 => 'site21.fields::lang.fields.tab',
            'lovata.toolbox::lang.tab.settings' => 'lovata.toolbox::lang.tab.settings',
            'lovata.toolbox::lang.tab.description' => 'lovata.toolbox::lang.tab.description',
            'lovata.toolbox::lang.tab.images' => 'lovata.toolbox::lang.tab.images',
        ];
        if($module) {
            if ($module == 'product') {
                $options['lovata.shopaholic::lang.tab.offer'] = 'lovata.shopaholic::lang.tab.offer';
            }
            elseif ($module == 'offer') {
                $options['lovata.shopaholic::lang.tab.price'] = 'lovata.shopaholic::lang.tab.price';
            }
        }
        return $options;
    }

    public function getSpanOptions() {
        return [
            'full' => 'full',
            'auto' => 'auto',
            'left' => 'left',
            'right' => 'right'
        ];
    }

    public function getSizeOptions() {
        return [
            'tiny' => 'tiny',
            'small' => 'small',
            'large' => 'large',
            'huge' => 'huge',
            'giant' => 'giant'
        ];
    }

}
