<?php defined('SYSPATH') or die('No direct script access.');
class Helper_Resource
{
    /**
     * 根据attach的url得到缩略图的URL（attach_id:/attachment/view/3919.jpg->/attachment/view/3919_120x120.jpg）
     * @static
     * @param $url
     * @return string
     */
    public static function get_thumbnail_by_attach_url($url = '/attachment/view/3919.jpg', $preset = 'o')
    {
        $attach_configure = Kohana::config('resource.resourceAttach');

        $position = strrpos($url, '.'); //21
        $postfix = substr($url, $position); //.jpg
        $perfix = substr($url, 0, $position); ///attachment/view/3919
        $current_preset_string = !empty($attach_configure['thumbPresets'][$preset])
                ? '_' . $attach_configure['thumbPresets'][$preset] : '';
        $url = $perfix . $current_preset_string . $postfix;
        return $url;
    }

    /**
     * 根据attach_id获取图标(如果是图片要生成缩略图，如果是附件要生成附件的图标)
     *
     * @param array $resource 资源信息 array(0=>'11111',1=>'jpg')
     * @param string $stand
     * @return string
     */
    public static function get_img($resource, $stand = 't', $is_show_network = true)
    {
    	if (!isset($resource[0]) || !isset($resource[1])) {
    		return '/attach/no_image.png';
    	}
    	$object = $resource[0].'.'.$resource[1];
    	$config = Kohana::$config->load('resource')->get('resourceConfig');
        $img = '';
        //外部链接直接显示
        if (((substr($object, 0, 7) == 'http://') || (substr($object, 0, 8) == 'https://')) && $is_show_network == true) {
            return $object;
        } else {
            if (!empty($object)) {
            	//获取$stand对应的尺寸
            	$wh = isset($config['resourceAttach']['thumbPresets'][$stand]) ? $config['resourceAttach']['thumbPresets'][$stand] : '120x120';
				return '/attach/'.$resource[0].'-'.$wh.'.'.$resource[1];
            }
        }
    }

    /**
     * 根据attach_id获取资源链接（图片为源图，资源不资源链接）
     *
     * @param $attach_id
     * @param string $stand
     * @return string
     * @author bin
     * @version V1.0 2011-11-03
     */
    public static function get_link($attach_id, $stand = 'o')
    {
        $link = '#';return '#';
        if ((substr($attach_id, 0, 7) == 'http://') || (substr($attach_id, 0, 8) == 'https://')) {
            //如果是外部链接直接返回
            return $attach_id;
        } else {
            if (!empty($attach_id)) {
                if (is_numeric($attach_id)) {
                    $resource_data = bm('resource')->get_by_attach($attach_id);
                    if (!empty($resource_data) && !empty($resource_data['attach_id'])) {
                        $link = bm('resource')->get_attach_link($resource_data, $stand);
                    } else {
                        $kc_link = self::get_attach_kc($attach_id, $stand);
                        if (!empty($kc_link)) {
                            $link = $kc_link;
                        }
                    }
                } else {
                    $link = $attach_id;
                }
            }
            return $link;
        }
    }

    /**
     * 获取原kc_images中是否存在本图，如果存在则需要读取kc_images中的后缀
     *
     * @param $attach_id
     * @return void
     */
    private static function get_attach_kc($attach_id, $stand = 't')
    {
        $link = '';
        $kc_image = bm('site_kc_image')->get_by_attach($attach_id);
        if (!empty($kc_image) && !empty($kc_image['attch_id'])) {
            $attachment_id = $attach_id;
            $current_postfix = $kc_image['image_type'];
            $link = bm('resource')->get_view_url($attachment_id, $stand, $current_postfix);
        }
        return $link;
    }
}
