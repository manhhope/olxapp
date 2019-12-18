<?php
use yii\helpers\Html;
?>
<div class="field-row" data-start-index="<?= $index;?>" data-field-type="url">
    <?= Html::hiddenInput($model->formName().'[url]['.$index.'][field_id]', (int)$model->field_id); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-th-large"></span> <?= t('app', 'Url field');?></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Html::activeLabel($model, 'label');?>
                        <?= Html::textInput($model->formName().'[url]['.$index.'][label]', html_encode($model->label), ['class' => 'form-control']); ?>
                        <?= Html::error($model, 'label', ['class' => 'help-block']);?>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <?= Html::activeLabel($model, 'required');?>
                        <?= Html::dropDownList($model->formName().'[url]['.$index.'][required]', html_encode($model->required), $model->getYesNoList(), ['class' => 'form-control']); ?>
                        <?= Html::error($model, 'required', ['class' => 'help-block']);?>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <?= Html::activeLabel($model, 'sort_order');?>
                        <?= Html::textInput($model->formName().'[url]['.$index.'][sort_order]', html_encode($model->sort_order), ['class' => 'form-control']); ?>
                        <?= Html::error($model, 'sort_order', ['class' => 'help-block']);?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Html::activeLabel($model, 'help_text');?>
                        <?= Html::textInput($model->formName().'[url]['.$index.'][help_text]', html_encode($model->help_text), ['class' => 'form-control']); ?>
                        <?= Html::error($model, 'help_text', ['class' => 'help-block']);?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="pull-right">
                <a href="javascript:;" class="btn btn-danger btn-flat btn-remove-url-field" data-field-id="<?= (int)$model->field_id;?>" data-message="<?= t('app', 'Are you sure you want to remove this field? There is no coming back from this after you save the changes.');?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>

    </div>

</div>