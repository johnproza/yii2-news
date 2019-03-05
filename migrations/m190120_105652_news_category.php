<?php

use yii\db\Migration;

/**
 * Class m190120_105652_news_category
 */
class m190120_105652_news_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        CREATE TABLE IF NOT EXISTS `news_category` (
          `id` INT NOT NULL AUTO_INCREMENT,
          `title` VARCHAR(150) NOT NULL,
          `created_at` INT NOT NULL,
          `seo_id` INT NOT NULL,
          `status` TINYINT(2) NULL DEFAULT 0,
          PRIMARY KEY (`id`))
        ENGINE = InnoDB
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190120_105652_news_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190120_105652_news_category cannot be reverted.\n";

        return false;
    }
    */
}
