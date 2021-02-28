
<?php
$locale= \Request::input('locale');
\App::setLocale($locale); 



return [



    /*

    |--------------------------------------------------------------------------

    | Authentication Language Lines

    |--------------------------------------------------------------------------

    |

    | The following language lines are used during authentication for various

    | messages that we need to display to the user. You are free to modify

    | these language lines according to your application's requirements.

    |

    */

	'Login' => 'Авторизация ',
	'Privacy &amp; Policy' => 'Приватность и политика',
	'I accept the' => 'Я принимаю ',
	'Loginbutton' => 'Войти',
	'Register' => 'Регистрация',
	'Username/Email' => 'Имя пользователя/Email',
	'Password' => 'Пароль',
	'Forgot Your Password?' => 'Забыли пароль?',
	'Registerbutton' => 'Зарегистрироваться ',
	'If you still dont have a palto.ru account, use this option to access the registration form. By giving us your details, purchasing in palto.ru will be faster and an enjoyable experience.' => 'Если у вас все еще нет учетной записи palto.ru, воспользуйтесь этой опцией для доступа к форме регистрации. Предоставив нам свои данные, покупка на palto.ru станет более быстрой и приятной.',
	'Reset Password' => 'Сброс пароля.',
	'Name' => 'Имя',
	'Try again' => 'Попробуйте ещё раз ',
	'account and try to connect to Paltoru again.' => ', и попробуйте снова подключиться к Paltoru.',
	'your e-mail information. Please update the e-mail information you used on your ' => 'свой адрес электронной почты. Обновите данные электронной почты, которые вы использовали в своей учетной записи',
	'account, you must have given' => ', вы должны указать',
	'To connect to Paltoru with your' => 'Чтобы подключиться к Paltoru со своей учетной записью',
	'An error has occurred in your transaction!' => 'Произошла ошибка в вашей транзакции!',
	'Surname' => 'Фамилия',
	'Or you can login with:' => 'Или вы можете войти с помощью:',
	'Hello!' => 'Здравствуйте!',
	'Save' => 'Сохранить',
	'Confirm New Password' => 'Подтвердите новый пароль ',
	'New Password (leave blank to leave unchanged)' => 'Новый пароль  (оставьте поле пустым, чтобы оставить его без изменений) ',
	'Current Password(leave blank to leave unchanged)' => 'Текущий пароль (оставьте поле пустым, чтобы оставить его без изменений) ',
	'E-Mail Address' => 'E-mail адрес',
	'Confirm Password' => 'Подтвердить пароль',
	'Name' => 'Имя ',
	'Sign in to your account.' => 'Войдите в свою учетную запись.',
	'Already registered?' => 'Уже зарегистрированы?',
	'click here to request another' => 'Нажмите сюда для запроса нового',
	'If you did not receive the email' => 'Если вы не получили письмо на почту',
	'Before proceeding, please check your email for a verification link.' => 'Прежде чем продолжить, пожалуйста, проверьте свою электронную почту на наличие проверочной ссылки.',
	'A fresh verification link has been sent to your email address.' => 'На ваш электронный адрес была отправлена новая проверочная ссылка',
	'Verify Your Email Address' => 'Проверьте адрес вашей электронной почты',
	'Send' => 'Отправить',
	'Enter the e-mail to which the account was registered.' => 'Укажите e-mail, на который была зарегистрирована учетная запись.',

	

	



    'failed' => 'Эти учетные данные не соответствуют нашим записям.',

    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',



];

