<?php
namespace app\models;
use Yii;

class HasilKonsultasi extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'hasil_konsultasi';
    }

    public function rules()
    {
        return [
            [['id_konsultasi', 'id_aturan', 'jawaban'], 'required'],
            [['id_konsultasi', 'id_aturan'], 'default', 'value' => null],
            [['id_konsultasi', 'id_aturan'], 'integer'],
            [['jawaban'], 'boolean'],
            [['cf_user'],'number','min'=>0,'max'=>1],
            [['id_aturan'], 'exist', 'skipOnError' => true, 'targetClass' => Aturan::className(), 'targetAttribute' => ['id_aturan' => 'id_aturan']],
            [['id_konsultasi'], 'exist', 'skipOnError' => true, 'targetClass' => Konsultasi::className(), 'targetAttribute' => ['id_konsultasi' => 'id_konsultasi']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_hasil_konsultasi' => 'Id Hasil Konsultasi',
            'id_konsultasi' => 'Id Konsultasi',
            'id_aturan' => 'Id Aturan',
            'jawaban' => 'Jawaban',
            'cf_user' => 'Cf User',
        ];
    }

    public function getAturan()
    {
        return $this->hasOne(Aturan::className(), ['id_aturan' => 'id_aturan']);
    }

    public function getKonsultasi()
    {
        return $this->hasOne(Konsultasi::className(), ['id_konsultasi' => 'id_konsultasi']);
    }
}
