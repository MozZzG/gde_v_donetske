<?php

namespace app\controllers;

use Yii;
use app\models\Subcategoryevent;
use app\models\SubcategoryeventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Categoryevent;
use yii\helpers\ArrayHelper;

/**
 * SubcategoryeventController implements the CRUD actions for Subcategoryevent model.
 */
class SubcategoryeventController extends Controller
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
     * Lists all Subcategoryevent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubcategoryeventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subcategoryevent model.
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
     * Creates a new Subcategoryevent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Subcategoryevent();
        $cat = Categoryevent::find()->all();
        $items = ArrayHelper::map($cat, 'ID', 'Name');

        if ($model->load(Yii::$app->request->post())) {
            $model->Count = 0;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->ID]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }

    /**
     * Updates an existing Subcategoryevent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cat = Categoryevent::find()->all();
        $items = ArrayHelper::map($cat, 'ID', 'Name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }

    /**
     * Deletes an existing Subcategoryevent model.
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
     * Finds the Subcategoryevent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subcategoryevent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subcategoryevent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
