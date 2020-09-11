<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'BERANDA - SIPAN';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Selamat Datang!</h1>
        <p class="lead">SIPAN (Sistem Pakar Diagnosa Penyakit Anjing pada Hewan dengan Metode <i>Certainty Factor</i>).</p>
        <p>
			<?= Html::a('<i class="fa fa-shield"></i> Mulai Konsultasi', ['/konsultasi/create'], ['class' => 'btn btn-success btn-lg waves-effect waves-light']) ?>
		</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Diagnosa</h2>

                <p>Terdapat 7 diagnosa aktif sampai saat ini. </p>

                <p>
					<?= Html::a('Manajemen Diagnosa &raquo;', ['/diagnosa/index'], ['class' => 'btn btn-default']) ?>
				</p>
            </div>
            <div class="col-lg-4">
                <h2>Gejala</h2>

                <p>SIPAN memiliki 26 gejala dalam menentukan diagnosa terhadap penyakit anjing</p>

                <p><?= Html::a('Manajemen Gejala &raquo;', ['/gejala/index'], ['class' => 'btn btn-default']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Pakar</h2>

                <p>Sistem ini meniru seorang pakar yaitu Dokter Hewan dalam mendiagnosis penyakit pada anjing</p>

                <p><?= Html::a('Manajemen Pakar &raquo;', ['/pakar/index'], ['class' => 'btn btn-default']) ?></p>
            </div>
        </div>

    </div>
</div>
