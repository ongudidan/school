<?php

namespace app\controllers;

use app\models\TeacherSubjects;
use app\models\TeacherSubjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeacherSubjectsController implements the CRUD actions for TeacherSubjects model.
 */
class TeacherSubjectsController extends Controller
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
     * Lists all TeacherSubjects models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TeacherSubjectsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TeacherSubjects model.
     * @param int $teacher_subject_id Teacher Subject ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($teacher_subject_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($teacher_subject_id),
        ]);
    }

    /**
     * Creates a new TeacherSubjects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TeacherSubjects();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'teacher_subject_id' => $model->teacher_subject_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TeacherSubjects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $teacher_subject_id Teacher Subject ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($teacher_subject_id)
    {
        $model = $this->findModel($teacher_subject_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'teacher_subject_id' => $model->teacher_subject_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TeacherSubjects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $teacher_subject_id Teacher Subject ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($teacher_subject_id)
    {
        $this->findModel($teacher_subject_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TeacherSubjects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $teacher_subject_id Teacher Subject ID
     * @return TeacherSubjects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($teacher_subject_id)
    {
        if (($model = TeacherSubjects::findOne(['teacher_subject_id' => $teacher_subject_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
