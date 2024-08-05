<?php

namespace app\controllers;

use app\models\ClassStudents;
use app\models\ClassStudentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClassStudentsController implements the CRUD actions for ClassStudents model.
 */
class ClassStudentsController extends Controller
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
     * Lists all ClassStudents models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClassStudentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClassStudents model.
     * @param int $class_students_id Class Students ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($class_students_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($class_students_id),
        ]);
    }

    /**
     * Creates a new ClassStudents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ClassStudents();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'class_students_id' => $model->class_students_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ClassStudents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $class_students_id Class Students ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($class_students_id)
    {
        $model = $this->findModel($class_students_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'class_students_id' => $model->class_students_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ClassStudents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $class_students_id Class Students ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($class_students_id)
    {
        $this->findModel($class_students_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ClassStudents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $class_students_id Class Students ID
     * @return ClassStudents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($class_students_id)
    {
        if (($model = ClassStudents::findOne(['class_students_id' => $class_students_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
