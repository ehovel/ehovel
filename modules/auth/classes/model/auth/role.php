<?php defined('SYSPATH') or die('No Direct Script Access.');
// $Id$
/**
 * 角色模型类
 *
 * @package Auth
 * @category Model
 * @author zhubin
 * @version $Id$
 * @copyright Ketai, 2011
 * @since 2011-11-22
 */
class Model_Auth_Role extends ORM {
	public $_table_name = 'auth_adminroles';
    /**
     * has many关系
     */
    protected $_has_many = array(
        'admins' => array(
            'model' => 'Auth_Admin',
            'foreign_key' => 'admin_id'
        ),
    );
    
    /**
     * 是否存在该名字
     * @param string $name_exist
     * @param int $owner_id
     * @return boolean
     */
    public function name_exist($name, $owner_id = 1)
    {
        if($this->loaded())
        {
            return $this->where('id', '!=', $this->id)->where('owner_id','=',$this->owner_id)->where('name', '=', $name)->count_all()>0;
        } else {
            return $this->where('owner_id','=',$owner_id)->where('name', '=', $name)->count_all()>0;
        }
    }
    /**
     * 根据角色获取合并后的权限
     *
     * @param array $roles
     * @return array
     */
    public function get_merge_nodes($roles = array())
    {
        $ctls = array();
        if (is_array($roles)) {
            if (count($roles) > 0) {
                foreach ($roles as $key => $item) {
                    //可以是ID序列，也可以是对象的序列
                    if (!($item instanceof ORM)) {
                        if (is_int($item)) {
                            $tmp_role = BES::model($this->_object_name, $item);
                        }
                    } else {
                        $tmp_role = $item;
                    }

                    if ($tmp_role->loaded()) {
                        if ($tmp_role->node_type == 'all') {
                            $nodes = BES::model('Auth_Node')->find_all();
                        } else {
                            $nodes = $tmp_role->node->find_all();
                        }
                        if ($nodes) {
                            foreach ($nodes as $node_key => $node_item) {
                                if (!empty($node_item->resource)) {
                                    $node_res = explode('|', $node_item->resource);
                                    if ($node_res) {
                                        foreach ($node_res as $res_key => $res_item) {
                                            $acts = explode('.', $res_item);
                                            if (isset($acts[0])) {
                                                if (isset($acts[1])) {
                                                    //已经有*代表所有权限
                                                    if ((isset($ctls[$acts[0]]) && $ctls[$acts[0]] == '*')
                                                        || $acts[1] == '*'
                                                    ) {
                                                        $ctls[$acts[0]] = '*';
                                                    } else {
                                                        $ctls[$acts[0]][] = $acts[1];
                                                    }
                                                } else {
                                                    $ctls[$acts[0]] = '*';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        break;
                    } else {
                        continue;
                    }
                }
            }
        }
        return $ctls;
    }
}
