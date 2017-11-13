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
});