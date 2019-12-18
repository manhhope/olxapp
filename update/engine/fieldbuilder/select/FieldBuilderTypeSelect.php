<?php

/**
 *
 * @package    EasyAds
 * @author     CodinBit <contact@codinbit.com>
 * @link       https://store.codinbit.com
 * @copyright  2017 EasyAds (https://store.codinbit.com)
 * @license    https://www.codinbit.com
 * @since      1.0
 */

namespace app\fieldbuilder\select;

use app\models\CategoryFieldOption;
use app\fieldbuilder\Type;
use app\models\CategoryField;
use app\models\CategoryFieldValue;

/**
 * Class FieldBuilderTypeSelect
 * @package app\fieldbuilder\select
 */
class FieldBuilderTypeSelect extends Type
{
    /**
     * @var bool
     */
    private static $handledAdminDisplay = false;

    /**
     * handleAdminDisplay
     */
    public function handleAdminDisplay()
    {
        if(!self::$handledAdminDisplay) {
            self::$handledAdminDisplay = true;
            SelectAsset::register(app()->view);

            app()->on('admin.categories.form.fields.add', function($event){
                echo app()->view->renderFile('@app/fieldbuilder/select/views/add-button.php');
            });

            app()->on('admin.categories.form.fields.templates', function($event){
                $model = new CategoryField(
                    [
                        'type_id' => 2,
                    ]
                );
                $option = new CategoryFieldOption();
                echo app()->view->renderFile('@app/fieldbuilder/select/views/field-tpl-js.php',[
                    'model' => $model,
                    'option' => $option,
                ]);
            });
        }

        $field = $this->field;
        if(!empty($field)) {
            app()->on('admin.categories.form.fields.list', function ($event) use ($field) {
                echo app()->view->renderFile('@app/fieldbuilder/select/views/field-tpl.php', [
                    'model' => $field,
                    'index' => (!empty($field->field_id)) ? $field->field_id : self::getIndex(),
                ]);
            });
        }
    }

    /**
     * handleFrontendFormDisplay
     */
    public function handleFrontendFormDisplay()
    {
        $field = $this->field;
        if(!empty($field)) {
            app()->on('frontend.ad.form.fields.list', function ($event) use ($field) {
                $value = CategoryFieldValue::find()->where(['listing_id'=>$this->params['adId'],'field_id'=>$field->field_id])->one();
                $fieldValue = (!empty($value->value)) ? $value->value : '';
                echo app()->view->renderFile('@app/fieldbuilder/select/views/field-frontend-form-tpl.php', [
                    'model' => $field,
                    'index' => self::getIndex(),
                    'value' => $fieldValue,
                ]);
            });
            app()->on('admin.ad.form.fields.list', function ($event) use ($field) {
                $value = CategoryFieldValue::find()->where(['listing_id'=>$this->params['adId'],'field_id'=>$field->field_id])->one();
                $fieldValue = (!empty($value->value)) ? $value->value : '';
                echo app()->view->renderFile('@app/fieldbuilder/select/views/field-admin-form-tpl.php', [
                    'model' => $field,
                    'index' => self::getIndex(),
                    'value' => $fieldValue,
                ]);
            });
        }
    }

    /**
     * handleFrontendSearchFormDisplay
     */
    public function handleFrontendSearchFormDisplay()
    {
        $request = request();
        $field = $this->field;
        if(!empty($field)) {
            app()->on('frontend.ad.search.form.fields.list', function ($event) use ($field, $request) {
                $isExistsField = $request->get('CategoryField') && isset($request->get('CategoryField')[$field->field_id]);

                echo app()->view->renderFile('@app/fieldbuilder/select/views/field-frontend-search-form-tpl.php', [
                    'model' => $field,
                    'index' => self::getIndex(),
                    'value' => $isExistsField ? $request->get('CategoryField')[$field->field_id] : '',
                ]);
            });
        }
    }
}