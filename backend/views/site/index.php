<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>E-Reception</h1>

        <p class="lead">Prove of concept for self-registration, electronic door locks, documents and images recognition </p>

        <p><a class="btn btn-lg btn-success" href="http://e-reception.local/backend/index.php?r=booking%2Findex">Get started</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Faces</h2>

                <p>For face recognition we are going to use REST-API from Vocord</p>

                <p><a class="btn btn-default" href="https://api.facematica.vocord.ru/v1/">Vocord &raquo;</a></p>


            </div>
            <div class="col-lg-4">
                <h2>Documents</h2>

                <p>For document recognition we are going to use REST-API from ABBY </p>

                <p><a class="btn btn-default" href="http://ocrsdk.com/documentation/apireference/">ABBYY Cloud OCR SDK &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Door locks</h2>

                <p>We are going to develop customized solution for key management, using API from door locks producer from China</p>

                <p><a class="btn btn-default" href="http://www.lockdiosso.com/content-22-162-1.html">Door Digital Lock &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
