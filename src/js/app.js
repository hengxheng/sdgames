jQuery(document).ready(function($) {
    enquire.register("screen and (max-width: 1000px)", {
        match: function() {
            $("#site-nav li a").click(function(e){
                e.preventDefault();
                var hf = $(this).attr("href");
                $('html, body').animate({
                    scrollTop: $(hf).offset().top-130
                }, 1000);     
            });

            var p2 = $("#p2").offset().top-135;
            var p3 = $("#p3").offset().top-135;
            var p4 = $("#p4").offset().top-135;

            $(window).scroll(function(e){
                var wtop = $(window).scrollTop();
                if(wtop>=p2 && wtop<p3){
                    if( !$("#site-nav #sw-btn").hasClass("active")){
                        $("#site-nav li").removeClass("active");
                        $("#site-nav #sw-btn").addClass("active");
                    }
                }
                else if(wtop>=p3 && wtop<p4){
                    if( !$("#site-nav #ps-btn").hasClass("active")){
                        $("#site-nav li").removeClass("active");
                        $("#site-nav #ps-btn").addClass("active");
                    }
                }
                else if(wtop>=p4){
                    if( !$("#site-nav #xb-btn").hasClass("active")){
                        $("#site-nav li").removeClass("active");
                        $("#site-nav #xb-btn").addClass("active");
                    }
                }
                else{
                    $("#site-nav li").removeClass("active");
                }
            });
        }
    });

    enquire.register("screen and (min-width:1480px)", {
        match : function() {
            $('#fullpage').pagepiling({
                menu: "#site-nav",
                anchors: ['p1','p2','p3','p4'],
                scrollingSpeed: 500,
            });
        },
    }); 

    

    $("#newsletterform").submit(function() {		
		$.ajax({
                type: "POST",
                url: '/server/form.php',
                data:$("#newsletterform").serialize(),
                success: function (data) {	
                    // Inserting html into the result div on success
                    $('#newsletterform').html('<p style="color:red;font-size:30px;margin: 10px 0;text-align: center;">Thank you for signing up</p>');
                },
                error: function(jqXHR, text, error){
                // Displaying if there are any errors
                    $('#newsletterform').html(error);           
            }
        });
		return false;
    });
    
    
});