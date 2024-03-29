<?php

/**
 *
 * @package    EasyAds
 * @author     CodinBit <contact@codinbit.com>
 * @link       https://store.codinbit.com
 * @copyright  2017 EasyAds (https://store.codinbit.com)
 * @license    https://www.codinbit.com
 * @since      1.3
 */

namespace app\fieldbuilder\url;

use app\fieldbuilder\Type;
use app\models\CategoryField;
use app\models\CategoryFieldValue;

/**
 * Class FieldBuilderTypeUrl
 * @package app\fieldbuilder\url
 */
class FieldBuilderTypeUrl extends Type
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
            UrlAsset::register(app()->view);

            app()->on('admin.categories.form.fields.add', function($event){
                echo app()->view->renderFile('@app/fieldbuilder/url/views/add-button.php');
            });

            app()->on('admin.categories.form.fields.templates', function($event){
                $model = new CategoryField(
                    [
                        'type_id' => 5,
                    ]
                );
                echo app()->view->renderFile('@app/fieldbuilder/url/views/field-tpl-js.php',[
                    'model' => $model,
                ]);
            });
        }

        $field = $this->field;
        if(!empty($field)) {
            app()->on('admin.categories.form.fields.list', function ($event) use ($field) {
                echo app()->view->renderFile('@app/fieldbuilder/url/views/field-tpl.php', [
                    'model' => $field,
                    'index' => self::getIndex(),
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
                echo app()->view->renderFile('@app/fieldbuilder/url/views/field-frontend-form-tpl.php', [
                    'model' => $field,
                    'index' => self::getIndex(),
                    'value' => $fieldValue,
                ]);
            });
            app()->on('admin.ad.form.fields.list', function ($event) use ($field) {
                $value = CategoryFieldValue::find()->where(['listing_id'=>$this->params['adId'],'field_id'=>$field->field_id])->one();
                $fieldValue = (!empty($value->value)) ? $value->value : '';
                echo app()->view->renderFile('@app/fieldbuilder/url/views/field-admin-form-tpl.php', [
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

                echo app()->view->renderFile('@app/fieldbuilder/url/views/field-frontend-search-form-tpl.php', [
                    'model' => $field,
                    'index' => self::getIndex(),
                    'value' => $isExistsField ? $request->get('CategoryField')[$field->field_id] : '',
                ]);
            });
        }
    }
}