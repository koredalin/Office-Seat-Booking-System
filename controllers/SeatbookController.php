<?php

namespace app\controllers;

use app\models\Seat;
use app\models\SeatBook;
use app\models\SeatBookTimeSlot;
use app\models\Employee;
use app\models\Office;
use app\models\search\SeatBookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\services\DateTimeManager as DtManager;

/**
 * SeatbookController implements the CRUD actions for SeatBook model.
 */
class SeatbookController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
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
     * Lists all SeatBook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeatBookSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SeatBook model.
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
     * Creates a new SeatBook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SeatBook();
        $model->created_at = DtManager::nowStr();
        $model->updated_at = DtManager::nowStr();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $employees = ArrayHelper::map(Employee::find()->all(), 'id', 'email');
        $offices = ArrayHelper::map(Office::find()->all(), 'id', 'office_name');
        $dayTimeSlotsItems = ArrayHelper::map(SeatBookTimeSlot::find()->all(), 'id', 'label');

        return $this->render('create', [
            'model' => $model,
            'employees' => $employees,
            'offices' => $offices,
            'dayTimeSlotsItems' => $dayTimeSlotsItems,
        ]);
    }

    /**
     * Returns all office seats and already booked office seats.
     *
     * @param int $officeId
     * @param string $bookingDate
     * @param int $timeSlotId
     * @return Response a response that is configured to send `$data` formatted as JSON.
     */
    public function actionOfficeseats(int $officeId, string $bookingDate, int $timeSlotId)
    {
        $result = [];
        $result['allOfficeSeats'] = ArrayHelper::map(
            Seat::find()->getOfficeAllSeats($officeId),
            'id',
            'office_seat_id'
        );
        $result['bookedOfficeSeats'] = ArrayHelper::getColumn(
            SeatBook::find()->getOfficeReservedSeats($officeId, $bookingDate, $timeSlotId),
            'seat_id'
        );

        return $this->asJson(\json_encode($result));
    }

    /**
     * Updates an existing SeatBook model.
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SeatBook model.
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
     * Finds the SeatBook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SeatBook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SeatBook::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
