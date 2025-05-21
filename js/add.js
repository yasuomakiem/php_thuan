$(function(){

    $('.wpsl-search').addClass( "container" );
    $('#wpsl-search-wrap').addClass( "col-md-4" );

    var url = window.location.pathname, 
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.menu-menu-page-products-money-container ul li a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });
    var url_motor = window.location.pathname, 
        urlRegExp_motor = new RegExp(url_motor.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.menu-menu-motorbyke-container ul li a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp_motor.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });

    $('.menu-middle .menu-submenu-carrer-container ul li:first-child').addClass('active');
    var url_carrer = window.location.pathname, 
        urlRegExp_carrer = new RegExp(url_carrer.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.menu-submenu-carrer-container ul li a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp_carrer.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });
        
    var url_cat = window.location.pathname, 
        urlRegExp_cat = new RegExp(url_cat.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.menu-middle.categories li.col-md-3 a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp_cat.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });

     var url_cataq = window.location.pathname, 
        urlRegExp_cataq = new RegExp(url_cataq.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.menu-menu-faq-container ul li a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp_cataq.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });
    var url_cat_poaq = window.location.pathname, 
        urlRegExp_cat_poaq = new RegExp(url_cat_poaq.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.faq ul li').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp_cat_poaq.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });

    var url_category_post = window.location.pathname, 
        urlRegExp_cat_post = new RegExp(url_category_post.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.menu-middle.categories ul li a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp_cat_post.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });

    var url_category_post_guide = window.location.pathname, 
        urlRegExp_cat_post_guide = new RegExp(url_category_post_guide.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.menu-middle ul li a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp_cat_post.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });

    var url_category_post_guide_card = window.location.pathname, 
        urlRegExp_cat_post_guide_card = new RegExp(url_category_post_guide_card.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.menu-middle.guide_card ul li a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp_cat_post.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        }); 

    /*var url_elect = window.location.pathname,
        urlRegExp_elect = new RegExp(url_elect.replace(/\/$/,'') + "$");
        $('ul.lsn li a').each(function(){
            if(urlRegExp_elect.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });*/
        
    /*$('.sub-menu .menu-item-post_type')*/

         $('.menu-menu-page-products-money-container ul li a').click( function(){
            $('.menu-menu-page-products-money-container ul li:first-child').removeClass('active');
            return true;
        } );
        /*$('.menu-menu-page-products-money-container ul li:first-child').addClass('active');*/

        
    


});