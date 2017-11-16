<?php
namespace frontend\controllers;

use frontend\views\Calculator\CalculateForm;
use frontend\views\Calculator\Calculator;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    /**
     * Displays Calculate page.
     *
     * @return mixed
     */
    public function actionCalculate()
    {
        $form = new CalculateForm();

        if ($form->load(Yii::$app->getRequest()->post(), 'CalculateForm') && $form->validate()) {

            $result = Calculator::calculate($form);

            return $this->render('/Calculator/ComplexView', [
                'model' => $result,
                'modelForm'=>$form
            ]);

        }

        else {
            return $this->render('/Calculator/_Calculator', [
                'model' => $form,
            ]);
        }
    }

    /**
     * Displays Calculate page.
     *
     * @return mixed
     */
    public function actionStatistics()
    {
        //echo dirname(__DIR__);
        require_once 'Classes/PHPExcel.php';
        $pExcel = PHPExcel_IOFactory::load('test.xls');

// Цикл по листам Excel-файла
        foreach ($pExcel->getWorksheetIterator() as $worksheet) {
            // выгружаем данные из объекта в массив
            $tables[] = $worksheet->toArray();
        }
    }

    /**
     * Displays chart page.
     *
     * @return mixed
     */
    public function actionChart($name,$volumeOfBooking=null,$beds=null,$square=null)
    {
        switch ($name) {
            case  "Multichannel" :
                for ($i=2000; $i<20000 ; $i=$i+1) {
                    $X[] = $i;
                    $Y[] = Calculator::calculatePercentageRateForMultichanneling($i);
                }
                $data["Title"] = "Multichannel, %rate from booking value";
                $data["AxisX"] = "Volume of booking, EUR";
                $data["AxisY"] = "Price, %";
                break;
            case  "Yielding" :
                for ($i=2000; $i<20000 ; $i=$i+1) {
                    $X[] = $i;
                    $Y[] = Calculator::calculatePercentageRateForYielding($i);
                }
                $data["Title"] = "Yielding, %rate from booking value";
                $data["AxisX"] = "Volume of booking, EUR";
                $data["AxisY"] = "Price, %";
                break;
            case  "Reception" :
                for ($i=5; $i<50 ; $i=$i+1) {
                    $X[] = $i;
                    $Y[] = Calculator::calculatePercentageRateForReception($i,$volumeOfBooking,$beds);
                }
                $data["Title"] = "Reception, %rate from booking value / smena";
                $data["AxisX"] = "Number of registrations";
                $data["AxisY"] = "Price, %";
                break;
            case  "Housekeeping" :
                for ($i=25; $i<200 ; $i=$i+2) {
                    $X[] = $i;
                    $Y[] = Calculator::calculateEURSquareMPriceForCleaning($i);
                }
                $data["Title"] = "Price for cleaning 1 m2";
                $data["AxisX"] = "m2";
                $data["AxisY"] = "Price, EUR";
                break;

        }

        return $this->render('/Charts/Multichannel', [
            'x' => $X,
            'y' => $Y,
            'legend'=>$data
        ]);


    }
}
