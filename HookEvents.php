<?php

namespace yetopen\UsuarioAuditlog;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event as YiiEvent;

use Da\User\Controller\AdminController;
use Da\User\Controller\RecoveryController;
use Da\User\Controller\RegistrationController;
use Da\User\Controller\SecurityController;
use Da\User\Controller\SettingsController;
use Da\User\Event\FormEvent;
use Da\User\Event\UserEvent;
use Da\User\Event\ResetPasswordEvent;
use Da\User\Event\SocialNetworkAuthEvent;
use Da\User\Model\User;

/**
 * This is just an example.
 */
class HookEvents implements BootstrapInterface
{
    public function bootstrap($app)
    {
        YiiEvent::on(SecurityController::class, FormEvent::EVENT_AFTER_LOGIN, function (FormEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' logged in from {ip}", [
                'user' => $event->form->user->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
        YiiEvent::on(SecurityController::class, UserEvent::EVENT_AFTER_LOGOUT, function (UserEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' logged out from {ip}", [
                'user' => $event->user->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
        YiiEvent::on(RegistrationController::class, FormEvent::EVENT_AFTER_REGISTER, function (FormEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' registered from {ip}", [
                'user' => $event->form->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
        YiiEvent::on(RegistrationController::class, UserEvent::EVENT_AFTER_CONFIRMATION, function (UserEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' confirmed from {ip}", [
                'user' => $event->user->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
        YiiEvent::on(AdminController::class, UserEvent::EVENT_AFTER_CREATE, function (UserEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' created from {ip}", [
                'user' => $event->user->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
        YiiEvent::on(AdminController::class, UserEvent::EVENT_AFTER_BLOCK, function (UserEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' has been blocked from {ip}", [
                'user' => $event->user->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
        YiiEvent::on(AdminController::class, UserEvent::EVENT_AFTER_UNBLOCK, function (UserEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' has been unblocked from {ip}", [
                'user' => $event->user->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
        YiiEvent::on(User::class, UserEvent::EVENT_AFTER_REGISTER, function (UserEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' registered from {ip}", [
                'user' => $event->user->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
        YiiEvent::on(RecoveryController::class, ResetPasswordEvent::EVENT_AFTER_RESET, function (ResetPasswordEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' has reset password from {ip}", [
                'user' => $event->token->user->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
        YiiEvent::on(SecurityController::class, SocialNetworkAuthEvent::EVENT_AFTER_CONNECT, function (SocialNetworkAuthEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' connnected to social network {sn} from {ip}", [
                'user' => $event->form->user->username,
                'ip' => Yii::$app->request->remoteIP,
                'sn' => $event->account->provider,
            ]), "usuario.audit");
        });
        YiiEvent::on(SecurityController::class, SocialNetworkAuthEvent::EVENT_AFTER_AUTHENTICATE, function (SocialNetworkAuthEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' logged in via social network {sn} from {ip}", [
                'user' => $event->form->user->username,
                'ip' => Yii::$app->request->remoteIP,
                'sn' => $event->account->provider,
            ]), "usuario.audit");
        });
        YiiEvent::on(SettingsController::class, UserEvent::EVENT_AFTER_DELETE, function (UserEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' deleted from {ip}", [
                'user' => $event->user->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
        YiiEvent::on(SettingsController::class, UserEvent::EVENT_AFTER_ACCOUNT_UPDATE, function (UserEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' account updated from {ip}", [
                'user' => $event->user->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
        YiiEvent::on(SettingsController::class, UserEvent::EVENT_AFTER_PROFILE_UPDATE, function (UserEvent $event) {
            Yii::info(Yii::t('usuario', "User '{user}' profile updated from {ip}", [
                'user' => $event->user->username,
                'ip' => Yii::$app->request->remoteIP,
            ]), "usuario.audit");
        });
    }
}
