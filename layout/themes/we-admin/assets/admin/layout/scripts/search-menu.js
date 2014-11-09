$(document).ready(function(){

    $("#filter").keyup(function(){

        var words = $("#filter").val();

        if( words.length > 0){

            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val(), count = 0;

            // Loop through the comment list
            $(".page-sidebar-menu li").each(function(){

                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {

                    $(this).not('.sidebar-toggler-wrapper, .sidebar-search-wrapper').fadeOut();

                // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $('.page-sidebar-menu li').not('.page-sidebar-menu li ul li').addClass( "active open" );
                    $(this).not('.sidebar-search-wrapper, .sidebar-search-wrapper').show();
                    count++;
                }
            });
        }else{
             $(".page-sidebar-menu li").each(function(){
                 if(!$(this).find('.selected').length != 0){
                    $(this).removeClass( "active open" );
                }
                 $(this).show();
            });

        }

    });
});