<?php
namespace app\models;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use kartik\password\StrengthValidator;
use yii\web\UploadedFile;

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
			[['level','username', 'email', 'password'], 'required'],
			['username', 'string', 'min' => 6, 'max' => 32],
			[['foto'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
			[['username','email'], 'unique'],
			['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['email', 'email'],
			[['password'],
                StrengthValidator::className(),
                'allowSpaces' => false,
                'allowSpacesError'=>'Password harus tanpa spasi.',
				'upper' =>0,
				'special' =>0,
                'lowerError' => 'Password harus memiliki huruf.',
                'digitError' => 'Password harus memiliki angka.',
            ],
        ];
    }
	
	public function upload()
    {
        if ($this->validate()) {
            $this->foto->saveAs('foto/' . $this->foto->baseName . '.' . $this->foto->extension);
            return true;
        } else {
            return false;
        }
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getUsername()
    {
        return \Yii::$app->user->identity->email;
    }

    public function getAuthKey()
    {
        return $this->password;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return $password;
    }
	
	public static function hide($action, $string) {
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'This is my secret key';
		$secret_iv = 'This is my secret iv';
		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action == 'en' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if( $action == 'de' ) {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}
}