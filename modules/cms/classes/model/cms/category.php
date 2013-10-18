<?php defined('SYSPATH') or die('No Direct Script Access.');
// $Id$
/**
 * 内容发布模型分类模型
 *
 * @package Cms
 * @category Model
 * @author zhubin
 * @version $Id$
 * @copyright Ketai, 2011
 * @since 2011-12-07
 */
class Model_Cms_Category extends ORM_MPTT{
    /**
     * BELONGS TO关联
     * 
     * @var array
     */
    protected $_belongs_to = array(
        'model' => array(
            'model' => 'Cms_Model',
            'foreign_key'=>'model_id',
        ),
    );
    /**
     * 左值字段名称
     *
     * @var string
     */
    public $left_column = 'lft';
    
    /**
     * 右值字段名称
     *
     * @var string
     */
    public $right_column = 'rgt';

    /**
     * 层级字段名称
     *
     * @var string
     */
    public $level_column = 'level';

    /**
     * 域字段名称
     *
     * @var null
     */
    public $scope_column = 'scope';

    /**
     * 父分类ID字段名称
     *
     * @var string
     */
    public $pid_column = 'pid';

    /**
     * 取得该分类下内容的个数
     * @return int
     */
    public function count_content()
    {
        if($this->loaded()){
            $model = $this->model->get_model();
            $count_all = $model instanceof ORM ? $model->where('category_id', '=', $this->id)->count_all() : 0;
            return $count_all;
        }else{
            return -1;
        }
    }
}

