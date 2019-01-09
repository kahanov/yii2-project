<?php

namespace core\services\auth;

use core\entities\user\User;
use common\forms\auth\LoginForm;
use core\repositories\UserRepository;

/**
 * Authorization service
 */
class AuthService
{
	private $users;

	/**
	 * AuthService constructor.
	 * @param UserRepository $users
	 */
	public function __construct(UserRepository $users)
	{
		$this->users = $users;
	}

	/**
	 * @param LoginForm $form
	 * @return User
	 */
	public function auth(LoginForm $form): User
	{
		$user = $this->users->findByUsernameOrEmail($form->username);

		if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
			throw new \DomainException('Undefined user or password.');
		}

		return $user;
	}
}
