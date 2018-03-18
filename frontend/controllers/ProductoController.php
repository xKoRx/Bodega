<?php

namespace frontend\controllers;

use Exception;
use frontend\custom\CArrayHelper;
use frontend\models\producto\Producto;
use frontend\models\views\ProductoSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class ProductoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIngresar()
    {
        $producto = new Producto();

        return $this->render('ingresar', ['producto' => $producto]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     * @throws \yii\db\Exception
     * @throws Exception
     */
    public function actionCrear()
    {
        $connection = Yii::$app->getDb();
        $transaction = $connection->beginTransaction();

        try {

            $producto = new Producto();
            $producto->attributes = Yii::$app->request->post('producto');

            if ($producto->validate()) {
                $producto->save();
            } else {
                throw new Exception(Yii::t('app', 'No se puede ingresar Producto: ' . CArrayHelper::toStringJson($producto->getErrors())));
            }

            $transaction->commit();

        } catch (Exception $e) {

            $transaction->rollBack();
            throw new Exception(Yii::t('app', 'No se puede ingresar Producto: ') . $e->getMessage());

        }

        //FlashMessage::putSuccess(Yii::t('frontend', 'Success'), Yii::t('frontend', 'Afp Creada.'));
        return $this->redirect(['producto/listar']);

    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionListar()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        $gridColumns = $searchModel->getColumns();

        return $this->render('listar', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'gridColumns' => $gridColumns
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     * @throws Exception
     * @throws \Throwable
     * @throws \yii\db\Exception
     */
    public function actionEliminar()
    {
        $connection = Yii::$app->getDb();
        $transaction = $connection->beginTransaction();

        try {

            $pro_id = Yii::$app->request->post('pro_id');

            $producto = Producto::findOne($pro_id);
            $producto->delete();

            $transaction->commit();

        } catch (Exception $e) {

            $transaction->rollBack();
            throw new Exception(Yii::t('app', 'No se puede ingresar Producto: ') . $e->getMessage());

        }

        //FlashMessage::putSuccess(Yii::t('frontend', 'Success'), Yii::t('frontend', 'Afp Creada.'));
        return $this->redirect(['listar']);

    }

}
