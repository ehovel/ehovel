<?php defined('SYSPATH') OR die('No direct script access.');

class ORM extends Kohana_ORM {
	
	/**
	 * 允许检索全部记录
	 */
	const ALLOW_ALL      = 0;
	/**
	 * 仅允许检索可用记录
	 */
	const ALLOW_ENABLED  = 1;
	/**
	 * 仅允许检索禁用记录
	 */
	const ALLOW_DISABLED = 2;
	
	/**
	 * 反序列化时，不重载对象
	 *
	 * @var bool
	 */
	protected $_reload_on_wakeup = FALSE;
	
	/**
	 * 软删除字段名称，当设置为NULL时禁用软删除功能
	 *
	 * @var string
	 */
	protected $_disabled_column = NULL;
	/**
	 * 更新时间字段配置，当无更新时间字段时，将此项设置为NULL
	 *
	 * @var array
	 */
	protected $_updated_column = array(
			'column' => 'modified',
			'format' => 'Y-m-d H:i:s',
	);
	/**
	 * 添加时间字段配置，当无添加时间字段时，将此项设置为NULL
	 *
	 * @var array
	 */
	protected $_created_column = array(
			'column' => 'date_add',
			'format' => 'Y-m-d H:i:s',
	);
	
	/**
	 * 指示 allow 函数是否已运行
	 *
	 * @var bool
	 */
	protected $_has_allowed = FALSE;
	
	/**
	 * Creates and returns a new model.
	 *
	 * @chainable
	 * @param   string  $model  Model name
	 * @param   mixed   $id     Parameter for find()
	 * @return  ORM
	 */
	public static function factory($model, $id = NULL)
	{
		// Set class name
		$model = 'Model_'.ucfirst($model);
	
		return new $model($id);
	}
	
	/**
	 * 设置查找模式
	 *
	 * @param int $mode
	 */
	public function allow($mode)
	{
		if (!empty($this->_disabled_column) AND $this->_has_allowed === FALSE) {
			switch ($mode) {
				case ORM::ALLOW_ALL:
					break;
				case ORM::ALLOW_ENABLED:
					$this->where($this->_disabled_column, '=', '0');
					break;
				case ORM::ALLOW_DISABLED:
					$this->where($this->_disabled_column, '=', '1');
					break;
				default:
			}
			$this->_has_allowed = TRUE;
		}
		return $this;
	}
	
	/**
	 * 软删除
	 *
	 * @return object
	 */
	public function disable()
	{
		if (empty($this->_disabled_column)) {
			throw new Kohana_Exception(__('未开启软删除功能'));
		}
	
		Event::run($this->_object_name . '.disable_before', $this);
	
		$this->_changed[] = $this->_disabled_column;
		$this->_object[$this->_disabled_column] = 1;
	
		$result = $this->save();
	
		Event::run($this->_object_name . '.disable_after', $this);
	
		return $this->saved();
	}
	
	/**
	 * 恢复软删除
	 *
	 * @param bool $auto_save 是否自动保存
	 * @return array
	 */
	public function enable($auto_save = TRUE)
	{
		if (!empty($this->_disabled_column)) {
			$this->__set($this->_disabled_column, 0);
		}
		if ($auto_save) {
			return $this->save();
		}
	}
	
	/**
	 * 重写 find
	 *
	 * @return object
	 */
	public function find()
	{
		$this->prematch();
		$this->allow(ORM::ALLOW_ENABLED);
		return parent::find();
	}
	
	/**
	 * 重写 find_all
	 *
	 * @return object
	 */
	public function find_all()
	{
		$this->prematch();
		$this->allow(ORM::ALLOW_ENABLED);
		return parent::find_all();
	}
	
	/**
	 * 重写 count_all
	 *
	 * @return object
	 */
	public function count_all()
	{
		$this->prematch();
		$this->allow(ORM::ALLOW_ENABLED);
		return parent::count_all();
	}
	
	/**
	 * 重写 as_array，新增 $related 参数，允许额外指定所要处理的列
	 *
	 * @param array $related
	 * @return array
	 */
	public function as_array(array $related = array())
	{
		$object = parent::as_array();
		foreach ($related as $column) {
			if (!isset($object[$column])) {
				if ($column === 'attributes') {
					$object[$column] = $this->type_model->attributes;
				} else {
					$object[$column] = $this->__get($column);
					if ($object[$column] instanceof ORM) {
						$object[$column] = $object[$column]->as_array();
					}
				}
			}
		}
		return $object;
	}
	
	/**
	 * 重写 __get
	 *
	 * @param string $column
	 * @return mixed
	 */
	public function __get($column)
	{
		if (method_exists($this, $method = '_get_handler_' . $column)) {
			return $this->$method();
		} else {
			return parent::__get($column);
		}
	}
	
	/**
	 * 重写 __set
	 *
	 * @param string $column
	 * @param mixed $value
	 */
	public function __set($column, $value)
	{
		if ( ! isset($this->_object_name)) {
			$this->_cast_data[$column] = $value;
		} elseif (method_exists($this, $method = '_set_handler_' . $column)) {
			$this->$method($value);
		} else {
			parent::__set($column, $value);
		}
	}
	
	/**
	 * @author Bruno Xu
	 *
	 * 检索(find,find_all,count_all)之前加入一些筛选条件
	 */
	protected function prematch()
	{
	
	}
	
	/**
	 * @author Bruno Xu
	 *
	 * add before_save before save
	 * add after_save after save
	 */
	public function save(Validation $validation = NULL)
	{
		$this->before_save();
		parent::save($validation);
		$this->after_save();
	}
	
	/**
	 * ORM模型保存前预留接口, 可通过继承扩展
	 * @access public
	 * @return void
	 * @author fanchongyuan
	 * @example
	 */
	protected function before_save()
	{
	
	}
	
	/**
	 * ORM模型保存后预留接口, 可通过继承扩展
	 * @access public
	 * @return void
	 * @author fanchongyuan
	 * @example
	 */
	protected function after_save()
	{
	
	}
	
}
