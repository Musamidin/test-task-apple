<?php

namespace backend\controllers;

use app\models\Apple;
use common\models\LoginForm;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'create', 'fall', 'eat'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'create' => ['get'],
                    'fall' => ['get'],
                    'eat' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $a = Apple::find()->asArray()->all();
            return $this->render('index', ['app' => $a]);
        }

        return $this->render('index', ['app' => []]);
    }

    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            $r = mt_rand(2, 6);
            for($i = 0; $i < $r; $i++)
            {
                $ap = new Apple('red');
                $ap->createTree();
            }
            $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();

        return $this->render('login', [
            'model' => $model,
        ]);

    }

    public function actionFall()
    {
        $get = Yii::$app->request->get();
        try
        {
            if ($get['id'] != null || $get['id'] != 0)
            {
                $a = Apple::findOne($get['id']);
                $a->status = Apple::STATUS_FALL_TO_GROUND;
                $a->fall_at = time();
                $a->expired = time() + 60*60;
                $a->save();
            }
            $this->goHome();
        }
        catch (\Exception $e)
        {
            Yii::error($e->getMessage(),'writeLog');
        }
    }

    public function actionEat()
    {
        $get = Yii::$app->request->get();
        try
        {
            if ($get['id'] != null || $get['id'] != 0)
            {
                $a = Apple::findOne($get['id']);
                if(time() > $a->expired)
                {
                   throw new Exception('Яблоко испорчено!');
                }

                $a->size = ($a->size-25);
                $a->save();

                if($a->size == 0)
                {
                    $a->delete();
                }
            }
            $this->goHome();
        }
        catch (\Exception $e)
        {
            Yii::error($e->getMessage(),'writeLog');
        }
    }
    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
