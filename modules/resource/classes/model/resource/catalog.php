<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Resource_catalog extends ORM {
    
    
    protected $_has_many = array(
            'resouce' => array(
                    'model' => 'resource',
            )
    );
    
    /**
     * 获取树结构
     */
    public function tree($arr, $myid = 0) {
        $newarr = array();
        $tmparr = array();
        if(!empty($arr)) {
            foreach($arr as $val) {
                if($val->parent_id == $myid) {
                    $tmparr[$val->id] = $val;
                }
            }
        }
        if (!empty($tmparr) && is_array($tmparr)) {
            foreach($tmparr as $val) {
                $newarr[] = $val;
                $tmparr1 = self::tree($arr, $val->id);
                if(!empty($tmparr1)){
                    $newarr = array_merge($newarr, $tmparr1);
                }
            }
        }
        return $newarr;
    }
}
?>
