<?php

use yii\db\Migration;

/**
 * Handles the creation of table `adverts`.
 */
class m181119_123602_create_adverts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('adverts', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer(),
            'mileage' => $this->integer(),
            'price' => $this->string(),
            'phone' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('adverts');
    }
}
