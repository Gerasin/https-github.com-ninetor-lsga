<?php

/**
 * Description of MailManager
 *
 * @author gnesenka
 */
class MailManager extends CApplicationComponent {

    public $emailAdmin = 'gnesenka@nineseven.ru';

    public function sendFeedbackUser($id_user, $message) {
        $user = User::model()->findByPk($id_user);
        $to = $this->emailAdmin;
        $subject = "Сообщение от пользователя";
        $headers = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: " . $user->name . " <" . $user->email . ">\r\n";
        $mail = mail($to, $subject, $message, $headers);
        return $mail;
    }

    public function sendContactUser($email, $name, $message) {
        $to = $this->emailAdmin;
        $subject = "Сообщение от пользователя";
        $headers = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: " . $name . " <" . $email . ">\r\n";
        $mail = mail($to, $subject, $message, $headers);
        return $mail;
    }

    public function sendRegistrationUser($email, $password, $login, $name) {
        $to = $email;
        $subject = "Регистрация пользователя";
        $message = '
            <!DOCTYPE html>
                <html>
                    <head>
                        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
                        <style>
                            *{padding:0; margin:0;}
                        </style>
                    </head>
                    <body style="font-family: Arial, Helvetica, sans-serif;">
                        <table align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; border:none; font-family: Arial, Helvetica, sans-serif; width: 600px; color: #757d85; font-size: 15px; margin: 0 auto;">
                            <tr>
                                <td style="text-align: center; padding: 0;">
                                    <a href="#" style="display: block; border: none; margin: 0; padding: 0;"><img src="http://nineseven.ru/html/lsga-m/logo.jpg" alt="" style="width: 600px; height: 120px; display: block;" /></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding: 13px 0; text-transform: uppercase; background: #ff7f0a;">
                                    <a href="http://lsga.nineseven.ru/category/1" style="display: inline-block; vertical-align: middle; color: #fff; font-style: italic; font-size: 16px; line-height: 24px; margin: 0 14px; text-decoration: none;">Лаборатория</a>
                                    <a href="http://lsga.nineseven.ru/category/2" style="display: inline-block; vertical-align: middle; color: #fff; font-style: italic; font-size: 16px; line-height: 24px; margin: 0 14px; text-decoration: none;">Дино-датабаза</a>
                                    <a href="http://lsga.nineseven.ru/education" style="display: inline-block; vertical-align: middle; color: #fff; font-style: italic; font-size: 16px; line-height: 24px; margin: 0 14px; text-decoration: none;">школа</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding: 20px 0 10px;">
                                    <div style="border: 1px solid #e2dfde; text-align: left; word-break: break-word;">
                                        <div style="padding: 27px 40px 0;">
                                            <p style="color: #08121d; font-size: 24px; line-height: 22px; margin: 15px 0 25px; font-style: italic;">Здравствуйте, ' . $name . '!</p>
                                            <p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">Поздравляем Вас с успешной регистрацией на сайте LSGA.ru</p>
                                            <p style="color: #08121d; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">Ваши учетные данные:</p>
                                            <p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">
                                                Логин: ' . $login . '<br />
                                                Пароль: ' . $password . '
                                            </p>
                                            <p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">Пожалуйста, сохраните их, и не передавайте третьим лицам</p>
                                            <p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">———————————————</p>
                                            <p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">С уважением,<br /> Служба поддержки LSGA</p>
                                        </div>
                                        <div style="padding: 7px 10px; text-align: center; background: #e6e7e8; margin: 42px 0 38px;">
                                            <a href="#" style="display: inline-block; vertical-align: middle; color: #ff7f0a; font-size: 12px; line-height: 24px; margin: 0 20px; text-decoration: underline;">О нас</a>
                                            <a href="#" style="display: inline-block; vertical-align: middle; color: #ff7f0a; font-size: 12px; line-height: 24px; margin: 0 20px; text-decoration: underline;">Правила использования промо-кодов</a>
                                            <a href="#" style="display: inline-block; vertical-align: middle; color: #ff7f0a; font-size: 12px; line-height: 24px; margin: 0 20px; text-decoration: underline;">Публичная оферта</a>
                                        </div>
                                        <div style="padding: 0 40px 27px;">
                                            <table style="width: 100%; text-align: left; vertical-align: middle; margin: 5px 0;">
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle; width: 58px; height: 48px;"><img src="http://nineseven.ru/html/lsga-m/question.png" alt="" style="width: 48px; height: 48px;" /></td>
                                                    <td style="text-align: left; vertical-align: middle; font-size: 13px; line-height: 20px; color: #757d85;">Не отвечайте на это письмо! По всем вопросам Вы можете обратиться в Службу поддержки или написать на <a href="mailto:info@lsga.com" style="color: #ff7f0a; text-decoration: underline;">info@lsga.com</a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding: 1px 20px;">
                                    <p style="color: #9d9493; font-size: 12px; line-height: 20px; margin: 20px 0; text-align: left;">Ваши персональные данные надежно защищены. Подробнее о <a href="#" style="color: #7a9cdb; text-decoration: underline;">защите Ваших данных</a>.</p>
                                </td>
                            </tr>
                        </table>
                    </body>
                </html>';

        $headers = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: LSGA <" . $this->emailAdmin . ">\r\n";
        $mail = mail($to, $subject, $message, $headers);
        return $mail;
    }

