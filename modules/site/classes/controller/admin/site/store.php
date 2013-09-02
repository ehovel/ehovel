<?php defined('SYSPATH') OR die('No direct script access allowed.');
// $Id$
/**
 * 后台库存管理
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Product
 * @category Controller
 * @since 2012-04-23
 * @author dong.xiaoyu
 * @version   $Id$
 */
class Controller_Admin_Site_Store extends Controller_Admin_Base {
	
	public function action_index() {
		try {
			$store_addresses = EHOVEL::model('Site_Store')->find_all();
//			 if(!$store_addresses->loaded())
//			 {
//			 	Remind::factory( Remind::TYPE_ERROR )
//			 		->message( __ ('Loading failed, try again' ) )
//			 		->redirect( EHOVEL::url('site_store') )
//			 		->send();
//			 }

			$this->template = EHOVEL::view('site/store/index',array('store_addresses'=>$store_addresses));
		} catch (Kohana_Exception $ex) {
			Remind::factory($ex)
                ->send();
		}
	}
	
	public function action_add() {
		try {
			if($_POST) {
				$store_addresses = EHOVEL::model('Site_Store');
				$store_addresses->name = $this->request->post('store_name');
				$store_addresses->is_default = $this->request->post('is_default');;
				$store_addresses->active = $this->request->post('is_active');
				$store_addresses->store_warning = $this->request->post('store_warning');

				//如果当前无默认库存地址 将第一个地址设置为默认
				$count_store_addresses = count(EHOVEL::model('Site_Store')->where('is_default','=','Y')->find_all());
				if($count_store_addresses <= 0 )
				{
					$store_addresses->is_default = 'Y';
				}
				else
				{
					if($store_addresses->is_default == 'Y')
					{
						$current_default_address = EHOVEL::model('Site_Store')->where('is_default','=','Y')->find();
						if($current_default_address -> loaded())
						{
							$current_default_address->is_default='N';
							$current_default_address->save();
						}
					}
				}

				if (empty ( $store_addresses->name ) || EHOVEL::model ( 'Site_Store' )->name_exist ( $store_addresses->name )) 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( __ ('Name cannot be repeated.' ) )
                            ->redirect ( EHOVEL::url ( 'site_store/index' ) )
                            ->send ();
                }
                
				$store_addresses->save();
				Remind::factory( Remind::TYPE_SUCCESS)
					->message( __( 'Added Successfully!') )
					->redirect( EHOVEL::url('site_store') )
					->send();				
			}
			
			$this->template = EHOVEL::view('site/store/add');
			
		} catch (Kohana_Exception $ex) {
			Remind::factory($ex)
                ->send();
		}
	}
	
	public function action_edit() {
		try {
			$id = intval($this->request->query('id'));
			$store_addresses = EHOVEL::model('Site_Store',$id);
			
			if($_POST) {
				$store_addresses->name = $this->request->post('store_name');
				$store_addresses->is_default = $this->request->post('is_default');
				$store_addresses->active = $this->request->post('is_active');
				$store_addresses->store_warning = $this->request->post('store_warning');

				//如果当前无库存地址 将第一个地址设置为默认
				$count_store_addresses = count(EHOVEL::model('Site_Store')->find_all());
				if($count_store_addresses <= 0 )
				{
					$store_addresses->is_default = 'Y';
				}
				else
				{
					if($store_addresses->is_default == 'Y')
					{
						$current_default_address = EHOVEL::model('Site_Store')->where('is_default','=','Y')->where ( 'id', '<>', $store_addresses->id )->find();
						if($current_default_address -> loaded())
						{
							$current_default_address->is_default='N';
							$current_default_address->save();
						}
					}
					else 
                    {
                        $current_default_currency_count = EHOVEL::model ('Site_Store')->where ( 'is_default', '=', 'Y' )->where ( 'id', '<>', $store_addresses->id )->count_all ();
                        if ($current_default_currency_count <= 0) 
                        {
                            Remind::factory ( Remind::TYPE_ERROR )
                                    ->message ( __ ('Keep one for the default store address.' ) )
                                    ->redirect ( EHOVEL::url ( 'site_store/edit',array('id' => $id) ) )
                                    ->send ();
                        }
                    }
				}

				if (empty ( $store_addresses->name ) || EHOVEL::model ( 'Site_Store' )->name_exist ( $store_addresses->name , $id)) 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( __ ('Name cannot be repeated.' ) )
                            ->redirect ( EHOVEL::url ( 'site_store/index' ) )
                            ->send ();
                }
                
				$store_addresses->save();
				Remind::factory( Remind::TYPE_SUCCESS )
					->message( __('Edited Successfully!') )
					->redirect( EHOVEL::url('site_store') )
					->send();			
			}
			
			$this->template = EHOVEL::view('site/store/edit',array('store_addresses'=>$store_addresses));
		} catch (Kohana_Exception $ex) {
			Remind::factory($ex)
                ->send();
		}
	}
	
	public function action_delete() {
		try {
			$id = $this->request->query('id');
			$store_addresses = EHOVEL::model('Site_Store',$id);
		
			$store_addresses->date_upd = DATE::get();
			$store_addresses->save();
			$store_addresses->disable();

			Remind::factory ( Remind::TYPE_SUCCESS )
				->message(__('Delete Successfully!'))
				->redirect( EHOVEL::url('site_store') )
				->send();
		}
		catch (Kohana_Exception $ex) {
			Remind::factory($ex)
                ->send();
		}
	}
}