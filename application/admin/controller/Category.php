<?php
namespace app\admin\controller;

use app\admin\common\Base;

class Category extends Base
{
    public function category_list()
    {
       return $this -> fetch('category/category_list');
    }

  
  
}
