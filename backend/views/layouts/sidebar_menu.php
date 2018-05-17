<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 2/18/18
 * Time: 6:03 PM
 */

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;




 NavBar ::begin([
    'brandLabel' => 'Rona-rEception',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navigation navigation-main navigation-accordion',
    ],
]);
                            if (!Yii::$app->user->isGuest) {
                                $menuItems = [
                                    ['label' => 'Kvarner', 'url' => ['/rents/reception','reception'=>'Kvarner']],
                                    ['label' => 'Gajac', 'url' => ['/rents/reception','reception'=>'Gajac']],
                                    ['label' => 'Savudrija', 'url' => ['/rents/reception','reception'=>'Savudrija']],
                                    ['label' => 'Mareda', 'url' => ['/rents/reception','reception'=>'Mareda']],
                                    ['label' => 'Cervar', 'url' => ['/rents/reception','reception'=>'Cervar']],
                                    ['label' => 'Zaglav', 'url' => ['/rents/reception','reception'=>'Zaglav']],
                                    ['label' => 'Barbariga', 'url' => ['/rents/reception','reception'=>'Barbariga']],
                                ];
                            }
                            if (Yii::$app->user->isGuest) {
                                $menuItems[] = ['label' => 'Login', 'url' => ['/auth/login']];
                            } else {
                                $menuItems[] = '<li>'
                                    . Html::beginForm(['/auth/logout'], 'post')
                                    . Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->getUsername() . ')',
                                        ['class' => 'btn btn-link logout']
                                    )
                                    . Html::endForm()
                                    . '</li>';
                            }
                            echo Nav::widget([
                                'options' => ['class' => 'nav'],
                                'items' => $menuItems,
                            ]);
                            NavBar::end();
                            ?>