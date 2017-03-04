<?php

use yii\db\Migration;

/**
 * Handles the creation of table `payments`.
 */
class m170304_123333_create_payments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('payments', [
            'id' => $this->primaryKey(),
            'payment_date' => $this->integer()->notNull(),
            'person_id' => $this->integer()->notNull(),
            'playing_currency' => $this->string(5)->notNull(),
            'playing_original_amount' => $this->integer()->notNull()
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('payments');
    }
}
