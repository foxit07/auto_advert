<?php

use yii\db\Migration;

/**
 * Handles the creation of table `adverts_options`.
 */
class m181119_123534_create_adverts_options_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('adverts_options', [
            'id' => $this->primaryKey(),
            'advert_id' => $this->integer(),
            'option_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('adverts_options');
    }
}
