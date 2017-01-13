<?php

namespace greeschenko\sysmsgs\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use greeschenko\sysmsgs\models\Sysmsgs;

class MyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions'=>['get-count','get-all','check-read','archive'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionGetCount()
    {
        $res = [];
        if (Yii::$app->request->isAjax and !Yii::$app->user->isGuest) {
            $count = Sysmsgs::find()
                ->where(['user_id'=> Yii::$app->user->identity->id])
                ->andWhere(['status'=>Sysmsgs::STATUS_NEW])
                ->count();

            $res['count'] = $count;

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $res;
        }

        return false;
    }

    public function actionGetAll()
    {
        $res = [];
        if (Yii::$app->request->isAjax and !Yii::$app->user->isGuest) {
            $data = Sysmsgs::find()
                ->where(['user_id'=> Yii::$app->user->identity->id])
                ->andWhere(['status'=>Sysmsgs::STATUS_NEW])
                ->all();

            foreach ($data as $one) {
                $res['items'][]=[
                    'id'=>$one->id,
                    'content'=>$one->content,
                    'type'=>$one->typelist[$one->type],
                    'date'=>Yii::$app->formatter->asDate($one->created_at, 'medium'),
                ];
            }

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $res;
        }

        return false;
    }

    public function actionCheckRead($id)
    {
        $res = [];
        if (Yii::$app->request->isAjax and !Yii::$app->user->isGuest) {
            $data = Sysmsgs::findOne($id);
            $data->status = Sysmsgs::STATUS_READ;
            if ( $data->save() ) {
                return true;
            }
        }

        return false;
    }

    public function actionArchive()
    {
        $data = Sysmsgs::find()
            ->where(['user_id'=> Yii::$app->user->identity->id])
            ->all();

        return $this->render('archive',['data'=>$data]);
    }
}
