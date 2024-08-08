<?php

namespace app\models;

use yii\base\BaseObject;
use yii\web\IdentityInterface;
use Yii; // Import Yii's main class
use app\models\Users; // Import the Users model

class User extends BaseObject implements IdentityInterface
{
    public $user_id;
    public $username;
    public $password; // This will be the hashed password from the database

    private static $users = [];

    // Populate static users data
    private static function loadUsers()
    {
        if (empty(self::$users)) {
            $users = Users::find()->all(); // Fetch all users from the database
            foreach ($users as $user) {
                self::$users[$user->user_id] = [
                    'user_id' => $user->user_id,
                    'username' => $user->username,
                    'password' => $user->password, // Store hashed password
                ];
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($user_id)
    {
        self::loadUsers(); // Ensure users are loaded
        return isset(self::$users[$user_id]) ? new static(self::$users[$user_id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Since authKey and accessToken are not used, this method can be removed or modified as needed
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        self::loadUsers(); // Ensure users are loaded
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        // Since authKey is not used, this method can be removed or modified as needed
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        // Since authKey is not used, this method can be removed or modified as needed
        return false;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
