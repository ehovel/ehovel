	//* detect touch devices 
    function is_touch_device() {
	  return !!('ontouchstart' in window);
	}

	$(document).ready(function() {
		if(!is_touch_device()){
		    //* popovers
            gebo_popOver.init();
        }
		//* sidebar
        gebo_sidebar.init();
		gebo_sidebar.make_active();
		//* breadcrumbs
        gebo_crumbs.init();
		//* colorbox single
		if($('.cbox_single').length) {
			gebo_colorbox_single.init();
		}
		//* main menu mouseover
		gebo_nav_mouseover.init();
		//* top submenu
		gebo_submenu.init();
		
		gebo_sidebar.make_scroll();
		gebo_sidebar.update_scroll();
		
		//* style switcher
		gebo_style_sw.init();
		
		//* to top
		$().UItoTop({inDelay:200,outDelay:200,scrollSpeed: 500});
		
		$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
	});
	//* popovers
    gebo_popOver = {
        init: function() {
            $(".pop_over").popover();
        }
    };
    
    //* breadcrumbs
    gebo_crumbs = {
        init: function() {
            $('#jCrumbs').jBreadCrumb({
                endElementsToLeaveOpen: 0,
                beginingElementsToLeaveOpen: 0,
                timeExpansionAnimation: 500,
                timeCompressionAnimation: 500,
                timeInitialCollapse: 500,
                previewWidth: 50
            });
        }
    };
    
    gebo_sidebar = {
        init: function() {
			// sidebar onload state
			if($(window).width() > 979){
                if(!$('body').hasClass('sidebar_hidden')) {
                    if( $.cookie('gebo_sidebar') == "hidden") {
                        $('body').addClass('sidebar_hidden');
                        $('.sidebar_switch').toggleClass('on_switch off_switch').attr('title','Show Sidebar');
                    }
                } else {
                    $('.sidebar_switch').toggleClass('on_switch off_switch').attr('title','Show Sidebar');
                }
            } else {
                $('body').addClass('sidebar_hidden');
                $('.sidebar_switch').removeClass('on_switch').addClass('off_switch');
            }
            
			//* sidebar visibility switch
            $('.sidebar_switch').click(function(){
                $('.sidebar_switch').removeClass('on_switch off_switch');
                if( $('body').hasClass('sidebar_hidden') ) {
                    $.cookie('gebo_sidebar', null);
                    $('body').removeClass('sidebar_hidden');
                    $('.sidebar_switch').addClass('on_switch').show();
                    $('.sidebar_switch').attr( 'title', "Hide Sidebar" );
                } else {
                    $.cookie('gebo_sidebar', 'hidden');
                    $('body').addClass('sidebar_hidden');
                    $('.sidebar_switch').addClass('off_switch');
                    $('.sidebar_switch').attr( 'title', "Show Sidebar" );
                };
				gebo_sidebar.update_scroll();
				$(window).resize();
            });
            //* prevent accordion link click
            $('.sidebar .accordion-toggle').click(function(e){e.preventDefault()});
        },
		make_active: function() {
			var thisAccordion = $('#side_accordion');
			thisAccordion.find('.accordion-heading').removeClass('sdb_h_active');
			var thisHeading = thisAccordion.find('.accordion-body.in').prev('.accordion-heading');
			if(thisHeading.length) {
				thisHeading.addClass('sdb_h_active');
			}
		},
        make_scroll: function() {
			if($('.antiScroll').length) {
				antiScroll = $('.antiScroll').antiscroll().data('antiscroll');
			}
        },
        update_scroll: function() {
			if($('.antiScroll').length) {
				if( $(window).width() > 979 ){
					$('.antiscroll-inner,.antiscroll-content').height($(window).height() - 40);
				} else {
					$('.antiscroll-inner,.antiscroll-content').height('400px');
				}
				antiScroll.refresh();
			}
        }
    };

	//* main menu mouseover
	gebo_nav_mouseover = {
		init: function() {
			$('#mainmenu li.dropdown').mouseenter(function() {
				if($('body').hasClass('menu_hover')) {
					$(this).addClass('navHover')
				}
			}).mouseleave(function() {
				if($('body').hasClass('menu_hover')) {
					$(this).removeClass('navHover open')
				}
			});
            $('#mainmenu li.dropdown > a').click(function(){
                if($('body').hasClass('menu_hover')) {
                    window.location = $(this).attr('href');
                }
            });
		}
	};
	
	//* single image colorbox
	gebo_colorbox_single = {
		init: function() {
			$('.cbox_single').colorbox({
				maxWidth	: '80%',
				maxHeight	: '80%',
				opacity		: '0.2', 
				fixed		: true
			});
		}
	};
	
	//* submenu
	gebo_submenu = {
		init: function() {
			$('.dropdown-menu li').each(function(){
				var $this = $(this);
				if($this.children('ul').length) {
					$this.addClass('sub-dropdown');
					$this.children('ul').addClass('sub-menu');
				}
			});
			
			$('.sub-dropdown').on('mouseenter',function(){
				$(this).addClass('active').children('ul').addClass('sub-open');
			}).on('mouseleave', function() {
				$(this).removeClass('active').children('ul').removeClass('sub-open');
			})
			
		}
	};
	
	//* style switcher
	gebo_style_sw = {
		init: function() {
			$('body').append('<a class="ssw_trigger" href="javascript:void(0)"><i class="icon-cog icon-white"></i></a>');
			var defLink = $('#link_theme').clone();
			
			
			$('input[name=ssw_sidebar]:first,input[name=ssw_layout]:first,input[name=ssw_menu]:first').attr('checked', true);
			
			$(".ssw_trigger").click(function(){
				$(".style_switcher").toggle("fast");
				$(this).toggleClass("active");
				return false;
			});
			
			// colors
			$('.style_switcher .jQclr').click(function() {
                $(this).closest('div').find('.style_item').removeClass('style_active');
				$(this).addClass('style_active');
				var style_selected = $(this).attr('title');
				$('#link_theme').attr('href','css/'+style_selected+'.css');
            });
			
			// backgrounds
			$('.style_switcher .jQptrn').click(function(){
				$(this).closest('div').find('.style_item').removeClass('style_active');
				$(this).addClass('style_active');
				var style_selected = $(this).attr('title');
				if($(this).hasClass('jQptrn')) { $('body').removeClass('ptrn_a ptrn_b ptrn_c ptrn_d ptrn_e').addClass(style_selected); };
			});
			//* layout
			$('input[name=ssw_layout]').click(function(){
				var layout_selected = $(this).val();
				$('body').removeClass('gebo-fixed').addClass(layout_selected);
			});
			//* sidebar position
			$('input[name=ssw_sidebar]').click(function(){
				var sidebar_position = $(this).val();
				$('body').removeClass('sidebar_right').addClass(sidebar_position);
				$(window).resize();
			});
			//* menu show
			$('input[name=ssw_menu]').click(function(){
				var menu_show = $(this).val();
				$('body').removeClass('menu_hover').addClass(menu_show);
			});
			
			//* reset
			$('#resetDefault').click(function(){
				$('body').attr('class', '');
				$('.style_item').removeClass('style_active').filter(':first-child').addClass('style_active');
				$('#link_theme').replaceWith(defLink);
				$('.ssw_trigger').removeClass('active');
				$(".style_switcher").hide();
				return false;
			});
			
			$('#showCss').click(function(e){
				var themeLink = $('#link_theme').attr('href');
				var bodyClass = $('body').attr('class');
				var contentStyle = '';
				contentStyle = '<div style="padding:20px;background:#fff">';
				console.log(themeLink);
				if(themeLink != 'css/blue.css') {
					contentStyle += '<div class="sepH_c"><textarea style="height:20px" class="span5">&lt;link id="link_theme" rel="stylesheet" href="'+themeLink+'"&gt;</textarea><span class="help-block">Find stylesheet with id="link_theme" in document head and replace it with this code.</span></div>';
				}
				if(bodyClass != '') {
					contentStyle += '<textarea style="height:20px" class="span5">&lt;body class="'+$('body').attr('class')+'"&gt;</textarea><span class="help-block">Replace body tag with this code.</span>';
				} else {
					contentStyle += '<textarea style="height:20px" class="span5">&lt;body&gt;</textarea>';
				}
				contentStyle += '</div>';
				$.colorbox({
					opacity				: '0.2',
					fixed				: true,
					html				: contentStyle
				});
				e.preventDefault();
			})
		}
	};