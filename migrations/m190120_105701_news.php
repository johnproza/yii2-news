<?php

use yii\db\Migration;

/**
 * Class m190120_105701_news
 */
class m190120_105701_news extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
          CREATE TABLE IF NOT EXISTS `news` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `title` VARCHAR(200) NOT NULL,
              `preview` VARCHAR(250) NULL,
              `content` TEXT NOT NULL,
              `created_by` INT NOT NULL,
              `status` SMALLINT(2) NULL,
              `created_at` INT NULL,
              `updated_at` INT NULL,
              `category_id` INT NULL DEFAULT 0,
              PRIMARY KEY (`id`),
              INDEX `FK_news_category_idx` (`category_id` ASC),
              CONSTRAINT `FK_news_category`
                FOREIGN KEY (`category_id`)
                REFERENCES `news_category` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190120_105701_news cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190120_105701_news cannot be reverted.\n";

        return false;
    }
    */
}
