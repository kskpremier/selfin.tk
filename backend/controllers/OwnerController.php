<?php

namespace backend\controllers;

use Yii;
use reception\entities\Apartment\Owner;
use reception\forms\OwnerForm;
use reception\forms\OwnerUpdateForm;
use reception\useCases\manage\Apartment\OwnerManageService;
use reception\repositories\Apartment\OwnerRepository;
use backend\models\OwnerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OwnerController implements the CRUD actions for Owner model.
 */
class OwnerController extends Controller
{
    private $owner;
    private $service;


    public function __construct($id, $module, OwnerManageService $service, OwnerRepository $owner, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->owner = $owner;
        $this->service = $service;

    }
    
    
    /**
     * @inheritdoc
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
     * Lists all Owner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OwnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Owner model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Owner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OwnerForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $owner = $this->service->create($model);
                if ($owner) {
                    Yii::$app->session->setFlash('success', 'Onwer an user for him were successfully generated');
                    return $this->redirect(['view', 'id' => $owner->id]);
                } elseif (!$owner->hasErrors()) {
                    Yii::$app->session->setFlash('error', 'Something went wrong. Send info for site administator');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }

        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Owner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $owner = $this->findModel($id);
        $form = new OwnerUpdateForm($owner);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($owner,$form);
                return $this->redirect(['view', 'id' => $owner->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

        } else {
            return $this->render('update', [
                'model' => $form,
            ]);
        }
    }

    /**
     * Deletes an existing Owner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Owner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Owner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Owner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
