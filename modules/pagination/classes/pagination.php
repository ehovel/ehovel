<?php defined('SYSPATH') or die('No direct script access.');

class Pagination extends Kohana_Pagination {
    
    /**
     * override ,默认不带layout布局
     * @see Kohana_Pagination::render()
     */
    public function render($view = NULL,$with_layout = FALSE)
    {
        // Automatically hide pagination whenever it is superfluous
        if ($this->config['auto_hide'] === TRUE AND $this->total_pages <= 1)
            return '';
    
        if ($view === NULL)
        {
            // Use the view from config
            $view = $this->config['view'];
        }
    
        if ( ! $view instanceof Kohana_View)
        {
            // Load the view file
            $view = View::factory($view);
        }
    
        // Pass on the whole Pagination object
        return $view->set(get_object_vars($this))->set('page', $this)->render(NULL,$with_layout);
    }
    
}