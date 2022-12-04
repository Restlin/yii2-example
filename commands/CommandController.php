<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\User;
use app\models\Dep;
use Yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CommandController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }
    /**
     * Создание пользователя
     * @param string $email
     * @param string $password
     * @return int
     */
    public function actionCreateUser($email, $password) {
        $user = new User();
        $user->name = 'Админ';
        $user->email = $email;
        $user->password_hash = Yii::$app->security->generatePasswordHash($password);
        $user->is_admin = true;
        $dep = Dep::findOne(['name' => 'IT']);
        $user->dep_id = $dep->id;
        if($user->save()) {
            echo "Пользователь создан\n";
            return ExitCode::OK;
        } else {
            var_dump($user->errors);
            echo "Пользователь не создан\n";
            return 1;
        }
    }
}
