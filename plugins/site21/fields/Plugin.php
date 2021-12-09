<?php namespace Site21\Fields;

use Backend;
use System\Classes\PluginBase;
use Event;
use Schema;
use Lovata\Shopaholic\Models\Product;
use Lovata\Shopaholic\Models\Category;
use Lovata\Shopaholic\Models\Brand;
use Lovata\Shopaholic\Models\Offer;
use Site21\Fields\Models\Field;
use Illuminate\Support\Str;

/**
 * Fields Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = ['Lovata.Shopaholic', 'Lovata.Toolbox'];

    public function pluginDetails()
    {
        return [
            'name'        => e(trans('site21.fields::lang.plugin.name')),
            'description' => e(trans('site21.fields::lang.plugin.description')),
            'author'      => 'Site21',
            'icon'        => 'icon-leaf',
            'homepage'    => 'https://site21.ru'
        ];
    }

    public function register()
    {

    }

    public function boot()
    {
        Event::listen('backend.menu.extendItems', function($manager) {
            $manager->addSideMenuItems('Lovata.Shopaholic', 'shopaholic-menu-main', [
                'fields' => [
                    'code'  => 'fields',
                    'label' => e(trans('site21.fields::lang.menu.label')),
                    'icon'  => 'icon-tags',
                    'url'   => Backend::url('site21/fields/fields'),
                    'order' => 550,
                    'permissions' => [
                        'site21.fields.add_field_permission',
                    ],
                ],
            ]);
        });
        if (Schema::hasTable('site21_shopaholic_fields')) {
            $models = [
                Product::class,
                Category::class,
                Offer::class,
                Brand::class,
            ];
            foreach($models as $module) {
                $model = new $module;
                $model->extend(function ($model) {
                    $module = (new Field)->getModuleTable($model->table, 'key');
                    if(!$module) {
                        return;
                    }
                    $query = Field::where('module', $module)->where('active', 1)->select('slug','settings');
                    $fields = $query->get();
                    if($fields) {
                        $array = [];
                        foreach($fields as $field) {
                            $model->fillable[] = $field->slug;    
                        }
                    }

                    // добавляем кэшируемые поля
                    $cached = $query->where('settings->cached', '1')->pluck('slug')->toArray();
                    if($cached) {
                        $model->addCachedField($cached);
                    }

                    // добавляем переводимые поля
                    $array = [];
                    foreach($fields as $field) {
                        if($field->settings['translatable'] == 1) {
                            $array[] = $field->slug;
                        }
                    }
                    if($array) {
                        $model->translatable = array_merge($model->translatable,$array);
                    }
                });
                
                Event::listen('backend.form.extendFieldsBefore', function($widget) {
                    if ($widget->isNested || $widget->alias != 'form') {
                        return;
                    }
                    $module = (new Field)->getModuleTable($widget->model->table, 'key');
                    if(!$module) {
                        return;
                    }
                    // Получаем все кастомные поля только для обходимого модуля
                    $fields = Field::where('module', $module)
                        ->where('active', 1)
                        ->select('name', 'slug', 'type', 'tab', 'span', 'size', 'comment')
                        ->get();
                        
                    if($fields) {
                        foreach($fields as $field) {
                            $widget->tabs['fields'][$field->slug] = [
                                'label'   => $field->name,
                                'type'    => $field->type,
                                'tab'     => $field->tab,
                                'span'    => $field->span,
                                'size'    => $field->size,
                                'comment' => $field->comment
                            ];
                        }
                    }
                });

                Event::listen('backend.list.extendColumns', function ($listWidget) {
                    
                    $module = (new Field)->getModuleTable($listWidget->model->table, 'key');
                    if(!$module) {
                        return;
                    }

                    $fields = Field::where('module', $module)->where('active', 1)->where('settings->inlist', '1')->select('slug', 'name', 'type')->get();
                        
                    if($fields) {
                        $columns = [];
                        foreach($fields as $field) {
                            $columns = [
                                $field->slug => [
                                    'label'   => $field->name,
                                    'type'    => $field->type,
                                ]
                            ];
                        }
                    }
                    $listWidget->addColumns($columns);
                });
            }
        }

    }

    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Site21\Fields\Components\MyComponent' => 'myComponent',
        ];
    }

    public function registerPermissions()
    {
        return [
            'site21.fields.add_field_permission' => [
                'tab' => e(trans('site21.fields::lang.plugin.name')),
                'label' => e(trans('site21.fields::lang.permissions.add'))
            ],
        ];
    }


}
