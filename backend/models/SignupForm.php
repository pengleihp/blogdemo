<?php
namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $nickname;
    public $email;
    public $password;
    public $password_repeat;
    public $profile; 


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '该用户名已被占用'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '该邮箱已被占用'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_repeat','compare','compareAttribute'=>'password','message'=>'两次输入的密码不一致！'],
        		
        	['nickname','required'],
        	['nickname','string','max'=>128],
        		
        	['profile','string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'nickname' => '昵称',
            'password' => '密码',
            'password_repeat' => '重新输入密码',
            'email' => '邮箱',
            'profile' => '简介', 
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new AdminUser();
        $user->username = $this->username;
        $user->nickname=$this->nickname;
        $user->email = $this->email;
        $user->profile=$this->profile;
        $user->setPassword($this->password);
        $user->password='_';
        $user->generateAuthKey();
        // $user->save() ; VarDumper::dump($user->errors);exit;
        return $user->save() ? $user : null;
    }
}