    public function sendPasswordRecovery($password, $email) {
        $to = $email;
        $subject = "Восстановление пароля";
        $message = '
            <!DOCTYPE html>
                <html>
                    <head>
                        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
                        <style>
                            *{padding:0; margin:0;}
                        </style>
                    </head>
                    <body style="font-family: Arial, Helvetica, sans-serif;">
                        <table align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; border:none; font-family: Arial, Helvetica, sans-serif; width: 600px; color: #757d85; font-size: 15px; margin: 0 auto;">
                            <tr>
                                <td style="text-align: center; padding: 0;">
                                    <a href="#" style="display: block; border: none; margin: 0; padding: 0;"><img src="http://nineseven.ru/html/lsga-m/logo.jpg" alt="" style="width: 600px; height: 120px; display: block;" /></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding: 13px 0; text-transform: uppercase; background: #ff7f0a;">
                                    <a href="http://lsga.nineseven.ru/category/1" style="display: inline-block; vertical-align: middle; color: #fff; font-style: italic; font-size: 16px; line-height: 24px; margin: 0 14px; text-decoration: none;">Лаборатория</a>
                                    <a href="http://lsga.nineseven.ru/category/2" style="display: inline-block; vertical-align: middle; color: #fff; font-style: italic; font-size: 16px; line-height: 24px; margin: 0 14px; text-decoration: none;">Дино-датабаза</a>
                                    <a href="http://lsga.nineseven.ru/education" style="display: inline-block; vertical-align: middle; color: #fff; font-style: italic; font-size: 16px; line-height: 24px; margin: 0 14px; text-decoration: none;">школа</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding: 20px 0 10px;">
                                    <div style="border: 1px solid #e2dfde; text-align: left; word-break: break-word;">
                                        <div style="padding: 27px 40px 0;">
                                            <p style="color: #08121d; font-size: 24px; line-height: 22px; margin: 15px 0 25px; font-style: italic;">Здравствуйте!</p>
                                            <p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">Вы отправили запрос на восстановление пароля от почтового ящика ' . $email . '. </p>
                                            <p style="color: #08121d; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">Ваш новый пароль:</p>
                                            <p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">
                                                ' . $password . '
                                            </p><p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">Пожалуйста, проигнорируйте данное письмо, если оно попало к Вам по ошибке. </p>
                                            <p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">С уважением,<br /> Служба поддержки LSGA</p>
                                        </div>
                                        <div style="padding: 7px 10px; text-align: center; background: #e6e7e8; margin: 42px 0 38px;">
                                            <a href="#" style="display: inline-block; vertical-align: middle; color: #ff7f0a; font-size: 12px; line-height: 24px; margin: 0 20px; text-decoration: underline;">О нас</a>
                                            <a href="#" style="display: inline-block; vertical-align: middle; color: #ff7f0a; font-size: 12px; line-height: 24px; margin: 0 20px; text-decoration: underline;">Правила использования промо-кодов</a>
                                            <a href="#" style="display: inline-block; vertical-align: middle; color: #ff7f0a; font-size: 12px; line-height: 24px; margin: 0 20px; text-decoration: underline;">Публичная оферта</a>
                                        </div>
                                        <div style="padding: 0 40px 27px;">
                                            <table style="width: 100%; text-align: left; vertical-align: middle; margin: 5px 0;">
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle; width: 58px; height: 48px;"><img src="http://nineseven.ru/html/lsga-m/question.png" alt="" style="width: 48px; height: 48px;" /></td>
                                                    <td style="text-align: left; vertical-align: middle; font-size: 13px; line-height: 20px; color: #757d85;">Не отвечайте на это письмо! По всем вопросам Вы можете обратиться в Службу поддержки или написать на <a href="mailto:info@lsga.com" style="color: #ff7f0a; text-decoration: underline;">info@lsga.com</a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding: 1px 20px;">
                                    <p style="color: #9d9493; font-size: 12px; line-height: 20px; margin: 20px 0; text-align: left;">Ваши персональные данные надежно защищены. Подробнее о <a href="#" style="color: #7a9cdb; text-decoration: underline;">защите Ваших данных</a>.</p>
                                </td>
                            </tr>
                        </table>
                    </body>
                </html>
                ';

        $headers = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: LSGA <" . $this->emailAdmin . ">\r\n";

        $mail = mail($to, $subject, $message, $headers);
        return $mail;
    }

