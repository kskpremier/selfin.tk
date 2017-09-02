<?php

use yii\db\Migration;

class m170612_080809_init_rbac extends Migration
{
    public function up()
    {
//        $auth = Yii::$app->authManager;
//
//        // add "createPost" permission
//        $createPost = $auth->createPermission('createPost');
//        $createPost->description = 'Create a post';
//        $auth->add($createPost);
//
//        // add "updatePost" permission
//        $updatePost = $auth->createPermission('updatePost');
//        $updatePost->description = 'Update post';
//        $auth->add($updatePost);
//
//        // add "author" role and give this role the "createPost" permission
//        $author = $auth->createRole('author');
//        $auth->add($author);
//        $auth->addChild($author, $createPost);
//
//        // add "admin" role and give this role the "updatePost" permission
//        // as well as the permissions of the "author" role
//        $admin = $auth->createRole('admin');
//        $auth->add($admin);
//        $auth->addChild($admin, $updatePost);
//        $auth->addChild($admin, $author);
//
//        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
//        // usually implemented in your User model.
//        $auth->assign($author, 2);
//        $auth->assign($admin, 1);

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

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
