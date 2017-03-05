<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property integer $id
 * @property integer $payment_date
 * @property integer $person_id
 * @property string $playing_currency
 * @property integer $playing_original_amount
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_date', 'person_id', 'playing_currency', 'playing_original_amount'], 'required'],
            [['payment_date', 'person_id', 'playing_original_amount'], 'integer'],
            [['playing_currency'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_date' => 'Payment Date',
            'person_id' => 'Person ID',
            'playing_currency' => 'Playing Currency',
            'playing_original_amount' => 'Playing Original Amount',
        ];
    }

    public static function getTotalAmountByMonth($year)
    {
        $sql = "SELECT MONTH(FROM_UNIXTIME(payment_date)) as month, YEAR(FROM_UNIXTIME(payment_date)) as year, SUM(playing_original_amount) as amount
            FROM payments p
            WHERE YEAR(FROM_UNIXTIME(payment_date)) = $year
            GROUP BY MONTH(FROM_UNIXTIME(payment_date)), YEAR(FROM_UNIXTIME(payment_date))";

        $command = Yii::$app->db->createCommand($sql);

        $results = [0,0,0,0,0,0,0,0,0,0,0,0];
        
        $rows = $command->queryAll();

        $total = count($rows);
        for ($i=0; $i < $total; $i++) { 
            $row = $rows[$i];

            $results[$row['month'] - 1] = $row['amount'];
        }

        return $results;
    }

    public static function paginate($draw, $start, $length, $id_order) {
        $count = Yii::$app->db->createCommand('SELECT COUNT(id) FROM payments')->queryScalar();

        $sql = "SELECT person_id, COUNT(id) as aggregated_orders
            FROM payments
            GROUP BY person_id
            ORDER BY person_id $id_order
            LIMIT $start, $length";
   
        $command = Yii::$app->db->createCommand($sql);

        ;
        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $command->queryAll(\PDO::FETCH_NUM)
        ];
    }
}
