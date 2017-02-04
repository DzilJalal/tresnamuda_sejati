<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $ID
 * @property string $USERNAME
 * @property string $AUTH_KEY
 * @property string $PASSWORD_HASH
 * @property string $PASSWORD_RESET_TOKEN
 * @property string $EMAIL
 * @property integer $STATUS
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 *
 * @property InventarisDiUser[] $inventarisDiUsers
 */
class User extends ActiveRecord implements IdentityInterface {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ID'], 'required'],
            [['ID', 'STATUS', 'CREATED_AT', 'UPDATED_AT'], 'integer'],
            [['USERNAME', 'PASSWORD_HASH', 'PASSWORD_RESET_TOKEN', 'EMAIL'], 'string', 'max' => 255],
            [['AUTH_KEY'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'USERNAME' => 'Username',
            'AUTH_KEY' => 'Auth  Key',
            'PASSWORD_HASH' => 'Password  Hash',
            'PASSWORD_RESET_TOKEN' => 'Password  Reset  Token',
            'EMAIL' => 'Email',
            'STATUS' => 'Status',
            'CREATED_AT' => 'Created  At',
            'UPDATED_AT' => 'Updated  At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarisDiUsers() {
        return $this->hasMany(InventarisDiUser::className(), ['ID' => 'ID']);
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find() {
        return new UserQuery(get_called_class());
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['auth_key' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

}
