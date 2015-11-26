<?php

namespace frontend\modules\product\controllers;

use Yii;
use frontend\modules\product\models\Product;
use frontend\modules\product\models\ProductRecord;
use frontend\modules\product\models\ProductRecordSearch;
use frontend\modules\product\models\ProductHasCoverRecord;
use frontend\modules\product\models\ProductHasPaperRecord;
use frontend\modules\product\models\ProductHasLanguageRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * ProductsController implements the CRUD actions for ProductRecord model.
 */
class ProductsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductRecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductRecord model.
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
     * Creates a new ProductRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductRecord();
                
        if ($model->load(Yii::$app->request->post()) ) {
            $transaction = Yii::$app->db->beginTransaction();
            
            try {
                // ProductRecord
                $model->save();
                
                // ProductHasCoverRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasCoverRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->cover_id = $post['ProductRecord']['cover_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasPaperRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasPaperRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->paper_id = $post['ProductRecord']['paper_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasLanguageRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasLanguageRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->language_id = $post['ProductRecord']['language_id'];
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
     * Updates an existing ProductRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $transaction = Yii::$app->db->beginTransaction();
        
            try {
                // ProductRecord
                $model->save();
        
                // ProductHasCoverRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasCoverRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->cover_id = $post['ProductRecord']['cover_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasPaperRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasPaperRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->paper_id = $post['ProductRecord']['paper_id'];
                    $prop_model->save();
                } while(0);
                // ProductHasLanguageRecord
                do {
                    $post = Yii::$app->request->post();
                    $prop_model = new ProductHasLanguageRecord();
                    $prop_model->product_id = $model->id;
                    $prop_model->language_id = $post['ProductRecord']['language_id'];
                    $prop_model->save();
                } while(0);
        
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            /* Get vars for relation & Set them in current model */ 
            $model->cover_id = $model->productHasCover->id;
            $model->paper_id = $model->productHasPaper->id;
            $model->language_id = $model->productHasLanguage->id;
            
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductRecord model.
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
     * Finds the ProductRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
