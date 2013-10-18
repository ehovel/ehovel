<?php defined('SYSPATH') or die('No Direct Script Access.');
// $Id$
/**
 * 内容发布模型管理模型类
 *
 * @package Cms
 * @category Model
 * @author Bruno Xu
 * @version $Id$
 * @copyright Ketai, 2011
 * @since 2011-12-07
 */
class Model_Cms_Model extends ORM {

	protected $_disabled_column = "disabled";
    const INDIVIDUAL_DATA = 'individual_data';
    /**
     * HAS MANY关联
     * 
     * @var array
     */
    protected $_has_many = array(
        'categories' => array(
            'model' => 'Cms_Category',
            'foreign_key' => 'model_id',
        ),
    );

    /**
     * 取得模型
     * 
     * @param int $model_id 模型id
     * 
     * @return ORM
     */
    public function get_model($model_id=0)
    {
    	$use_model_obj = null;
        if ($model_id > 0) {
            $cms_model = EHOVEL::Model('Cms_Model', $model_id);
            if ($cms_model->loaded()) {
            	$use_model_obj = $cms_model;
            }
        } else if($this->loaded()) {
        	$use_model_obj = $this;
        }
        if (empty($use_model_obj)) {
        	return null;
        }
        return $this->get_model_by_model_obj($use_model_obj);
    }

    /**
     * 根据表名和模型名取得模型
     * 
     * @param Model_Cms_Model $use_model_obj
     * 
     * @return ORM
     */
    public function get_model_by_model_obj($use_model_obj)
    {
		$model_id = $use_model_obj->id;
		$model_table_name  = $use_model_obj->model_table_name;
		$model_main_name = $use_model_obj->model_main_name;

    	$model_name = 'Model_'.$model_main_name;
    	if (! class_exists($model_name)) {
			$child_class_str = '
			class Model_%s extends Model_Cms_Postext {
				protected $_table_name = "%s";
			}
			';
			$child_class_str = sprintf($child_class_str, $model_main_name, $model_table_name);
			eval($child_class_str);
    	}
    	
    	$model_main_name_arr = explode('_', $model_main_name);
    	$mid_model_main_name = "Cms_Post".strtolower($model_main_name_arr[count($model_main_name_arr)-1]);
    	$mid_model_name = "Model_".$mid_model_main_name;
        if (! class_exists($mid_model_name)) {
			$mid_class_str = '
			class %s extends Model_Cms_Post {
			
				protected $model_id = %d;
			
				protected $_has_one = array(
					"'.self::INDIVIDUAL_DATA.'" => array(
			            "model" => "%s",
			            "foreign_key" => "parent_id",
					),
				);
			
				protected $_load_with = array("'.self::INDIVIDUAL_DATA.'");
			}
			';
            $mid_class_str = sprintf($mid_class_str, $mid_model_name, $model_id, $model_main_name);
            eval($mid_class_str);
        }

        return EHOVEL::model($mid_model_main_name);
    }

    /**
     * 取得内容列表
     * @return Database_MySQL_Result 
     */
    public function get_posts($model_id=0)
    {
        return $this->get_model($model_id)->find_all();
    }
}
