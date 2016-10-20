var wpts_admin = wpts_admin || {};

if (typeof $ === 'undefined')
    var $ = jQuery;

// Global variables
wpts_admin.classEl = '.';

wpts_admin.SettingsOpenCloseEffect = function( obj_this )
{
    var obj_fa = obj_this.find('h3 > i');
    if ( obj_fa.hasClass('fa-plus-square') )
    {
        obj_fa.removeClass('fa-plus-square').addClass('fa-minus-square');
        obj_this.next().stop().slideDown();
    }
    else
    {
        obj_fa.removeClass('fa-minus-square').addClass('fa-plus-square');
        obj_this.next().stop().slideUp();
    }
};

// Init
wpts_admin.init = function()
{
    // Open / Close Effect
    $('.wpts_eb_title').click(function(){ wpts_admin.SettingsOpenCloseEffect( $(this) ); }).hover(
        function(){ $(this).find('h3 > i.fa-plus-square').css({'color':'#000'});},
        function(){ $(this).find('h3 > i.fa-plus-square').css({'color':'#aaa'});}
    );

    // Toggle btn.
    $('.toggle').toggles().on('toggle', function(e, active)
    {
        if (active)
            $(this).next().attr({'checked':'checked'});
        else
            $(this).next().attr({'checked':false});
    });
};

// Start jQuery
jQuery(function() {
    wpts_admin.init();
});
