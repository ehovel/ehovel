<?php defined('SYSPATH') or die('No direct access script');
// $Id$
/**
 * 与用户有关的Helper类
 * @package User
 * @category Helper
 * @author zhubin
 * @since 2012-03-08
 * @copyright Copyright(c) 2012, Ketai inc
 * @version $Id
 */

class Helper_Event_User{
    static public function create_after(Model_User $user)
	{
        //用户付款给用户发放优惠券
        BES::model('Sale_CouponGenerateNodeRule')->dispense_coupons('register', $user->id);
	}
}
