$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.modal').modal();
    $('.tabs').tabs();
    $('.materialboxed').materialbox();
    $('.carousel').carousel();
    $('select').formSelect();
    

    $(window).scroll(function(){
        if(this.scrollY > 150 ){
            $('nav').addClass("sticky");
        }else{
            $('nav').removeClass("sticky");
        }
        if(this.scrollY > 200){
             $('.scroll-up-btn').addClass("show");
        }
        else{
              $('.scroll-up-btn').removeClass("show");
        }
    });    

    
    $('.scroll-up-btn').click(function(){
        $('html').animate({ scrollTop: 0 });
    });
    
    var typed = new Typed('.typing', {
        strings: ["Web Developer", "Web Designer", "Blogger"],
        loop: true,
        typeSpeed: 100,
        backSpeed: 60,
        
        });

        $(function(){
            $("nav li a").on('click',function(){
                $("html, body").animate({
                    scrollTop: $($.attr(this, 'href')).offset().top
                }, 1000);
            });
        });
    
    
        $('.sidenav li a').click(() => {
            $('.sidenav').sidenav('close');
          })

          
            $('select').formSelect();
          
});

