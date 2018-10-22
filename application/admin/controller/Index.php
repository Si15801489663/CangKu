<?php
namespace app\admin\controller;

use app\admin\common\Base;

class Index extends Base
{
    public function index()
    {
    	$this ->isLogin();
       return $this -> fetch('index/index');
    }

    public function welcome(){
    	 return $this -> fetch('index/welcome');
    }
  
}
