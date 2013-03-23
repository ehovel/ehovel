<?php defined('SYSPATH') or die('No direct access script');
// $Id$
/**
 * 按钮工具栏Helper
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Kshop
 * @since 11-7-8 上午11:20
 * @author Vicente
 * @version   $Id$
 */
class Helper_Toolbar{
	/**
	 * Toolbar array
	 *
	 * @var    array
	 */
	protected $_bar = array();
	protected static $instances = array();
	/**
	 * Returns the global JToolbar object, only creating it if it
	 * doesn't already exist.
	 *
	 * @param   string  $name  The name of the toolbar.
	 *
	 * @return  JToolbar  The JToolbar object.
	 *
	 * @since   1.5
	 */
	public static function getInstance()
	{
		if (empty(self::$instances))
		{
			self::$instances = new Helper_Toolbar();
		}
	
		return self::$instances;
	}
	
	/**
	 * Get a value.
	 *
	 * @return  string
	 *
	 * @since   1.5
	 */
	public function prependButton()
	{
		// Insert button into the front of the toolbar array.
		$btn = func_get_args();
		array_unshift($this->_bar, $btn);
		return true;
	}
	/**
	 * Set a value
	 *
	 * @return  string  The set value.
	 *
	 * @since   1.5
	 */
	public function appendButton()
	{
		// Push button onto the end of the toolbar array.
		$btn = func_get_args();
		array_push($this->_bar, $btn);
		return true;
	}

    public function render()
    {
    	$html = array();
    
    	// Start toolbar div.
    	$html[] = '<div class="btn-toolbar" id="toolbar">';
    
    	// Render each button in the toolbar.
    	foreach ($this->_bar as $button)
    	{
    		$html[] = $this->fetchButton($button[0],$button[1],$button[2]);
    	}
    
    	// End toolbar div.
    	$html[] = '</div>';
    
    	return implode("\n", $html);
    }
    
    /**
     * Fetch the HTML for the button
     *
     * @param   string   $type  Unused string.
     * @param   string   $name  The name of the button icon class.
     * @param   string   $text  Button text.
     * @param   string   $task  Task associated with the button.
     * @param   boolean  $list  True to allow lists
     *
     * @return  string  HTML string for the button
     *
     * @since   3.0
     */
    public function fetchButton($name = '', $text = '', $task = '', $list = true)
    {
    	$i18n_text = __($text);
    	$class = $this->fetchIconClass($name);
    	$doTask = $this->_getCommand($task, $list);
    
    	if ($name == "apply" || $name == "new")
    	{
    		$btnClass = "btn btn-small btn-success";
    		$iconWhite = "icon-white";
    	}
    	else
    	{
    		$btnClass = "btn btn-small";
    		$iconWhite = "";
    	}
    
    	$html = "<button href=\"#\" onclick=\"$doTask\" class=\"" . $btnClass . "\">\n";
    	$html .= "<i class=\"$class $iconWhite\">\n";
    	$html .= "</i>\n";
    	$html .= "$i18n_text\n";
    	$html .= "</button>\n";
    
    	return $html;
    }
    /**
     * Method to get the CSS class name for an icon identifier
     *
     * Can be redefined in the final class
     *
     * @param   string  $identifier  Icon identification string
     *
     * @return  string  CSS class name
     *
     * @since   3.0
     */
    public function fetchIconClass($identifier)
    {
    	return "icon-$identifier";
    }
    /**
     * Get the JavaScript command for the button
     *
     * @param   string   $name  The task name as seen by the user
     * @param   string   $task  The task used by the application
     * @param   boolean  $list  True is requires a list confirmation.
     *
     * @return  string   JavaScript command string
     *
     * @since   3.0
     */
    protected function _getCommand($task, $list)
    {
    	$list = false;
    	if ($list)
    	{
    		$cmd = "if (document.adminForm.boxchecked.value==0){alert('dd');}else{ Joomla.submitbutton('$task')}";
    	}
    	else
    	{
    		$cmd = "Joomla.submitbutton('$task')";
    	}
    
    	return $cmd;
    }
}
