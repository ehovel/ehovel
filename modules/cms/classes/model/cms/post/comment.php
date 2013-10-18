<?php defined('SYSPATH') or die('No Direct Script Access.');
// $Id$
/**
 * Cms基础模型
 *
 * @package Cms
 * @category Model
 * @author zhubin
 * @version $Id$
 * @copyright Ketai
 * @since 2012-03-19
 */
class Model_Cms_Post_Comment extends ORM_Site_Column {

	protected $_disabled_column = "disabled";
    
    protected $_belongs_to = array(
        'post' => array(
            'model' => 'Cms_Post',
            'foreign_key'=>'post_id',
        ),
    );
}
