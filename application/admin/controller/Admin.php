<?php
namespace app\admin\controller;
use app\admin\common\Base;
use think\Request;
use app\admin\model\Admin as AdminModel;

class Admin extends Base
{
    public function index()
    {
        
//        读取admin管理员表的信息
        $admin=  AdminModel::get(['username'=>'admin']);
//        将当前管理员的信息赋值给模板
        $this-> view ->assign('admin',$admin);
//        渲染模板
       return $this -> fetch('admin/admin_list');
    }
    
     //渲染编辑模板
    public function edit(Request $request)
    {

        //1.读取admin管理员表的信息
        $admin = AdminModel::get($request->param('id'));

        //2.将当前管理员的信息赋值给模板
        $this -> view -> assign('admin', $admin);
        //3.渲染模板
        return $this -> view -> fetch('admin_edit');
    }

    //       //执行更新操作
    public function update(Request $request)
    {
           echo '11111';
         //判断是不是Ajax提交
        if ($request -> isAjax(true)){
            //获取提交的数据,自动过滤一下空值
         
            $data = array_filter($request->param());
            //设置更新条件
            $map = ['is_update' => $data['is_update']];
            //更新用户表
            $res = AdminModel::update($data, $map);
            
            var_dump($res);
            //更新成功的提示信息
            $status = 1;
            $message = '更新成功';
             //如果更新失败
            if (is_null($res)) {
                $status = 0;
                $message = '更新失败';
            }
             return ['status'=>$status, 'message'=>'$message'];
        }
    }

  
}
