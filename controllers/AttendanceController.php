<?php

namespace app\controllers;

use app\models\Attendance;
use app\models\AttendanceSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class AttendanceController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['logout'],
                    'rules' => [
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
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Attendance models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AttendanceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Attendance model.
     * @param int $attendance_id Attendance ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($attendance_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($attendance_id),
        ]);
    }

    /**
     * Creates a new Attendance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Attendance();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'attendance_id' => $model->attendance_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Attendance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $attendance_id Attendance ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($attendance_id)
    {
        $model = $this->findModel($attendance_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'attendance_id' => $model->attendance_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Attendance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $attendance_id Attendance ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($attendance_id)
    {
        $this->findModel($attendance_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Attendance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $attendance_id Attendance ID
     * @return Attendance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($attendance_id)
    {
        if (($model = Attendance::findOne(['attendance_id' => $attendance_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
