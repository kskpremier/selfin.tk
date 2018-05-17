<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Mobile Reception';
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>E-Reception</h1>

        <p class="lead">Excelletnt solution for tourist self-registration, electronic door locks, documents and images recognition </p>

        <p> <?= Html::a('Get started',['auth/login'],['class'=>"btn btn-lg btn-success"])?></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Faces</h2>

                <p>For face recognition we are using API from Vocord</p>

                <p><a class="btn btn-default" href="http://vocord.com/facematica/mobile.php">Vocord &raquo;</a></p>


            </div>
            <div class="col-lg-4">
                <h2>Documents</h2>

                <p>We are using our own OCR solution for document scanning and MRZ reading </p>


            </div>
            <div class="col-lg-4">
                <h2>Door locks</h2>

                <p>We developed customized solution for door lock and key management, using API from biggest door locks producer from China</p>

                <p><a class="btn btn-default" href="http://sciener.cn/">Sciener &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
