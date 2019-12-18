<?php

namespace app\models\auto;

use Yii;

/**
 * This is the model class for table "{{%listing_favorite}}".
 *
 * @property int $favorite_id
 * @property int $customer_id
 * @property int $listing_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Customer $customer
 * @property Listing $listing
 */
class ListingFavorite extends \app\yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%listing_favorite}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'listing_id', 'created_at', 'updated_at'], 'required'],
            [['customer_id', 'listing_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['listing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Listing::className(), 'targetAttribute' => ['listing_id' => 'listing_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'favorite_id' => Yii::t('app', 'Favorite ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'listing_id' => Yii::t('app', 'Listing ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListing()
    {
        return $this->hasOne(Listing::className(), ['listing_id' => 'listing_id']);
    }

    /**
     * {@inheritdoc}
     * @return ListingFavoriteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ListingFavoriteQuery(get_called_class());
    }
}
