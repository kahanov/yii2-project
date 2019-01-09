<?php

namespace backend\forms\user;

use yii\base\Model;
use core\entities\user\User;

class UserEditForm extends Model
{
    public $username;
    public $email;
    public $_user;

    /**
     * UserEditForm constructor.
     * @param User $user
     * @param array $config
     */
    public function __construct(User $user, $config = [])
    {
        $this->username = $user->username;
        $this->email = $user->email;
        $this->_user = $user;

        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['username', 'email'], 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['username', 'email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
        ];
    }
}
