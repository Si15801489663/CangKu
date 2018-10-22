<?php
namespace app\admin\controller;
use app\admin\common\Base;

use think\Request;

use app\admin\model\Admin;
use think\Session;

class Login extends Base
{	
	//渲染登录页面
    public function index()
    {
        $this ->alreadyLogin();
        return $this ->fetch('login/login');
    }
	
	//验证用户身份
    public function check(Request $request)
    {
     // 设置status
        $status = 0;

        // 获取一下表单提交的数据，并保存在变量中
        $data = $request ->param();
        $userName = $data['username'];
        $password = md5($data['password']);
        // 在admin表中进行查询：以用户为条件
        $map =['username' => $userName];
        $admin = Admin::get($map);
        // 将用户名与密码分开验证
         
        // 如果没哟查询到该用户
        if (is_null($admin)) {
            // 设置返回信息
            $message = '用户名不准确';
        }elseif ($admin ->password !=$password) {
           // 设置一下密码不正确的提示信息
            $message = '密码不准确';
        }else{
            // 如果用户名和密码都通过了验证，表明是合法用户
            // 修改一下返回的信息
            // 第三次错误status写成statue
             $status = 1;
             $message = '验证通过，请点击确认进入后台';

             // 更新表中登录次数与最后登录时间
             $admin ->setInc('login_count');
               // 第五次错误time()写成tiem()
             $admin ->save(['last_time'=>time()]);

             // 将用户登录的信息保存在seesion中，供其他控制器进行登录判断
           
             Session::set('user_id',$userName);
             Session::set('user_info',$admin->toArray());
        }
           // 第四次错误status写成statue
        return ['status'=>$status,'message'=>$message];
    }
	
	//退出登录
    public function logout()
    {
     // 删除当前用户的值
       Session::delete('user_id');
       Session::delete('user_info');

       // 执行成功返回登录页面
       $this ->success('注销成功','login/index');
    }
    
  
}
