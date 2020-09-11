<?php
namespace app\models;
use Yii;

class Gejala extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'gejala';
    }

    public function rules()
    {
        return [
            [['kode', 'nama'], 'required'],
            [['kode'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 255],
            [['kode'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama Gejala',
        ];
    }

    public function getAturans()
    {
        return $this->hasMany(Aturan::className(), ['kode_gejala' => 'kode']);
    }

    public function getPakars()
    {
        return $this->hasMany(Pakar::className(), ['kode_gejala' => 'kode']);
    }
}
