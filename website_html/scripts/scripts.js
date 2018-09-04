$(document).ready(function(){
          // var $win = $(window);

          // $('#background').each(function(){
          //     var scroll_speed = 10;
          //     var $this = $(this);
          //     $(window).scroll(function() {
          //         var bgScroll = -(($win.scrollTop() - $this.offset().top)/ scroll_speed);
          //         var bgPosition = 'center '+ bgScroll + 'px';
          //         $this.css({ backgroundPosition: bgPosition });
          //     });
          // });
          // $('#background2').each(function(){
          //     var scroll_speed = 10;
          //     var $this = $(this);
          //     $(window).scroll(function() {
          //         var bgScroll = -(($win.scrollTop() - $this.offset().top)/ scroll_speed);
          //         var bgPosition = 'center '+ bgScroll + 'px';
          //         $this.css({ backgroundPosition: bgPosition });
          //     });
          // });
          // $('#background3').each(function(){
          //     var scroll_speed = 10;
          //     var $this = $(this);
          //     $(window).scroll(function() {
          //         var bgScroll = -(($win.scrollTop() - $this.offset().top)/ scroll_speed);
          //         var bgPosition = 'center '+ bgScroll + 'px';
          //         $this.css({ backgroundPosition: bgPosition });
          //     });
          // });
   

    $(".grid-item > img").hover(function(){
            $(this).animate({opacity:.9}, 125);
            }, function(){
            $(this).animate({opacity:1}, 125);
        });   
    $(".grid-item2 > img").hover(function(){
              $(this).animate({opacity:.9}, 125);
            }, function(){
            $(this).animate({opacity:1}, 125);
        });   

    // $("p").hover(function(){
    //     $(this).css("background-color", "yellow");
    //     }, function(){
    //     $(this).css("background-color", "pink");
    // });   
});