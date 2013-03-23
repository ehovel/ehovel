<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo !empty($title) ? $title : ''; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="expires" content="-1">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/statics/css/bootstrap.css" title="blue">
    <link rel="stylesheet" type="text/css" href="/statics/css/style.css" title="blue">
    <link rel="stylesheet" type="text/css" href="/statics/css/skins/blue.css" title="blue">
    <link rel="stylesheet" type="text/css" href="/statics/css/icon.css" title="blue">
    <link rel="stylesheet" type="text/css" href="/statics/css/BreadCrumb.css" title="blue">
    <script type="text/javascript" src="/statics/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup ({
            cache: false //close AJAX cache
        });
    </script>
</head>
<body class="fluid ">
<?php echo $header; ?>
<section id="layout_content" class="container-fluid">
	<?php Message::render();?>
    <?php echo $content; ?>
</section>
<?php echo $footer; ?>
<script src="/statics/js/custom.js"></script>
<script src="/statics/js/jquery.cookie.js"></script>
<script src="/statics/js/jquery.jBreadCrumb.1.1.min.js"></script>
<script src="/statics/js/jquery.ui.totop.min.js"></script>
<script src="/statics/js/bootstrap.js"></script>
<script language="javascript" type="text/javascript">
	(function($){
		// fix sub nav on scroll
		var $win = $(window)
		  , $nav = $('.subhead')
		  , navTop = $('.subhead').length && $('.subhead').offset().top - 40			  , isFixed = 0

		processScroll()

		// hack sad times - holdover until rewrite for 2.1
		$nav.on('click', function () {
			if (!isFixed) setTimeout(function () {  $win.scrollTop($win.scrollTop() - 47) }, 10)
		})

		$win.on('scroll', processScroll)

		function processScroll() {
			var i, scrollTop = $win.scrollTop()
			if (scrollTop >= navTop && !isFixed) {
				isFixed = 1
				$nav.addClass('subhead-fixed')
			} else if (scrollTop <= navTop && isFixed) {
				isFixed = 0
				$nav.removeClass('subhead-fixed')
			}
		}
	})(jQuery);
	function jqGridBuildSelect(httpRequest)
    {
        try {
            if (typeof httpRequest == 'object') {
                httpRequest = httpRequest.responseText;
            }
            eval('var rethat = ' +  httpRequest + ';');
            if (rethat['status'] == 1) {
                var html = '<option value=""></option>';
                for (var k in rethat['content']) {
                    html += '\
                        <option value="' + k + '">\
                            ' + rethat['content'][k] + '\
                        </option>\
                    ';
                }
                return '<select>' + html + '</select>';
            } else {
                jQuery.kMsg.error(rethat['msg']);
            }
        } catch (e) {
            //alert(e)
        }
    }
</script> 
</body>
</html>

<?php //echo View::factory('profiler/stats')->render(NULL, FALSE); ?>
