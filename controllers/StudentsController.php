<?php

namespace app\controllers;

use app\models\Students;
use app\models\StudentsSearch;
use app\models\Users;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentsController implements the CRUD actions for Students model.
 */
class StudentsController extends Controller
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
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Students models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $students = Students::find()->all();
        $searchModel = new StudentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'students' => $students,
        ]);
    }

    /**
     * Displays a single Students model.
     * @param int $student_id Student ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($student_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($student_id),
        ]);
    }

    /**
     * Creates a new Students model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Students();
        $user = new Users();

        if ($this->request->isPost) {
            // Load the data into the Students model
            if ($model->load($this->request->post())) {

                // Generate and set the staff number
                $model->student_no = Students::generateStudentId();

                // Extract staff number from the Students model
                $studentNo = $model->student_no;  // Assuming 'staff_no' is a field in the Students model

                // Set User attributes
                $user->username = $studentNo;  // Set username to staff_no
                $user->password = Yii::$app->security->generatePasswordHash($studentNo);  // Set password to hashed staff_no

                // Use a transaction to ensure both models are saved successfully
                $transaction = Yii::$app->db->beginTransaction();

                try {
                    // Save the User model first
                    if ($user->save()) {
                        // Set the student_id for the User model
                        $model->user_id = $user->user_id; // Assuming user_id is the primary key of the Users model

                        // Save the Students model
                        if ($model->save()) {
                            $transaction->commit();
                            return $this->redirect(['view', 'student_id' => $model->student_id]);
                        } else {
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('error', 'Failed to save teacher.');
                        }
                    } else {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', 'Failed to save user.');
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'An error occurred: ' . $e->getMessage());
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Students model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $student_id Student ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($student_id)
    {
        $model = $this->findModel($student_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'student_id' => $model->student_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Students model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $student_id Student ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($student_id)
    {
        $model = Students::findOne($student_id);
        Users::findOne($model->user_id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Students model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $student_id Student ID
     * @return Students the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($student_id)
    {
        if (($model = Students::findOne(['student_id' => $student_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
