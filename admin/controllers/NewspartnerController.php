<?php

namespace app\controllers;

use Yii;
use app\models\Newspartner;
use app\models\NewspartnerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\NewspartnerForm;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\Establishment;

/**
 * NewspartnerController implements the CRUD actions for Newspartner model.
 */
class NewspartnerController extends Controller
{
    public $enableCsrfValidation = false;

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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => 'http://gdevdonetske.com/new_site/img/news/content/', // Directory URL address, where files are stored.
                'path' => '../../img/news/content/' // Or absolute path to directory where files are stored.
            ],
        ];
    }

    /**
     * Lists all Newspartner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewspartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Newspartner model.
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
     * Creates a new Newspartner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NewspartnerForm();
        $est = Establishment::find()->all();
        $items = ArrayHelper::map($est, 'ID', 'Name');
        $item = new Newspartner();

        if ($model->load(Yii::$app->request->post())) {
            $model->file1 = UploadedFile::getInstance($model, 'file1');
            if ($model->validate()) {
                if ($model->file1)
                    $model->file1->saveAs('../../img/news/' . $this->translite($model->name) . '.' . $model->file1->extension);
                $item->Name = $model->name;
                $item->About = $model->about;
                $item->Text = $model->text;
                $item->EstablishmentID = $model->est;
                $item->Date = $model->date;
                $item->Views = 0;
                $item->Grey = $model->grey;
                if ($model->file1)
                    $item->Photo = $this->translite($model->name) .'.' . $model->file1->extension;
                else
                    $item->Photo = '';
                if ($item->validate()) {
                    $item->save();
                    return $this->redirect(['view', 'id' => $item->ID]);
                }
                else {
                    foreach ($item->getErrors() as $it) {
                        echo $it[0];
                    }
                }
            }
            else {
                foreach ($model->getErrors() as $it) {
                    echo $it[0];
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }

    /**
     * Updates an existing Newspartner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new NewspartnerForm();
        $est = Establishment::find()->all();
        $items = ArrayHelper::map($est, 'ID', 'Name');
        $item = Newspartner::find()->where(['ID' => $id])->one();
        $model->name = $item->Name;
        $model->about = $item->About;
        $model->text = $item->Text;
        $model->est = $item->EstablishmentID;
        $model->date = $item->Date;
        $model->grey = $item->Grey;

        if ($model->load(Yii::$app->request->post())) {
            $model->file1 = UploadedFile::getInstance($model, 'file1');
            if ($model->validate()) {
                if ($model->file1)
                    $model->file1->saveAs('../../img/news/' . $this->translite($model->name) . '.' . $model->file1->extension);
                $item->Name = $model->name;
                $item->About = $model->about;
                $item->Text = $model->text;
                $item->EstablishmentID = $model->est;
                $item->Date = $model->date;
                $item->Views = 0;
                $item->Grey = $model->grey;
                if ($model->file1)
                    $item->Photo = $this->translite($model->name) .'.' . $model->file1->extension;
                else
                    $item->Photo = '';
                if ($item->validate()) {
                    $item->save();
                    return $this->redirect(['view', 'id' => $item->ID]);
                }
                else {
                    foreach ($item->getErrors() as $it) {
                        echo $it[0];
                    }
                }
            }
            else {
                foreach ($model->getErrors() as $it) {
                    echo $it[0];
                }
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'items' => $items,
                'id' => $item->ID,
            ]);
        }
    }

    /**
     * Deletes an existing Newspartner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $item = $this->findModel($id);
        unlink('../../img/news/'.$item->Photo);
        $item->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Newspartner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Newspartner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Newspartner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function rus2translit($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }
    private function translite($str) {
        // переводим в транслит
        $str = $this->rus2translit($str);
        // в нижний регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        $str = str_replace('«', '', $str);
        $str = str_replace('»', '', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }
}
