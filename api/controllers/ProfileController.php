<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 14.06.17
 * Time: 23:55
 */

namespace api\controllers;

use Yii;
use api\helpers\DateHelper;
use reception\entities\User\User;
use reception\helpers\UserHelper;
use yii\helpers\Url;
use yii\rest\Controller;

class ProfileController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/profile",
     *     tags={"Auth"},
     *     description="Returns profile info",
     *     @SWG\Parameter( name = "Authorization", in="header", type = "string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),

     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/Profile")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function actionIndex()
    {
        return $this->serializeUser($this->findModel());
    }

    public function verbs(): array
    {
        return [
            'index' => ['get'],
        ];
    }

    private function findModel(): User
    {
        return User::findOne(\Yii::$app->user->id);
    }

    private function serializeUser(User $user): array
    {
       // $roles = Yii::$app->authManager->getRolesByUser($user->id);
        return [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'roles' => UserHelper::getUserRoles($user),
//            'date' => [
//                'created' => DateHelper::formatApi($user->created_at),
//                'updated' => DateHelper::formatApi($user->updated_at),
//            ],
            'status' => [
                'code' => $user->status,
                'name' => UserHelper::statusName($user->status),
            ],
        ];
    }
}
/**
 *  @SWG\Definition(
 *     definition="Profile",
 *     type="object",
 *     required={"id"},
 *     @SWG\Property(property="id", type="integer",example="10"),
 *     @SWG\Property(property="username", type="string",example="myRent"),
 *     @SWG\Property(property="email", type="string",example="example@exam.hr"),
 *     @SWG\Property(property="roles", type="array",
 *          @SWG\Items( type="string", example="receptionist"),
 *     )
 * )
 */
/**
 *  @SWG\Definition(
 *     definition="ProfileOLD",
 *     type="object",
 *     required={"id"},
 *     @SWG\Property(property="id", type="integer",example="10"),
 *     @SWG\Property(property="name", type="string",example="myRent"),
 *     @SWG\Property(property="email", type="string",example="example@exam.hr"),
 *     @SWG\Property(property="date", type="object",
 *          @SWG\Property(property="created", type="string",example="2017-06-14T23:14:23+02:00"),
 *          @SWG\Property(property="updated", type="string",example="2017-06-14T23:14:23+02:00"),
 *
 *     ),
 *     @SWG\Property(property="status", type="object",
 *          @SWG\Property(property="code", type="integer", example="10"),
 *          @SWG\Property(property="name", type="string",example="Active"),
 *
 *      )
 * )
 */
/**
 *  @SWG\Definition(
 *     definition="Date",
 *     type="object",
 *     @SWG\Property(property="created", type="string",example="2017-06-14T23:14:23+02:00"),
 *     @SWG\Property(property="updated", type="string",example="2017-06-14T23:14:23+02:00"),
 * )
 */
/**
 *  @SWG\Definition(
 *     definition="Status",
 *     type="object",
 *     @SWG\Property(property="code", type="integer", example="10"),
 *     @SWG\Property(property="name", type="string",example="Active"),
 * )
 */
/**
 *  @SWG\Definition(
 *     definition="Authorization",
 *     type="object",
 *     required={
 *      "accessToken"
 *      },
 *     @SWG\Property(property="Authorization", type="string", description = "Access Token", example="Bearer b0939c1f6094a0480fc81d20b1fb6fc10553da56"),
 * )
 */
/**
 *  @SWG\Definition(
 *     definition="accessToken",
 *     type="object",
 *     required={
 *      "accessToken"
 *      },
 *     @SWG\Property(property="accessToken", type="string", description = "Access Token", example="b0939c1f6094a0480fc81d20b1fb6fc10553da56"),
 * )
 */