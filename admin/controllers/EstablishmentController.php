<?php

namespace app\controllers;

use Yii;
use app\models\Establishment;
use app\models\EstablishmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Subcategory;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\EstablishmentForm;

/**
 * EstablishmentController implements the CRUD actions for Establishment model.
 */
class EstablishmentController extends Controller
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
     * Lists all Establishment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstablishmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Establishment model.
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
     * Creates a new Establishment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EstablishmentForm();
        $item = new Establishment();
        $cat = Subcategory::find()->all();
        $items = ArrayHelper::map($cat, 'ID', 'Name');

        if ($model->load(Yii::$app->request->post())) {
            $model->file1 = UploadedFile::getInstance($model, 'file1');
            $model->file2 = UploadedFile::getInstance($model, 'file2');
            $model->file3 = UploadedFile::getInstance($model, 'file3');
            $model->file4 = UploadedFile::getInstance($model, 'file4');
            $model->file5 = UploadedFile::getInstance($model, 'file5');
            $model->file6 = UploadedFile::getInstance($model, 'file6');
            $model->file7 = UploadedFile::getInstance($model, 'file7');
            $model->file8 = UploadedFile::getInstance($model, 'file8');
            $model->file9 = UploadedFile::getInstance($model, 'file9');
            $model->file10 = UploadedFile::getInstance($model, 'file10');
            if ($model->validate()) {
                if ($model->file1)
                    $model->file1->saveAs('../../img/establishments/' . $this->translite($model->name) .'_1' . '.' . $model->file1->extension);
                if ($model->file2)
                    $model->file2->saveAs('../../img/establishments/' . $this->translite($model->name) .'_2' . '.' . $model->file1->extension);
                if ($model->file3)
                    $model->file3->saveAs('../../img/establishments/' . $this->translite($model->name) .'_3' . '.' . $model->file1->extension);
                if ($model->file4)
                    $model->file4->saveAs('../../img/establishments/' . $this->translite($model->name) .'_4' . '.' . $model->file1->extension);
                if ($model->file5)
                    $model->file5->saveAs('../../img/establishments/' . $this->translite($model->name) .'_5' . '.' . $model->file1->extension);
                if ($model->file6)
                    $model->file6->saveAs('../../img/establishments/' . $this->translite($model->name) .'_6' . '.' . $model->file1->extension);
                if ($model->file7)
                    $model->file7->saveAs('../../img/establishments/' . $this->translite($model->name) .'_7' . '.' . $model->file1->extension);
                if ($model->file8)
                    $model->file8->saveAs('../../img/establishments/' . $this->translite($model->name) .'_8' . '.' . $model->file1->extension);
                if ($model->file9)
                    $model->file9->saveAs('../../img/establishments/' . $this->translite($model->name) .'_9' . '.' . $model->file1->extension);
                if ($model->file10)
                    $model->file10->saveAs('../../img/establishments/' . $this->translite($model->name) .'_10' . '.' . $model->file1->extension);
                $item->Name = $model->name;
                $item->About = $model->about;
                $item->Text = $model->text;
                $item->Map = $model->map;
                $item->Video = str_replace('watch?v=', 'embed/', $model->video);
                $item->Worktime = $model->worktime;
                $item->Phone = $model->phone;
                $item->Address = $model->address;
                $item->Website = $model->website;
                $item->Field1Name = $model->field1name;
                $item->Field1Value = $model->field1value;
                $item->Field2Name = $model->field2name;
                $item->Field2Value = $model->field2value;
                $item->SubcategoryID = $model->subcat;
                $item->Top = $model->top;
                $item->IndexTop = $model->indextop;
                if ($model->file1)
                    $item->Photo1 = $this->translite($model->name) .'_1' . '.' . $model->file1->extension;
                else
                    $item->Photo1 = '';
                if ($model->file2)
                    $item->Photo2 = $this->translite($model->name) .'_2' . '.' . $model->file2->extension;
                else
                    $item->Photo2 = '';
                if ($model->file3)
                    $item->Photo3 = $this->translite($model->name) .'_3' . '.' . $model->file1->extension;
                else
                    $item->Photo3 = '';
                if ($model->file4)
                    $item->Photo4 = $this->translite($model->name) .'_4' . '.' . $model->file1->extension;
                else
                    $item->Photo4 = '';
                if ($model->file5)
                    $item->Photo5 = $this->translite($model->name) .'_5' . '.' . $model->file1->extension;
                else
                    $item->Photo5 = '';
                if ($model->file6)
                    $item->Photo6 = $this->translite($model->name) .'_6' . '.' . $model->file1->extension;
                else
                    $item->Photo6 = '';
                if ($model->file7)
                    $item->Photo7 = $this->translite($model->name) .'_7' . '.' . $model->file1->extension;
                else
                    $item->Photo7 = '';
                if ($model->file8)
                    $item->Photo8 = $this->translite($model->name) .'_8' . '.' . $model->file1->extension;
                else
                    $item->Photo8 = '';
                if ($model->file9)
                    $item->Photo9 = $this->translite($model->name) .'_9' . '.' . $model->file1->extension;
                else
                    $item->Photo9 = '';
                if ($model->file10)
                    $item->Photo10 = $this->translite($model->name) .'_10' . '.' . $model->file1->extension;
                else
                    $item->Photo10 = '';
                $item->Views = 0;
                $item->Likes = 0;
                $item->Comments = 0;
                $item->Rating = 0;
                $item->UserID = 0;
                if ($item->validate()) {
                    $item->save();
                    return $this->redirect(['view', 'id' => $item->ID]);
                }
                else {
                    foreach ($model->getErrors() as $it) {
                        echo $it[0];
                    }
                }
            }
            else {
                foreach ($model->getErrors() as $it) {
                    echo $it[0];
                }
            }
        }
        else {
            return $this->render('create', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }

    /**
     * Updates an existing Establishment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new EstablishmentForm();
        $item = $this->findModel($id);
        $cat = Subcategory::find()->all();
        $items = ArrayHelper::map($cat, 'ID', 'Name');
        $model->name = $item->Name;
        $model->about = $item->About;
        $model->text = $item->Text;
        $model->map = $item->Map;
        $model->video = str_replace('embed/', 'watch?v=', $item->Video);
        $model->worktime = $item->Worktime;
        $model->phone = $item->Phone;
        $model->address = $item->Address;
        $model->website = $item->Website;
        $model->field1name = $item->Field1Name;
        $model->field1value = $item->Field1Value;
        $model->field2name = $item->Field2Name;
        $model->field2value = $item->Field2Value;
        $model->subcat = $item->SubcategoryID;
        $model->top = $item->Top;
        $model->indextop = $item->IndexTop;
        $id = $item->ID;

        if ($model->load(Yii::$app->request->post())) {
            $model->file1 = UploadedFile::getInstance($model, 'file1');
            $model->file2 = UploadedFile::getInstance($model, 'file2');
            $model->file3 = UploadedFile::getInstance($model, 'file3');
            $model->file4 = UploadedFile::getInstance($model, 'file4');
            $model->file5 = UploadedFile::getInstance($model, 'file5');
            $model->file6 = UploadedFile::getInstance($model, 'file6');
            $model->file7 = UploadedFile::getInstance($model, 'file7');
            $model->file8 = UploadedFile::getInstance($model, 'file8');
            $model->file9 = UploadedFile::getInstance($model, 'file9');
            $model->file10 = UploadedFile::getInstance($model, 'file10');
            if ($model->validate()) {
                if ($model->file1)
                    $model->file1->saveAs('../../img/establishments/' . $this->translite($model->name) .'_1' . '.' . $model->file1->extension);
                if ($model->file2)
                    $model->file2->saveAs('../../img/establishments/' . $this->translite($model->name) .'_2' . '.' . $model->file1->extension);
                if ($model->file3)
                    $model->file3->saveAs('../../img/establishments/' . $this->translite($model->name) .'_3' . '.' . $model->file1->extension);
                if ($model->file4)
                    $model->file4->saveAs('../../img/establishments/' . $this->translite($model->name) .'_4' . '.' . $model->file1->extension);
                if ($model->file5)
                    $model->file5->saveAs('../../img/establishments/' . $this->translite($model->name) .'_5' . '.' . $model->file1->extension);
                if ($model->file6)
                    $model->file6->saveAs('../../img/establishments/' . $this->translite($model->name) .'_6' . '.' . $model->file1->extension);
                if ($model->file7)
                    $model->file7->saveAs('../../img/establishments/' . $this->translite($model->name) .'_7' . '.' . $model->file1->extension);
                if ($model->file8)
                    $model->file8->saveAs('../../img/establishments/' . $this->translite($model->name) .'_8' . '.' . $model->file1->extension);
                if ($model->file9)
                    $model->file9->saveAs('../../img/establishments/' . $this->translite($model->name) .'_9' . '.' . $model->file1->extension);
                if ($model->file10)
                    $model->file10->saveAs('../../img/establishments/' . $this->translite($model->name) .'_10' . '.' . $model->file1->extension);
                $item->Name = $model->name;
                $item->About = $model->about;
                $item->Text = $model->text;
                $item->Map = $model->map;
                $item->Video = str_replace('watch?v=', 'embed/', $model->video);
                $item->Worktime = $model->worktime;
                $item->Phone = $model->phone;
                $item->Address = $model->address;
                $item->Website = $model->website;
                $item->Field1Name = $model->field1name;
                $item->Field1Value = $model->field1value;
                $item->Field2Name = $model->field2name;
                $item->Field2Value = $model->field2value;
                $item->SubcategoryID = $model->subcat;
                $item->Top = $model->top;
                $item->IndexTop = $model->indextop;
                if ($model->file1)
                    $item->Photo1 = $this->translite($model->name) .'_1' . '.' . $model->file1->extension;
                if ($model->file2)
                    $item->Photo2 = $this->translite($model->name) .'_2' . '.' . $model->file2->extension;
                if ($model->file3)
                    $item->Photo3 = $this->translite($model->name) .'_3' . '.' . $model->file1->extension;
                if ($model->file4)
                    $item->Photo4 = $this->translite($model->name) .'_4' . '.' . $model->file1->extension;
                if ($model->file5)
                    $item->Photo5 = $this->translite($model->name) .'_5' . '.' . $model->file1->extension;
                if ($model->file6)
                    $item->Photo6 = $this->translite($model->name) .'_6' . '.' . $model->file1->extension;
                if ($model->file7)
                    $item->Photo7 = $this->translite($model->name) .'_7' . '.' . $model->file1->extension;
                if ($model->file8)
                    $item->Photo8 = $this->translite($model->name) .'_8' . '.' . $model->file1->extension;
                if ($model->file9)
                    $item->Photo9 = $this->translite($model->name) .'_9' . '.' . $model->file1->extension;
                if ($model->file10)
                    $item->Photo10 = $this->translite($model->name) .'_10' . '.' . $model->file1->extension;
                if ($item->validate()) {
                    $item->save();
                    return $this->redirect(['view', 'id' => $item->ID]);
                }
                else {
                    foreach ($model->getErrors() as $it) {
                        echo $it[0];
                    }
                }
            }
            else {
                foreach ($model->getErrors() as $it) {
                    echo $it[0];
                }
            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
                'items' => $items,
                'id' => $id,
            ]);
        }
    }

    /**
     * Deletes an existing Establishment model.
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
     * Finds the Establishment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Establishment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Establishment::findOne($id)) !== null) {
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
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }
}
