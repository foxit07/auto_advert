<?php

use yii\db\Migration;

/**
 * Handles the creation of table `models`.
 */
class m181119_123446_create_models_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('models', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'brand_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('models');
    }
}
