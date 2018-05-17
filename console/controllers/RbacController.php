<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 17.05.17
 * Time: 16:15
 */


namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $rule = new \console\rbac\TouristRule();
        $auth->add($rule);

        // добавляем разрешение "createDoorLock"
        $createDoorLock = $auth->createPermission('createDoorLock');
        $createDoorLock->description = 'Create a DoorLock';
        $auth->add($createDoorLock);

        // добавляем разрешение "updateDoorLock"
        $updateDoorLock = $auth->createPermission('updateDoorLock');
        $updateDoorLock->description = 'Update DoorLock';
        $auth->add($updateDoorLock);

        // добавляем разрешение "deleteDoorLock"
        $deleteDoorLock = $auth->createPermission('deleteDoorLock');
        $deleteDoorLock->description = 'Delete DoorLock';
        $auth->add($deleteDoorLock);

        // добавляем разрешение "createEKey"
        $createEKey = $auth->createPermission('createEKey');
        $createEKey->description = 'Create a E-key';
//        $createEKey->ruleName = $rule->name;
        $auth->add($createEKey);

        // добавляем разрешение "updateEKey"
        $updateEKey = $auth->createPermission('updateEKey');
        $updateEKey->description = 'Update EKey';
        $auth->add($updateEKey);

        // добавляем разрешение "deleteEKey"
        $deleteEKey = $auth->createPermission('deleteEKey');
        $deleteEKey->description = 'Delete EKey';
//        $deleteEKey->ruleName = $rule->name;
        $auth->add($deleteEKey);
        
        // добавляем разрешение "createKeyboardPwd"
        $createKeyboardPwd = $auth->createPermission('createKeyboardPwd');
        $createKeyboardPwd->description = 'Create a KeyboardPwd';
//        $createKeyboardPwd->ruleName = $rule->name;
        $auth->add($createKeyboardPwd);
       // $auth->add($rule);

        // добавляем разрешение "updateKeyboardPwd"
        $updateKeyboardPwd = $auth->createPermission('updateKeyboardPwd');
        $updateKeyboardPwd->description = 'Update KeyboardPwd';
        $auth->add($updateKeyboardPwd);

        // добавляем разрешение "deleteKeyboardPwd"
        $deleteKeyboardPwd = $auth->createPermission('deleteKeyboardPwd');
        $deleteKeyboardPwd->description = 'Delete KeyboardPwd';
//        $deleteKeyboardPwd->ruleName = $rule->name;
        $auth->add($deleteKeyboardPwd);

        // добавляем разрешение "createPhotoImage"
        $createPhotoImage = $auth->createPermission('createPhotoImage');
        $createPhotoImage->description = 'Create a Photo-Image';
        $auth->add($createPhotoImage);

        // добавляем разрешение "updatePhotoImage"
        $updatePhotoImage = $auth->createPermission('updatePhotoImage');
        $updatePhotoImage->description = 'Update Photo-Image';
        $auth->add($updatePhotoImage);

        // добавляем разрешение "deletePhotoImage"
        $deletePhotoImage = $auth->createPermission('deletePhotoImage');
        $deletePhotoImage->description = 'Delete Photo-Image';
        $auth->add($deletePhotoImage);
        
        // добавляем роль "receptionist" и даём роли разрешения
        $receptionist = $auth->createRole('receptionist');
        $auth->add($receptionist);
        $auth->addChild($receptionist, $createDoorLock);
        $auth->addChild($receptionist, $updateDoorLock);
        $auth->addChild($receptionist, $createKeyboardPwd);
        $auth->addChild($receptionist, $deleteKeyboardPwd);
        $auth->addChild($receptionist, $updateKeyboardPwd);
        $auth->addChild($receptionist, $createEKey);
        $auth->addChild($receptionist, $deleteEKey);
        $auth->addChild($receptionist, $updateEKey);

        // добавляем роль "tourist" и даем разрешение "createPhotoImage"
        $tourist = $auth->createRole('tourist');
        $auth->add($tourist);
        $auth->addChild($tourist, $createPhotoImage);


        // добавляем роль "admin" и даём роли разрешение  "deleteDoorLock"
        // а также все разрешения роли "receptionist"
        // а также все разрешения роли "tourist"  
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $deleteDoorLock);
        $auth->addChild($admin, $receptionist);
        $auth->addChild($admin, $tourist);

        // Назначение ролей пользователям. 1,2,3 это IDs возвращаемые IdentityInterface::getId()
        // Это текущие id в базе

        $auth->assign($receptionist, 2);
        $auth->assign($admin, 3);
        $auth->assign($tourist, 1);

//        $auth->add($rule);

// добавляем разрешение "updateOwnPost" и привязываем к нему правило.
        $createKeyboardPwdByTourist = $auth->createPermission('createKeyboardPwdByTourist');
        $createKeyboardPwdByTourist->description = 'Tourist can create Keyboard password for period of staying';
        $createKeyboardPwdByTourist->ruleName = $rule->name;
        $auth->add($createKeyboardPwdByTourist);

// "createKeyboardPwdByTourist" будет использоваться из "createKeyboardPwd"
        $auth->addChild($createKeyboardPwdByTourist, $createKeyboardPwd);

// разрешаем "туристу" генеировать ключи на период его пребывания
        $auth->addChild($tourist, $createKeyboardPwdByTourist);

    }

    public function actionLock()
    {
        $auth = Yii::$app->authManager;
        $rule = new \console\rbac\isUsingBy();
        $auth->add($rule);

        // добавляем разрешение "createDoorLock"
        $doorLockManagement = $auth->createPermission('DoorLockManagement');
        $doorLockManagement->description = 'Create/Install/Unistall/View a DoorLock';
        $doorLockManagement->ruleName = $rule->name;
        $auth->add($doorLockManagement);

    }
}