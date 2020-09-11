<?php
namespace app\models;
use Yii;

class Pakar extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'pakar';
    }

    public function rules()
    {
        return [
            [['kode_diagnosa', 'kode_gejala', 'mb', 'md'], 'required'],
            [['kode_diagnosa', 'kode_gejala'], 'string', 'max' => 10],
			[['mb', 'md'],'number','min'=>0,'max'=>1],
            [['kode_diagnosa'], 'exist', 'skipOnError' => true, 'targetClass' => Diagnosa::className(), 'targetAttribute' => ['kode_diagnosa' => 'kode']],
            [['kode_gejala'], 'exist', 'skipOnError' => true, 'targetClass' => Gejala::className(), 'targetAttribute' => ['kode_gejala' => 'kode']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_pakar' => 'ID',
            'kode_diagnosa' => 'Diagnosa',
            'kode_gejala' => 'Gejala',
            'mb' => 'Nilai MB',
            'md' => 'Nilai MD',
        ];
    }

    public function getKodeDiagnosa()
    {
        return $this->hasOne(Diagnosa::className(), ['kode' => 'kode_diagnosa']);
    }

    public function getKodeGejala()
    {
        return $this->hasOne(Gejala::className(), ['kode' => 'kode_gejala']);
    }
}
