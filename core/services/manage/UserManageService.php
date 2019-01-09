<?php

namespace core\services\manage;

use core\entities\user\User;
use core\repositories\UserRepository;
use backend\forms\user\UserEditForm;
use backend\forms\user\UserCreateForm;

/**
 * User management service
 */
class UserManageService
{
	private $repository;

	/**
	 * UserManageService constructor.
	 * @param UserRepository $repository
	 */
	public function __construct(UserRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @param UserCreateForm $form
	 * @return User
	 * @throws \yii\base\Exception
	 */
	public function create(UserCreateForm $form): User
	{
		$user = User::create(
			$form->username,
			$form->email,
			$form->password
		);

		$this->repository->save($user);

		return $user;
	}

	/**
	 * @param $id
	 * @param UserEditForm $form
	 */
	public function edit($id, UserEditForm $form): void
	{
		$user = $this->repository->get($id);
		$user->edit(
			$form->username,
			$form->email
		);
		$this->repository->save($user);
	}

	/**
	 * @param $id
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function remove($id): void
	{
		$user = $this->repository->get($id);
		$this->repository->remove($user);
	}
}
