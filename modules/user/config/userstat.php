<?php
defined('SYSPATH') or die('No Direct Access');
return array(
/* 订单显示状态 */
    'order_status' => array(
        'PENDING' =>__('Order Pending'),
        'PROCESSING' =>__('Order Processing'),
        'COMPLETED' =>__('Order Completed'),
        'UNPAID' =>__('Order Unpaid'),
        'PAID' =>__('Order Paid'),
        'REFUNDED' =>__('Order Refunded'),
        'CB' =>__('Order Chargeback'),
        'SHIPPED' =>__('Order Shipped'),
        'CANCELLED' =>__('Order Cancelled'),
        'RETURNED' =>__('Order Returned'),
        'RECEIVED' =>__('Order Received'),
        //'CONFIRMED' =>__('Confirmed'),
        'REFUNDING'=>__('Order Refunding'),
    ),
    
    /* 订单支付状态 */
    'pay_status' => array(
        'UNPAID' =>__('Unpaid'),
        'PENDING' =>__('Pending'),
        'PAID' => __('Paid'),
        'REFUNDPENDING' => __('Refund Pending'),
        'PARTLYREFUNDED' => __('Partly Refunded'),
        'REFUNDED' => __('Refunded'),
        'CB' => __('Chargeback'),
    ),
    
    /* 订单物流状态 */
    'ship_status' => array(
        'UNSHIPPED' => __('Unshipped'),
        'DISTRIBUTING' =>__('Distributing'),
        'PARTLYSHIPPED' =>__('Partly Shipped'),
        'SHIPPED' =>__('Shipped'),
        'PARTLYRETURNED' =>__('Partly Returned'),
        'RETURNED' =>__('Returned'),
        'DELIVERED' =>__('Delivered'),
    ),
    
);
    
?>