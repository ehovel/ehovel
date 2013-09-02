<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<?php $method_content = json_decode($data->method,true);
	$uri = $method_content['uri']?$method_content['uri']:'';
	$method = $method_content['method']? $method_content['method']:'';?>
        <form>
            <dl class="inline">
                <dt><label><?php echo __('Uri');?></label></dt>
                <dd>
                    <?php echo $uri;?>
                </dd>
                <dt><label><?php echo __('Method');?></label></dt>
                <dd>
                    <?php echo $method;?>
                </dd>
                <dt><label><?php echo __('Data');?></label></dt>
                <dd>
                    <?php echo json_decode($data->data,true);?>
                </dd>
                <dt><label><?php echo __('Adding Time');?></label></dt>
                <dd>
                    <?php echo $data->time;?>
                </dd>
            </dl>
         </form>
