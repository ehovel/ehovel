<?php defined('SYSPATH') OR die('No direct script access.');

class I18n extends Kohana_I18n {
    
    public static $history = NULL;
    
    /**
     *
     * @static
     * @param string $package
     * @return string
     */
    public static function package($package = NULL)
    {
        if (is_null(I18n::$history)) {
            I18n::$history = array(I18n::$lang);
        }
    
        if (!empty($package)) {
            I18n::$lang = I18n::$history[0].'-'.$package;
            I18n::$history[] = I18n::$lang;
        } else {
            if (count(I18n::$history) >  1) {
                array_pop(I18n::$history);
                I18n::$lang = I18n::$history[count(I18n::$history) - 1];
            } else {
                I18n::$lang = I18n::$history[0];
            }
        }
    
        return I18n::$lang;
    }
    
    /**
     * ��ȡĬ���趨�����԰�����
     * @static
     * @return void
     */
    public static function default_lang(){
        if(!empty(I18n::$history))
            return I18n::$history[0];
        else
            return I18n::$lang;
    }
    
}
