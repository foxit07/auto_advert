<?php

namespace app\modules\advert\controllers;

use app\modules\advert\models\Brand;
use app\modules\advert\models\Image;
use app\modules\advert\models\Model;
use app\modules\advert\models\Option;
use Yii;
use app\modules\advert\models\Advert;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;


/**
 * AdvertController implements the CRUD actions for Advert model.
 */
class AdvertController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Advert models.
     * @return mixed
     */
    public function actionIndex()
    {

        $adverts = Advert::find()->all();
        $data = $this->prepareDataAll($adverts);
        $pages = new Pagination(['totalCount' => count($data) , 'pageSize'=>5]);
        $data = array_slice($data, $pages->offset, $pages->limit);

        return $this->render('index', [
            'data' => $data,
            'pages' => $pages
        ]);
    }

    /**
     * Displays a single Advert model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $advert = Advert::find()->where(['id' => $id])->one();
        $data = $this->prepareDataOne($advert);

        return $this->render('view', [
            'advert' => $data,
        ]);
    }

    /**
     * Creates a new Advert model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $advert = new Advert();
        $brand = new Brand();
        $options = new Option();
        $model = new Model();
        $image = new Image();

        $brands = ArrayHelper::map($brand->find()->all(), 'id', 'name');
        $models = ArrayHelper::map(Model::find()->where(['brand_id' => key($brands)])->all(),'id','name');

        if ($advert->load(Yii::$app->request->post())){
                $data = Yii::$app->request->post();
                if($advert->saveAll($data)) {
                    return $this->redirect(['view', 'id' => $advert->id]);
                }
            }

        return $this->render('create', [
            'advert' => $advert,
            'brand' => $brand,
            'brands' => $brands,
            'options' => $options,
            'models' => $models,
            'image' => $image,
        ]);
    }

    /**
     * Updates an existing Advert model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $options = new Option();
        $image = new Image();
        $advert = $this->findModel($id);
        $brands = ArrayHelper::map(Brand::find()->all(),'id','name');
        $model = Model::find()->where(['id' => $advert->model_id])->one();
        $brand = $model->brand;
        $options->name = ArrayHelper::getColumn($advert->options,'id');

        if ($advert->load(Yii::$app->request->post()) ) {
            $data = Yii::$app->request->post();
            $advert->saveAll($data, 'update');

            return $this->redirect(['view', 'id' => $advert->id]);
        }

        return $this->render('update', [
            'advert' => $advert,
            'options' => $options,
            'brand' => $brand,
            'brands' => $brands,
            'model' => $model,
            'image' => $image,
        ]);
    }

    /**
     * Deletes an existing Advert model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $image = new Image();
        $advert = new Advert();

        $advert->destroyOptions($this->findModel($id));
        $image->deleteImage($this->findModel($id));

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Advert model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Advert the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advert::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionModels()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('key');
            $models = Model::find()->where(['brand_id' => $id])->select('id, name')->all();
            return $models;
        }
    }

    /**
     * @param $adverts
     * @return $data array
     */
    private function prepareDataAll($adverts)
    {

        foreach ($adverts as $advert)
        {
            $model = Model::find()->where(['id' => $advert->model_id])->one();
            $brand = $model->brand;
            $data[] =[
                'id' => $advert->id,
                'price' => $advert->price,
                'image' => $advert->images[0]->path,
                'brand' => $model->brand->name,
                'model' => $model->name
            ];

        }

        return $data;
    }

    /**
     * @param $advert | Advert
     * @return array
     */
    private function prepareDataOne($advert)
    {
            $model = Model::find()->where(['id' => $advert->model_id])->one();
            $brand = $model->brand;

            $option = function ($advert, $param, $key) {
                foreach ($advert->$param as $value){
                    $data[] = $value->$key;
                }
                return !empty($data) ? $data : null;
            };

            $data =[
                'id' => $advert->id,
                'price' => $advert->price,
                'image' => $option($advert, 'images', 'path'),
                'options' => $option($advert, 'options', 'name'),
                'brand' => $model->brand->name,
                'model' => $model->name
            ];

        return $data;
    }
}
