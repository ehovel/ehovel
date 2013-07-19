<?php defined('SYSPATH') OR die('No direct script access.');

class HTML extends Kohana_HTML {

	/**
     * tinymce全局使用方法
     * 
     * @static
     * @return void
     */
    public static function tinymce()
    {
        echo BES::js('tiny_mce/tiny_mce#tiny_mce/init');
    }

    /**
     * 添加toolbar图标链接
     *
     *     echo HTML::toolbar_anchor('/user/profile');
     *
     * @static
     * @param string $uri 链接
     * @param string $title 链接文字
     * @param string $class 样式(可选add|export|delete|list)
     * @param array $attributes a标签属性
     * @return string
     */
    public static function toolbar_anchor($uri, $title = NULL, $class = 'list', $attributes = array())
    {
        if (isset($attributes['class'])) {
            $attributes['class'] = $attributes['class'] . ' ' . $class;
        } else {
            $attributes['class'] = $class;
        }
        return HTML::anchor($uri, $title, $attributes);
    }

    /**
     * 添加icon图标链接
     *
     *     echo HTML::icon_anchor('/user/profile');
     *
     * @static
     * @param string $uri 链接
     * @param string $title 链接文字
     * @param string $icon 图标(可在statics\images\icons\splashyIcons中取文件名)
     * @param array $attributes a标签属性
     * @return string
     */
    public static function icon_anchor($uri, $title = NULL, $icon = '', $attributes = array())
    {
        if (!empty($title)) {
            $title = '<span>' . $title . '</span>';
        }
        if (empty($icon)) {
            $icon = 'edit.png';
        }
        return HTML::anchor($uri, '<img src="' . STATICS_BASE_URL . 'images/icons/' . $icon . '" alt=""><span>' . $title . '</span>', $attributes);
    }

    /**
     * 添加链接
     *
     *     echo HTML::add_anchor('/user/profile');
     *
     * @static
     * @param  $uri
     * @param null $title
     * @param array $attributes
     * @return string
     */
    public static function add_anchor($uri, $title = NULL, $attributes = array())
    {
        if (empty($title)) {
            $title = __('Add New');
        }
        if (isset($attributes['class'])) {
            $attributes['class'] = $attributes['class'] . ' add';
        } else {
            $attributes['class'] = 'add';
        }
        return HTML::anchor($uri, $title, $attributes);
    }

    /**
     * 删除链接
     *
     *     echo HTML::delete_anchor('/user/profile');
     *
     * @static
     * @param  $uri
     * @param null $title
     * @param array $attributes
     * @return string
     */
    public static function delete_anchor($uri, $title = NULL, $attributes = array())
    {
        if (!empty($title)) {
            $title = '<span>' . $title . '</span>';
        }
        if (!isset($attributes['title']))
            $attributes['title'] = __('Delete');
        //if (!isset($attributes['onclick']))
        //    $attributes['onclick'] = 'return confirm("' . __('Sure to Delete?') . '");';
        if (!isset($attributes['class'])) {
            $attributes['class'] = 'delete';
        }
        return HTML::anchor($uri, '<i class="icon-trash"></i>' . $title, $attributes);
    }

    /**
     * 编辑链接
     *
     *     echo HTML::edit_anchor('/user/profile');
     *
     * @static
     * @param  $uri
     * @param null $title
     * @param array $attributes
     * @return string
     */
    public static function edit_anchor($uri, $title = NULL, $attributes = array())
    {
        if (!empty($title)) {
            $title = '<span>' . $title . '</span>';
        }
        if (!isset($attributes['title']))
            $attributes['title'] = __('Edit');
        return HTML::anchor($uri, '<i class="icon-edit"></i>' . $title, $attributes);
    }

    /**
     * 根据提供的Y OR N显示不同的图片
     *
     * @param string $active
     * @param bool $stat 默认
     * @param string $class 类名
     * @return String
     */
    public static function get_active_icon($active = 'Y', $stat = true, $class = 'active_img')
    {
        $str = "";
        $active_condition = ($stat == true) ? 'Y' : 'N';

        if ($active == $active_condition) {
            $str = "<img src='" . STATICS_BASE_URL . "images/icons/tick.png' alt='Active' class='" . $class . "'/>";
        } else {
            $str = "<img src='" . STATICS_BASE_URL . "images/icons/cross.png' alt='Invalid' class='" . $class . "'/>";
        }

        return $str;
    }

    /**
     * 表单取消按钮
     *
     *     echo HTML::cancel_anchor('/user/profile');
     *
     * @param  $uri
     * @param null $title
     * @param array $attributes
     * @return string
     * @uses    HTML::attributes
     */
    public static function  cancel_anchor($uri = '', $title = NULL, $attributes = array())
    {
        $attributes['type'] = 'button';
        if (strpos($uri, '://') !== FALSE) {
            if (HTML::$windowed_urls === TRUE && empty($attributes['onclick'])) {
                // Make the link open in a new window
                $attributes['onclick'] = 'window.open(\'' . $uri . '\')';
            }
        }
        elseif (!empty($uri) && empty($attributes['onclick']))
        {
            // Make the URI absolute for non-id anchors
            $attributes['onclick'] = 'location.href=\'' . $uri . '\'';
        }
        if (empty($title)) {
            $title = __('Cancel');
        }
        if (empty($attributes['class'])) {
            $attributes['class'] = 'btn';
        }
        return '<button' . HTML::attributes($attributes) . '>' . $title . '</button>';
    }

	
}