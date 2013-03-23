<?php defined('SYSPATH') or die('No Direct Script Access.');
// $Id$
/**
 * 单记录抽象模型
 * 一般用于表现单条记录
 */
abstract class Model_Eitem {

    /**
	 * An item.
	 *
	 * @var    array
	 */
	protected $_item = null;

	/**
	 * Model context string.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $_context = 'group.type';

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   12.2
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		return md5($id);
	}
}

