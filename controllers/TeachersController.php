<?php

namespace app\controllers;

use app\models\Teachers;
use app\models\TeachersSearch;
use App\Models\User;
use app\models\Users;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeachersController implements the CRUD actions for Teachers model.
 */
class TeachersController extends Controller
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
     * Lists all Teachers models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TeachersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teachers model.
     * @param int $teacher_id Teacher ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($teacher_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($teacher_id),
        ]);
    }

    /**
     * Creates a new Teachers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Teachers();
        $user = new Users();

        if ($this->request->isPost) {
            // Load the data into the Teachers model
            if ($model->load($this->request->post())) {

                // Generate and set the staff number
                $model->staff_no = Teachers::generateStaffId();
                
                // Extract staff number from the Teachers model
                $staffNo = $model->staff_no;  // Assuming 'staff_no' is a field in the Teachers model

                // Set User attributes
                $user->username = $staffNo;  // Set username to staff_no
                $user->password = Yii::$app->security->generatePasswordHash($staffNo);  // Set password to hashed staff_no

                // Use a transaction to ensure both models are saved successfully
                $transaction = Yii::$app->db->beginTransaction();

                try {
                    // Save the User model first
                    if ($user->save()) {
                        // Set the teacher_id for the User model
                        $model->user_id = $user->user_id; // Assuming user_id is the primary key of the Users model

                        // Save the Teachers model
                        if ($model->save()) {
                            $transaction->commit();
                            return $this->redirect(['view', 'teacher_id' => $model->teacher_id]);
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
     * Updates an existing Teachers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $teacher_id Teacher ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($teacher_id)
    {
        $model = $this->findModel($teacher_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'teacher_id' => $model->teacher_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Teachers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $teacher_id Teacher ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($teacher_id)
    {
        $user = new Users();
        $model = Teachers::findOne(['teacher_id'=>$teacher_id]);
        $user_id= $model->user_id;


        $this->findModel($teacher_id)->delete();

        $user->findOne(['user_id'=>$user_id])->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Teachers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $teacher_id Teacher ID
     * @return Teachers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($teacher_id)
    {
        if (($model = Teachers::findOne(['teacher_id' => $teacher_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
