<?php
namespace app\admin\controller;

use app\admin\common\Base;


class Banner extends Base
{
    public function banner_list()
    {
       return $this -> fetch('banner/banner_list');
    }

  
  
}
