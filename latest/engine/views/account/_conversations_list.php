<?php
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\helpers\SvgHelper;
use yii\helpers\Html;

?>

<div class="container">
    <div class="row">
        <?php Pjax::begin([
            'enablePushState' => true,
        ]); ?>
        <?= ListView::widget([
            'id'               => !empty($isArchivedList) ? 'archived-conversations' : 'active-conversations',
            'dataProvider'     => $conversationsProvider,
            'itemView'         => '_conversation_item',
            'viewParams'       => ['isArchivedList' => !empty($isArchivedList)],
            'layout'           => '
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="list list-inbox">
                            <li class="list-head">
                                <ul>
                                    <li class="title">' . t('app', 'Title') . '</li>
                                    <li class="date">' . t('app', 'Date') . '</li>
                                    <li class="actions icons">'.Html::a(Html::tag('i', '', ['class' => 'fa fa-database fa-fw']) .t('app', 'Export Messages Data '), ['export-messages-data'], ['class' => 'btn-as transparent', 'data-pjax' => '0']).'</li>
                                </ul>
                            </li>
                            <li class="list-body">
                                {items}
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pagination-custom">
                            <div class="row">
                                {pager}
                            </div>
                        </div>
                    </div>
                ',
            'itemOptions'      => [
                'tag' => 'ul'
            ],
            'emptyText'        => '
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="list list-conversation">
                        <li class="list-head">
                            <ul>
                                <li class="title">' . t('app', 'Conversations') . '</li>
                                <li class="date"></li>
                                <li class="actions icons">'.Html::a(Html::tag('i', '', ['class' => 'fa fa-database fa-fw']) .t('app', 'Export Messages Data '), ['export-messages-data'], ['class' => 'btn-as transparent', 'data-pjax' => '0']).'</li>
                            </ul>
                        </li>
                        <li class="list-body">
                            <ul>
                                <li class="empty">' . t('app', 'No results found') . '</li>
                            </ul>
                        </li>
                    </ul>
                </div>',
            'pager'            => [
                'class'         => 'app\widgets\CustomLinkPager',
                'prevPageLabel' => SvgHelper::getByName('arrow-left'),
                'nextPageLabel' => SvgHelper::getByName('arrow-right')
            ]
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>