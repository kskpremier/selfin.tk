<?php

namespace backend\controllers;


use reception\forms\MyRent\DetailFilterForm;
use reception\repositories\Objects\ObjectsReadRepository;
use yii\web\Controller;

class SearchController extends Controller
{
//    public $layout = 'catalog';

    private $objects;


    public function __construct(
        $id,
        $module,
        ObjectsReadRepository $objects,

        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->objects = $objects;

    }

    /**
     * @return mixed
     */
    public function actionSearch()
    {
        $this->layout = 'superuser';

        $user = Yii::$app->user->identity->getUserModel();

        $form = new DetailFilterForm();
        $form->load(\Yii::$app->request->queryParams,['user'=>$user]);
        $form->validate();

        $dataProvider = $this->objects->search($form);

        return $this->render('/yielding/search', [
            'dataProvider' => $dataProvider,
            'detailFilterForm' => $form,
        ]);
    }

}