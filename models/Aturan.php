<?php
namespace app\models;
use Yii;

class Aturan extends \yii\db\ActiveRecord
{
	public $cfuser;

    public static function tableName()
    {
        return 'aturan';
    }

    public function rules()
    {
        return [
            [['kode_gejala'], 'required'],
			[['cfuser'],'number','min'=>0,'max'=>1],
            [['kode_gejala', 'ya', 'tidak'], 'string', 'max' => 10],
            [['kode_gejala'], 'exist', 'skipOnError' => true, 'targetClass' => Gejala::className(), 'targetAttribute' => ['kode_gejala' => 'kode']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_aturan' => 'Id Aturan',
            'kode_gejala' => 'Kode Gejala',
            'ya' => 'Ya',
            'tidak' => 'Tidak',
            'cfuser' => 'CF User',
        ];
    }

    public function getGejala1()
    {
        return $this->hasOne(Gejala::className(), ['kode' => 'kode_gejala']);
    }

    public function getHasilKonsultasis()
    {
        return $this->hasMany(HasilKonsultasi::className(), ['id_aturan' => 'id_aturan']);
    }
}
