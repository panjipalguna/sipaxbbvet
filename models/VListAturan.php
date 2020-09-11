<?php
namespace app\models;
use Yii;

class VListAturan extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'v_list_aturan';
    }

    public function rules()
    {
        return [
            [['kode'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama',
        ];
    }
}
