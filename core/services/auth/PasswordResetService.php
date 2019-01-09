<?php

namespace core\services\auth;

use Yii;
use common\forms\auth\PasswordResetRequestForm;
use common\forms\auth\ResetPasswordForm;
use core\repositories\UserRepository;
use yii\mail\MailerInterface;

/**
 * The service request processing for the password recovery
 */
class PasswordResetService
{
    private $users;
    private $mailer;

    /**
     * PasswordResetService constructor.
     * @param UserRepository $users
     * @param MailerInterface $mailer
     */
    public function __construct(UserRepository $users, MailerInterface $mailer)
    {
        $this->users = $users;
        $this->mailer = $mailer;
    }

    /**
     * Request processing
     * @param PasswordResetRequestForm $form
     * @throws \yii\base\Exception
     */
    public function request(PasswordResetRequestForm $form): void
    {
        $user = $this->users->getByEmail($form->email);

        if (!$user) {
            throw new \DomainException('User is not found');
        }

        $user->requestPasswordReset();
        $this->users->save($user);

        $sent = $this
            ->mailer
            ->compose(
                ['html' => 'auth/reset/confirm-html', 'text' => 'auth/reset/confirm-text'],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error');
        }
    }

    /**
     * Validate token
     * @param $token
     */
    public function validateToken($token): void
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }

        if (!$this->users->existsByPasswordResetToken($token)) {
            throw new \DomainException('Wrong password reset token.');
        }
    }

    /**
     * Reset password
     * @param string $token
     * @param ResetPasswordForm $form
     * @throws \yii\base\Exception
     */
    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = $this->users->getByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->users->save($user);
    }
}
