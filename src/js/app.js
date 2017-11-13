jQuery(document).ready(function($) {
    enquire.register("screen and (min-width:1100px)", {
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