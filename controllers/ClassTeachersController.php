<?php

namespace app\controllers;

use app\models\ClassTeachers;
use app\models\ClassTeachersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClassTeachersController implements the CRUD actions for ClassTeachers model.
 */
class ClassTeachersController extends Controller
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
     * Lists all ClassTeachers models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClassTeachersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClassTeachers model.
     * @param int $class_teahers_id Class Teahers ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($class_teahers_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($class_teahers_id),
        ]);
    }

    /**
     * Creates a new ClassTeachers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ClassTeachers();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'class_teahers_id' => $model->class_teahers_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ClassTeachers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $class_teahers_id Class Teahers ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($class_teahers_id)
    {
        $model = $this->findModel($class_teahers_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'class_teahers_id' => $model->class_teahers_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ClassTeachers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $class_teahers_id Class Teahers ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($class_teahers_id)
    {
        $this->findModel($class_teahers_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ClassTeachers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $class_teahers_id Class Teahers ID
     * @return ClassTeachers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($class_teahers_id)
    {
        if (($model = ClassTeachers::findOne(['class_teahers_id' => $class_teahers_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
