<?php

namespace app\controllers;

use app\models\User;
use app\models\Dep;
use app\models\Course;
use app\models\UserSearch;
use app\models\UserRight;
use app\models\UserRightSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    private function getUser() :?User {
        return Yii::$app->user->isGuest ? null : Yii::$app->user->identity->user;
    }
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        $user = $this->getUser();
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,                    
                    'rules' => [
                        [
                            //'actions' => ['index'],
                            'allow' => true,
                            'matchCallback' => function() use($user) {
                                return $user->is_admin;                                
                            },
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'deps' => Dep::getList(),
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id Код
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'rightIndex' => $this->renderRightIndex($model),
        ]);
    }
        
    private function renderRightIndex(User $model) {
        $searchModel = new UserRightSearch();
        $searchModel->user_id = $model->id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->renderPartial('/user-right/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'types' => UserRight::getTypeList(),
            'courses' => Course::getList(),
            
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form', [
            'model' => $model,
            'deps' => Dep::getList(),            
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id Код
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('form', [
            'model' => $model,
            'deps' => Dep::getList(),            
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Код
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Код
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