    public function sendNewPassword($password, $email) {
        $to = $email;
        $subject = "Изменение пароля";
        $message = '
            <!DOCTYPE html>
                <html>
                    <head>
                        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
                        <style>
                            *{padding:0; margin:0;}
                        </style>
                    </head>
                    <body style="font-family: Arial, Helvetica, sans-serif;">
                        <table align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; border:none; font-family: Arial, Helvetica, sans-serif; width: 600px; color: #757d85; font-size: 15px; margin: 0 auto;">
                            <tr>
                                <td style="text-align: center; padding: 0;">
                                    <a href="#" style="display: block; border: none; margin: 0; padding: 0;"><img src="http://nineseven.ru/html/lsga-m/logo.jpg" alt="" style="width: 600px; height: 120px; display: block;" /></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding: 13px 0; text-transform: uppercase; background: #ff7f0a;">
                                    <a href="http://lsga.nineseven.ru/category/1" style="display: inline-block; vertical-align: middle; color: #fff; font-style: italic; font-size: 16px; line-height: 24px; margin: 0 14px; text-decoration: none;">Лаборатория</a>
                                    <a href="http://lsga.nineseven.ru/category/2" style="display: inline-block; vertical-align: middle; color: #fff; font-style: italic; font-size: 16px; line-height: 24px; margin: 0 14px; text-decoration: none;">Дино-датабаза</a>
                                    <a href="http://lsga.nineseven.ru/education" style="display: inline-block; vertical-align: middle; color: #fff; font-style: italic; font-size: 16px; line-height: 24px; margin: 0 14px; text-decoration: none;">школа</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding: 20px 0 10px;">
                                    <div style="border: 1px solid #e2dfde; text-align: left; word-break: break-word;">
                                        <div style="padding: 27px 40px 0;">
                                            <p style="color: #08121d; font-size: 24px; line-height: 22px; margin: 15px 0 25px; font-style: italic;">Здравствуйте!</p>
                                            <p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">Вы изменили пароль в личном кабинете. </p>
                                            <p style="color: #08121d; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">Ваш новый пароль:</p>
                                            <p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">
                                                 ' . $password . '
                                            </p><p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">Пожалуйста, проигнорируйте данное письмо, если оно попало к Вам по ошибке. </p>
                                            <p style="color: #757d85; font-size: 15px; line-height: 22px; margin: 22px 0; font-style: italic;">С уважением,<br /> Служба поддержки LSGA</p>
                                        </div>
                                        <div style="padding: 7px 10px; text-align: center; background: #e6e7e8; margin: 42px 0 38px;">
                                            <a href="#" style="display: inline-block; vertical-align: middle; color: #ff7f0a; font-size: 12px; line-height: 24px; margin: 0 20px; text-decoration: underline;">О нас</a>
                                            <a href="#" style="display: inline-block; vertical-align: middle; color: #ff7f0a; font-size: 12px; line-height: 24px; margin: 0 20px; text-decoration: underline;">Правила использования промо-кодов</a>
                                            <a href="#" style="display: inline-block; vertical-align: middle; color: #ff7f0a; font-size: 12px; line-height: 24px; margin: 0 20px; text-decoration: underline;">Публичная оферта</a>
                                        </div>
                                        <div style="padding: 0 40px 27px;">
                                            <table style="width: 100%; text-align: left; vertical-align: middle; margin: 5px 0;">
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle; width: 58px; height: 48px;"><img src="http://nineseven.ru/html/lsga-m/question.png" alt="" style="width: 48px; height: 48px;" /></td>
                                                    <td style="text-align: left; vertical-align: middle; font-size: 13px; line-height: 20px; color: #757d85;">Не отвечайте на это письмо! По всем вопросам Вы можете обратиться в Службу поддержки или написать на <a href="mailto:info@lsga.com" style="color: #ff7f0a; text-decoration: underline;">info@lsga.com</a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding: 1px 20px;">
                                    <p style="color: #9d9493; font-size: 12px; line-height: 20px; margin: 20px 0; text-align: left;">Ваши персональные данные надежно защищены. Подробнее о <a href="#" style="color: #7a9cdb; text-decoration: underline;">защите Ваших данных</a>.</p>
                                    <p style="color: #9d9493; font-size: 12px; line-height: 20px; margin: 40px 0 25px; text-align: center;">Не отображается письмо? <a href="#" style="color: #ff7f0a; text-decoration: underline;">Смотрите онлайн версию</a></p>
                                </td>
                            </tr>
                        </table>
                    </body>
                </html> ';

        $headers = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: LSGA <" . $this->emailAdmin . ">\r\n";

        $mail = mail($to, $subject, $message, $headers);
        return $mail;
    }

}
