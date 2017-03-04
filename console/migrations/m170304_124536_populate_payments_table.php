<?php

use yii\db\Migration;

class m170304_124536_populate_payments_table extends Migration
{
    public function safeUp()
    {
        $handle = fopen(dirname(__FILE__).'/testdata.csv', "r");
        $rows = [];

        $is_header = true;
        while (($fileop = fgetcsv($handle, 1000, ",")) !== false) 
        {
            if ($is_header) {
                $is_header = false;
                continue;
            }
            $date = strtotime($fileop[0]);
            $person_id = $fileop[1];
            $currency = $fileop[2];
            $amount = $fileop[3];

            $rows[] = [$date, $person_id, $currency, $amount];
            // $sql = "INSERT INTO details(name, age, location) VALUES ('$name', '$age', '$location')";
            // $query = Yii::$app->db->createCommand($sql)->execute();
            // $this->execute($sql);
        }

        $this->batchInsert(
            'payments',  
            ['payment_date', 'person_id', 'playing_currency', 'playing_original_amount'],
            $rows
        );
    }

    public function safeDown()
    {
        $this->truncateTable('payments');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
