<?php

namespace backend\forms\user;

use yii\base\Model;
use core\entities\user\User;

class UserCreateForm extends Model
{
	public $username;
	public $email;
	public $password;

	/**
	 * @return array
	 */
	public function rules(): array
	{
		return [
			[['username', 'email'], 'required'],
			['email', 'email'],
			[['username', 'email'], 'string', 'max' => 255],
			[['username', 'email'], 'unique', 'targetClass' => User::class],
			['password', 'string', 'min' => 6],
		];
	}
}
