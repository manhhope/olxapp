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

use yii\db\Migration;

/**
 * Handles the creation for table `language`.
 */
class m160920_130027_create_language_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%language}}', [
            'language_id'       => $this->primaryKey(),
            'name'              => $this->string(100),
            'language_code'     => $this->char(2)->notNull(),
            'region_code'       => $this->char(2),
            'is_default'        => $this->char(3)->notNull()->defaultValue('no'),
            'status'            => $this->char(15)->notNull()->defaultValue('active'),
            'created_at'        => $this->dateTime()->notNull(),
            'updated_at'        => $this->dateTime()->notNull(),
        ], $tableOptions);

        // add language and locale data from SQL file
        $prefix = db()->tablePrefix;
        $query = \app\helpers\CommonHelper::getQueriesFromSqlFile(realpath(Yii::$app->basePath) . '/data/sql/language-locale.sql', $prefix);
        foreach ($query as $q){
            db()->createCommand($q)->execute();
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->getDb()->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();

        $this->dropTable('{{%language}}');

        $this->getDb()->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
    }
}
