<?php

namespace core\services\auth;

use Yii;
use core\entities\user\User;
use common\forms\auth\SignupForm;
use core\repositories\UserRepository;
use yii\mail\MailerInterface;

/**
 * Registration service
 */
class SignupService
{
    private $users;
    private $mailer;

    /**
     * SignupService constructor.
     * @param UserRepository $users
     * @param MailerInterface $mailer
     */
    public function __construct(UserRepository $users, MailerInterface $mailer)
    {
        $this->users = $users;
        $this->mailer = $mailer;
    }

    /**
     * @param SignupForm $form
     * @throws \yii\base\Exception
     */
    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->users->save($user);

        $sent = $this
            ->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Signup confirm for ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }
    }

    /**
     * @param $token
     */
    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }

        $user = $this->users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->users->save($user);
    }
}
