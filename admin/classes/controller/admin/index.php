<?php

defined ( 'SYSPATH' ) or die ( 'No direct script access.' );
/**
 * 控制器基类
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package BES
 * @since 2011-12-26
 * @author dongxiaoyu
 * @version   $Id$
 */
class Controller_Admin_Index extends Controller_Admin_Base {
	public $auto_render = true;
	/**
	 * 后台首页面
	 * @return void
	 */
	public function action_index() {
		Message::set(Message::SUCCESS, __('test测试提示信息'));
// 		Message::set(Message::ERROR, __('test测试提示信息'));
// 		Message::set(Message::INFO, __('test测试提示信息'));
// 		Message::set(Message::NOTICE, __('test测试提示信息'));
		$toolBarhelper = Helper_Toolbar::getInstance();
		$toolBarhelper->appendButton('new','新建','content.add');
		$toolBarhelper->appendButton('edit','编辑','content.edit');
		$toolBarhelper->appendButton('publish','发布','content.publish');
		$toolBarhelper->appendButton('unpublish','取消发布','content.unpublish');
		$toolBarhelper->appendButton('featured','推荐','content.featured');
		$toolBarhelper->appendButton('archive','存档','content.archive');
		$toolBarhelper->appendButton('checkin','确认','content.checkin');
		$toolBarhelper->appendButton('trash','回收站','content.trash');
		$toolBarhelper->appendButton('checkbox-partial','批量处理','content.cancel');
		$toolBarhelper->appendButton('options','选项','content.cancel');
		$toolBarhelper->appendButton('question-sign','帮助','content.cancel');
		$this->toolBar =  $toolBarhelper->render();
		
		$this->template = View::factory('index');
	}

}
