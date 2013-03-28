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
     * @param $attach_id
     * @param string $stand
     * @return string
     * @author bin
     * @version V1.0 2011-11-03
     */
    public static function get_img($attach_id, $stand = 't', $is_show_network = true)
    {
        $img = '';return '';
        //外部链接直接显示
        if (((substr($attach_id, 0, 7) == 'http://') || (substr($attach_id, 0, 8) == 'https://')) && $is_show_network == true) {
            return $attach_id;
        } else {
            if (!empty($attach_id)) {
                //如果attach_id为数字则需要读取后缀后显示
                if (is_numeric($attach_id)) {
                    $resource_data = bm('resource')->get_by_attach($attach_id);
                    if (!empty($resource_data) && !empty($resource_data['attach_id'])) {
                        $img = bm('resource')->get_attach_img($resource_data, $stand);
                    } else {
                        $kc_img = self::get_attach_kc($attach_id, $stand);

                        if (!empty($kc_img)) {
                            $img = $kc_img;
                        }
                        if (empty($img)) {
                            if (!empty($attach_id)) {
                                $img = '/images/file_icon/error.jpg';
                            } else {
                                $img = '/images/no_image_available.png';
                            }
                        }
                    }
                } else {
                    ///attachment/view/3919.jpg直接展示
                    $img = self::get_thumbnail_by_attach_url($attach_id,$stand);
                }
            }
            return $img;
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
