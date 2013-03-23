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
class Model_Category extends ORM_MPTT{
    
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
    public $pid_column = 'parent_id';

    
}

