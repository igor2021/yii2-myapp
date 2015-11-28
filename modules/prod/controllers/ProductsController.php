<?php

namespace modules\prod\controllers;

use Yii;
use modules\prod\models\Product;
use modules\prod\models\ProductSearch;
use modules\prod\models\ProductHasCover;
use modules\prod\models\ProductHasPaper;
use modules\prod\models\ProductHasLanguage;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * ProductsController implements the CRUD actions for Product model.
 */
class ProductsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                    ],
                    [
                        'roles' => ['admin'],
                        'allow' => true,
                    ],
                ], 
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) ) {
            $transaction = Yii::$app->db->beginTransaction();
        
            try {
                // Product
                $model->save();
                
                // ProductHasCover
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasCover();
                    $prop_model->product_id = $model->id;
                    $prop_model->cover_id = $post['Product']['cover_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasPaper
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasPaper();
                    $prop_model->product_id = $model->id;
                    $prop_model->paper_id = $post['Product']['paper_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasLanguage
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasLanguage();
                    $prop_model->product_id = $model->id;
                    $prop_model->language_id = $post['Product']['language_id'];
                    $prop_model->save();
                } while(0);
                
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

            try {
                // Product
                $model->save();
        
                // ProductHasCover
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasCover();
                    $prop_model->product_id = $model->id;
                    $prop_model->cover_id = $post['Product']['cover_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasPaper
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasPaper();
                    $prop_model->product_id = $model->id;
                    $prop_model->paper_id = $post['Product']['paper_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasLanguage
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasLanguage();
                    $prop_model->product_id = $model->id;
                    $prop_model->language_id = $post['Product']['language_id'];
                    $prop_model->save();
                } while(0);
        
                $transaction->commit();
            } catch (Exception $e) {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
