<?php

namespace backend\controllers;

use app\models\Payments;

class PaymentsController extends \yii\rest\Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [

            // For cross-domain AJAX request
            'corsFilter'  => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    // restrict access to domains:
                    'Origin'                           => ['http://assignment.dev'],
                    'Access-Control-Request-Method'    => ['POST'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
                ],
            ],

        ]);
    }
    public function actionIndex()
    {
        $rows = Payments::find()->limit(100)->all();
        return $rows;
    }

    public function actionPaginate()
    {
        $request = \Yii::$app->request;

        $draw = $request->post('draw', 1);
        $start = $request->post('start', 0);
        $length = $request->post('length', 10);

        $id_order = 'asc';
        $order = $request->post('order', []);
        if (!empty($order[0]) && !empty($order[0]['dir'])) {
            $id_order = $order[0]['dir'];
        }
        return Payments::paginate($draw, $start, $length, $id_order);
    }

    public function actionGetAmountByMonth()
    {   
    	return [
            'success' => true,
            'data' => Payments::getTotalAmountByMonth(2016)
        ];
    }

}
