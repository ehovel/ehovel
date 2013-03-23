/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */
if ("undefined" === typeof Joomla) var Joomla = {};
Joomla.submitform = function(a, b) {
	"undefined" === typeof b && (b = document.getElementById("adminForm"));
	"undefined" !== typeof a && (b.task.value = a);
	if ("function" == typeof b.onsubmit) b.onsubmit();
	"function" == typeof b.fireEvent && b.fireEvent("submit");
	b.submit()
};
Joomla.submitbutton = function(a) {
	Joomla.submitform(a)
};
(function($)
{
	$(document).ready(function()
	{
		 jQuery('.hasTip').tooltip({placement:'right'});

		// Turn radios into btn-group
		$('.radio.btn-group label').addClass('btn');
		$(".btn-group label:not(.active)").click(function()
		{
			var label = $(this);
			var input = $('#' + label.attr('for'));

			if (!input.prop('checked')) {
				label.closest('.btn-group').find("label").removeClass('active btn-success btn-danger btn-primary');
				if (input.val() == '') {
					label.addClass('active btn-primary');
				} else if (input.val() == 0) {
					label.addClass('active btn-danger');
				} else {
					label.addClass('active btn-success');
				}
				input.prop('checked', true);
			}
		});
		$(".btn-group input[checked=checked]").each(function()
		{
			if ($(this).val() == '') {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-primary');
			} else if ($(this).val() == 0) {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-danger');
			} else {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-success');
			}
		});
	})
})(jQuery);