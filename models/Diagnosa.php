<?php

namespace app\models;

use Yii;

class Diagnosa extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'diagnosa';
    }

    public function rules()
    {
        return [
            [['kode', 'nama'], 'required'],
            [['solusi'], 'string'],
            [['kode'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 255],
            [['kode'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama Diagnosa',
            'solusi' => 'Solusi',
        ];
    }

    public function getKonsultasis()
    {
        return $this->hasMany(Konsultasi::className(), ['kode_diagnosa' => 'kode']);
    }

    public function getPakars()
    {
        return $this->hasMany(Pakar::className(), ['kode_diagnosa' => 'kode']);
    }
}
