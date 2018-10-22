<?php
namespace app\admin\controller;

use app\admin\common\Base;

class System extends Base
{
    public function system_list()
    {
       return $this -> fetch('system/system_list');
    }

    
  
}
