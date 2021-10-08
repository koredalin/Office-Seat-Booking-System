<?php

namespace app\controllers;

use app\models\Seat;
use app\models\Office;
use app\models\search\SeatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\services\DateTimeManager as DtManager;

/**
 * SeatController implements the CRUD actions for Seat model.
 */
class SeatController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Seat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeatSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Seat model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Seat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Seat();

        if ($this->request->isPost) {
            $post = $this->request->post();
            $officeId = isset($post['Seat']['office_id']) ? (int)$post['Seat']['office_id'] : 0;
            $model->office_seat_id = $officeId == 0 ? $officeId++ : Seat::find()->getMaxOfficeSeatId($officeId) + 1;
            $model->created_at = DtManager::nowStr();
            $model->updated_at = DtManager::nowStr();
            if ($model->load($post) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        
        $offices = ArrayHelper::map(Office::find()->all(), 'id', 'office_name');

        return $this->render('create', [
            'model' => $model,
            'offices' => $offices,
        ]);
    }

    /**
     * Updates an existing Seat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at = DtManager::nowStr();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $offices = ArrayHelper::map(Office::find()->all(), 'id', 'office_name');

        return $this->render('update', [
             'model' => $model,
             'offices' => $offices,
        ]);
    }

    /**
     * Deletes an existing Seat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Seat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Seat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Seat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
