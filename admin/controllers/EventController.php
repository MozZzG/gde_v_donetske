<?php

namespace app\controllers;

use app\models\Establishment;
use Yii;
use app\models\Event;
use app\models\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\EventForm;
use app\models\Subcategoryevent;
use app\models\Categoryevent;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
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
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
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
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EventForm();
        $item = new Event();
        $cat = Categoryevent::find()->all();
        $first = $cat[0];
        $cat1 = Subcategoryevent::find()->where(['CategoryeventID' => $first->ID])->all();
        $est = Establishment::find()->all();
        $items = ArrayHelper::map($cat, 'ID', 'Name');
        $items1 = ArrayHelper::map($cat1, 'ID', 'Name');
        $ests = ArrayHelper::map($est, 'ID', 'Name');

        if ($model->load(Yii::$app->request->post())) {
            $model->file1 = UploadedFile::getInstance($model, 'file1');
            if ($model->validate()) {
                if ($model->file1)
                    $model->file1->saveAs('../../img/events/' . $this->translite($model->name) . '.' . $model->file1->extension);
                $item->Name = $model->name;
                $item->Place = $model->place;
                $item->Time = $model->time;
                $item->SubcategoryeventID = $model->subcat;
                $item->CategoryeventID = $model->cat;
                $item->Date = $model->date;
                $item->Contacts = $model->contacts;
                $item->EstablishmentID = $model->est;
                $item->IndexTop = $model->itop;
                if ($model->file1)
                    $item->Photo = $this->translite($model->name) .'.' . $model->file1->extension;
                else
                    $item->Photo = '';
                if ($item->validate()) {
                    $item->save();
                    $s = Subcategoryevent::find()->where(['ID' => $item->SubcategoryeventID])->one();
                    $c = Categoryevent::find()->where(['ID' => $item->CategoryeventID])->one();
                    if ($s) {
                        $s->updateCounters(['Count' => 1]);
                        $s->save();
                    }
                    $c->updateCounters(['Count' => 1]);
                    $c->save();
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
                'items1' => $items1,
                'ests' => $ests,
            ]);
        }
    }

    public function actionGetsub($id) {
        $subs = Subcategoryevent::find()->where(['CategoryeventID' => $id])->all();
        $res = '';
        foreach ($subs as $sub) {
            $res .= '<option value="'.$sub->ID.'">'.$sub->Name.'</option>';
        }
        return $res;
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new EventForm();
        $item = Event::find()->where(['ID' => $id])->one();
        $est = Establishment::find()->all();
        $cat = Categoryevent::find()->all();
        $cat1 = Subcategoryevent::find()->where(['CategoryeventID' => $item->CategoryeventID])->all();
        $items = ArrayHelper::map($cat, 'ID', 'Name');
        $items1 = ArrayHelper::map($cat1, 'ID', 'Name');
        $ests = ArrayHelper::map($est, 'ID', 'Name');
        $model->name = $item->Name;
        $model->date = $item->Date;
        $model->place = $item->Place;
        $model->time = $item->Time;
        $model->contacts = $item->Contacts;
        $model->cat = $item->CategoryeventID;
        $model->subcat = $item->SubcategoryeventID;
        $model->itop = $item->IndexTop;
        $model->est = $item->EstablishmentID;

        if ($model->load(Yii::$app->request->post())) {
            $model->file1 = UploadedFile::getInstance($model, 'file1');
            if ($model->validate()) {
                if ($model->file1)
                    $model->file1->saveAs('../../img/events/' . $this->translite($model->name) . '.' . $model->file1->extension);
                $item->Name = $model->name;
                $item->Place = $model->place;
                $item->Time = $model->time;
                $item->SubcategoryeventID = $model->subcat;
                $item->CategoryeventID = $model->cat;
                $item->Date = $model->date;
                $item->Contacts = $model->contacts;
                $item->EstablishmentID = $model->est;
                $item->IndexTop = $model->itop;
                if ($model->file1)
                    $item->Photo = $this->translite($model->name) .'.' . $model->file1->extension;
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
                'id' => $id,
                'items' => $items,
                'items1' => $items1,
                'ests' => $ests,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $item = $this->findModel($id);
        $s = Subcategoryevent::find()->where(['ID' => $item->SubcategoryeventID])->one();
        $c = Categoryevent::find()->where(['ID' => $item->CategoryeventID])->one();
        if ($s) {
            $s->updateCounters(['Count' => -1]);
            $s->save();
        }
        $c->updateCounters(['Count' => -1]);
        $c->save();
        unlink('../../img/events/'.$item->Photo);
        $item->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
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
