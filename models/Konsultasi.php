<?php
namespace app\models;
use Yii;

class Konsultasi extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'konsultasi';
    }

    public function rules()
    {
        return [
            [['tanggal', 'id_user', 'nama_penderita', 'jenis_penderita', 'usia_penderita', 'alamat_penderita'], 'required'],
            [['tanggal'], 'safe'],
            [['id_user'], 'default', 'value' => null],
            [['id_user', 'usia_penderita'], 'integer'],
			[['alamat_penderita'], 'string'],
            [['nama_penderita', 'jenis_penderita', 'hasil_cf'], 'string', 'max' => 255],
            [['kode_diagnosa'], 'string', 'max' => 10],
            [['kode_diagnosa'], 'exist', 'skipOnError' => true, 'targetClass' => Diagnosa::className(), 'targetAttribute' => ['kode_diagnosa' => 'kode']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_konsultasi' => 'ID',
            'nama_penderita' => 'Nama Penderita',
            'jenis_penderita' => 'Jenis Penderita',
			'usia_penderita' => 'Usia Penderita',
            'alamat_penderita' => 'Alamat Penderita',
            'kode_diagnosa' => 'Kode Diagnosa',
            'hasil_cf' => 'Hasil CF',
            'tanggal' => 'Tanggal',
            'id_user' => 'Pengguna',
        ];
    }

    public function getHasilKonsultasis()
    {
        return $this->hasMany(HasilKonsultasi::className(), ['id_konsultasi' => 'id_konsultasi']);
    }

    public function getKodeDiagnosa()
    {
        return $this->hasOne(Diagnosa::className(), ['kode' => 'kode_diagnosa']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
