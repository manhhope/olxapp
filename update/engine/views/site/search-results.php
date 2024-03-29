<?php
use yii\widgets\ListView;
use app\helpers\SvgHelper;
use app\components\AdsListWidget;

\app\assets\AppAsset::register($this);

?>

<section class="main-search">
    <?= $this->render('_searchpage-search', [
        'searchModel'                   => $searchModel,
        'locationDetails'               => $locationDetails,
        'categories'                    => $categories,
        'categoryPlaceholderText'       => $categoryPlaceholderText,
    ]); ?>
</section>

<div class="container">
    <div class="row">
        <div class="mb10 col-lg-8 col-lg-push-2 col-md-8 col-md-push-2 col-sm-12 hidden-xs">
            <?php app()->trigger('search.above.results', new \app\yii\base\Event()); ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="mobile-advert mb10 col-xs-12 hidden-lg hidden-md hidden-sm">
            <?php app()->trigger('mobile.search.above.results', new \app\yii\base\Event()); ?>
        </div>
    </div>
</div>

<section class="listings-list-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-push-2 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1><?= t('app', 'All categories'); ?></h1>
                    </div>
                </div>
                <?= ListView::widget([
                    'id'               => 'category-listings',
                    'dataProvider'     => $adsProvider,
                    'layout'           => '
                        <div class="row">
                            {items}
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pagination-custom">
                                    <div class="row">
                                        {pager}
                                    </div>
                                </div>
                            </div>
                        </div>
                    ',
                    'itemView'         => '_ad-item',
                    'emptyText'        => '',
                    'itemOptions'      => [
                        'tag'   => 'div',
                        'class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12 item',
                    ],
                    'emptyTextOptions' => ['tag' => 'ul', 'class' => 'list invoice'],
                    'pager'            => [
                        'class'         => 'app\widgets\CustomLinkPager',
                        'prevPageLabel' => SvgHelper::getByName('arrow-left'),
                        'nextPageLabel' => SvgHelper::getByName('arrow-right')
                    ]
                ]); ?>

                <?php if ($isNothingFound) { ?>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <span class="no-results"><?= t('app', 'No results found') ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<section class="others-listings">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-push-2 col-md-12 col-sm-12 col-xs-12">
                <?php if ($isNothingFound) { ?>
                    <?= AdsListWidget::widget([
                        'listType'  => AdsListWidget::LIST_TYPE_PROMOTED,
                        'title'     => t('app', 'Other ads'),
                        'quantity'  => 3
                    ]);
                    ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
