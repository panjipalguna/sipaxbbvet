<?php

namespace app\controllers;

use Yii;
use app\models\Pakar;
use app\models\Konsultasi;
use app\models\HasilKonsultasi;
use app\models\HasilKonsultasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HasilKonsultasiController implements the CRUD actions for HasilKonsultasi model.
 */
class HasilKonsultasiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                ],
            ],
        ];
    }

    /**
     * Lists all HasilKonsultasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HasilKonsultasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HasilKonsultasi model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HasilKonsultasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HasilKonsultasi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_hasil_konsultasi]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing HasilKonsultasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_hasil_konsultasi]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing HasilKonsultasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HasilKonsultasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return HasilKonsultasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HasilKonsultasi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionRiwayat()
    {
        $model = new HasilKonsultasi();
        $model->id_konsultasi=Yii::$app->session['id_konsultasi'];
		$model->id_aturan=Yii::$app->request->queryParams['p'];
		$model->jawaban=Yii::$app->request->queryParams['j'];
		if($model->jawaban==1){
			$model->cf_user=Yii::$app->request->queryParams['Aturan']['cfuser'];
			if(is_numeric($model->cf_user)){
				if($model->cf_user < 0 || $model->cf_user > 1)
					\Yii::$app->session->setFlash('danger', 'Masukkan nilai harus angka antara 0-1.');
			}else
				\Yii::$app->session->setFlash('danger', 'Masukkan nilai harus berupa angka.');
		}
		if($model->save()){
			if(Yii::$app->request->queryParams['id']==1000)
				return $this->redirect(['/site/no-pengetahuan','id'=>Yii::$app->request->queryParams['id'], 'end'=>1]);
			elseif(Yii::$app->request->queryParams['id'][0]=='D')
				return $this->redirect(['/hasil-konsultasi/cetak','id'=>Yii::$app->request->queryParams['id'], 'end'=>1]);
			else
				return $this->redirect(['/aturan/view','id'=>Yii::$app->request->queryParams['id'], 'end'=>0]);
		}else
			return $this->redirect(['/aturan/view','id'=>Yii::$app->request->queryParams['p'], 'end'=>0]);
    }
	
	public function actionCetak()
    {
		$model=Konsultasi::find()->where('id_konsultasi = :id_konsultasi', 
			[':id_konsultasi' => Yii::$app->session['id_konsultasi']])->one();
		$model->kode_diagnosa=$_GET['id'];
		if($model->save()){
			return $this->redirect(['cf']);
		}
    }
	
	public function actionCf()
	{
		$s_konsultasi=Yii::$app->session['id_konsultasi'];
		IF(!empty($s_konsultasi)){
			$kode_diagnosa=Konsultasi::find()->where('id_konsultasi = :id_konsultasi', 
				[':id_konsultasi' => $s_konsultasi])->one()->kode_diagnosa;
			//Array CF PAKAR
			$cf_pakar=array();
			$pakar = Pakar::find()
				->where('kode_diagnosa = :kode_diagnosa', [':kode_diagnosa' => $kode_diagnosa])
				->orderBy('id_pakar')
				->all();
			foreach($pakar as $a):
				$cf_pakar[]=$a->mb - $a->md;
			endforeach;
			
			//Array CF USER
			$cf_user=array();
			$konsul = HasilKonsultasi::find()
				->where('id_konsultasi = :s_konsultasi', [':s_konsultasi' => $s_konsultasi])
				->andWhere('jawaban = true')
				->orderBy('id_aturan')
				->all();
			foreach($konsul as $b):
				$cf_user[]=$b->cf_user;
			endforeach;
			
			$i=count($cf_pakar);
			$x=0;
			$cf = 0;
			$baru=array();
			if(count($cf_pakar)==count($cf_user)){
				while($x < $i){
					$lama = $cf;
					$baru = $cf_pakar[$x]*$cf_user[$x];
					$cf = $lama + ($baru * (1 - $lama));
					$x++;
				}
				$cf_akhir=number_format($cf, 2);
				$model=Konsultasi::find()->where('id_konsultasi = :id_konsultasi', [':id_konsultasi' => $s_konsultasi])->one();
				$model->hasil_cf=$cf_akhir;
				if($model->save()){
					return $this->redirect(['/site/no-pengetahuan', 'end'=>1]);
				}
			}else
				echo "error";
		}
	}
}
