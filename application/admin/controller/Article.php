<?php
namespace app\admin\controller;

use app\admin\common\Base;

class Article extends Base
{
    public function article_list()
    {
       return $this -> fetch('article/article_list');
    }

  
  
}
