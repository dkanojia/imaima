jQuery(function(){
    jQuery('.filter h3').on('click', function(){
        jQuery('#accordion').slideToggle();
    });
});

jQuery(function(){

	var jw = jQuery(window).width();
	//alert(jw);
	if(jw<992){
		
		jQuery(".navbar-collapse ul li .mega-menu").parent("li").find("a").addClass("class80");
		
		jQuery(".navbar-collapse ul li .mega-menu").parent("li").find("a").after("<span class='arrow_up'><i class='fa fa-plus' aria-hidden='true'></i> <i class='fa fa-minus' aria-hidden='true'></i></span>");		

		jQuery(".navbar-collapse ul li .mega-menu ul span").remove();

		
				
		jQuery(".navbar-collapse ul li ").on("click", "span.arrow_up", function(){
			jQuery(this).next(".mega-menu").slideToggle();
		});
		
		jQuery(".navbar-collapse ul li .mega-menu li ").on("click", "span.arrow_up", function(){
			jQuery(this).next(".sub-menu").slideToggle();
		});

		jQuery(".navbar-collapse ul li ul.dropdown-menu li a").on("click", function(){
			jQuery(this).next("ul.dropdown-menu").slideToggle();
		});
		
		jQuery(".navbar-collapse ul li ul li ul li ul li ").on("click", "span.arrow_up", function(){
			jQuery(this).next("ul").slideToggle();
		});		
		jQuery(".navbar-collapse ul li ul li ul li ul li ul li span").remove();
	}	

	jQuery(".navbar-collapse ul li ").on("click", "span.arrow_up", function(){
		if(jQuery(this).hasClass('arrow_down')){
			jQuery(this).removeClass('arrow_down');
		}else{
			jQuery(this).addClass('arrow_down');
		}
	});	

	jQuery(".navbar-collapse ul li ul li ").on("click", "span.arrow_up", function(){
		if(jQuery(this).hasClass('arrow_down')){
			jQuery(this).removeClass('arrow_down');
		}else{
			jQuery(this).addClass('arrow_down');
		}
	});





	var jw = jQuery(window).width();
	//alert(jw);
	if(jw<992){
		
		jQuery(".headerHome ul li .sub-menu-top").parent("li").find("a").addClass("class80");
		
		jQuery(".headerHome ul li .sub-menu-top").parent("li").find("a").after("<span class='arrow_up'><i class='fa fa-plus' aria-hidden='true'></i> <i class='fa fa-minus' aria-hidden='true'></i></span>");		

		jQuery(".headerHome ul li .sub-menu-top ul span").remove();		
				
		jQuery(".headerHome ul li ").on("click", "span.arrow_up", function(){
			jQuery(this).next(".sub-menu-top").slideToggle();
		});
		
		
	}	

	jQuery(".headerHome ul li ").on("click", "span.arrow_up", function(){
		if(jQuery(this).hasClass('arrow_down')){
			jQuery(this).removeClass('arrow_down');
		}else{
			jQuery(this).addClass('arrow_down');
		}
	});	

	jQuery(".headerHome ul li ul li ").on("click", "span.arrow_up", function(){
		if(jQuery(this).hasClass('arrow_down')){
			jQuery(this).removeClass('arrow_down');
		}else{
			jQuery(this).addClass('arrow_down');
		}
	});



});

// jQuery(function(){

// 	var jw = jQuery(window).width();
	//alert(jw);
	//if(jw<992){
		
		// jQuery(".left-bar-menu ul li .mega-menu").parent("li").find("a").addClass("class80");
		
		// jQuery(".left-bar-menu ul li .mega-menu").parent("li").find("a").after("<span class='arrow_up'><i class='fa fa-plus' aria-hidden='true'></i> <i class='fa fa-minus' aria-hidden='true'></i></span>");		

		// jQuery(".left-bar-menu ul li .mega-menu ul span").remove();

		// jQuery(".left-bar-menu ul li .mega-menu ul ").parent("li").find("a").after("<span class='arrow_up'><i class='fa fa-plus' aria-hidden='true'></i> <i class='fa fa-minus' aria-hidden='true'></i></span>");		

		// jQuery(".left-bar-menu ul li .mega-menu ul ul span").remove();
				
		// jQuery(".left-bar-menu ul li ").on("click", "span.arrow_up", function(){
		// 	jQuery(this).next(".mega-menu").slideToggle();
		// });
		
		// jQuery(".left-bar-menu ul li .mega-menu li ").on("click", "span.arrow_up", function(){
		// 	jQuery(this).next(".sub-menu").slideToggle();
		// });

		// jQuery(".left-bar-menu ul li ul.dropdown-menu li a").on("click", function(){
		// 	jQuery(this).next("ul.dropdown-menu").slideToggle();
		// });
		
		// jQuery(".left-bar-menu ul li ul li ul li ul li ").on("click", "span.arrow_up", function(){
		// 	jQuery(this).next("ul").slideToggle();
		// });		
		// jQuery(".left-bar-menu ul li ul li ul li ul li ul li span").remove();
	//}	

// 	jQuery(".left-bar-menu ul li ").on("click", "span.arrow_up", function(){
// 		if(jQuery(this).hasClass('arrow_down')){
// 			jQuery(this).removeClass('arrow_down');
// 		}else{
// 			jQuery(this).addClass('arrow_down');
// 		}
// 	});	

// 	jQuery(".left-bar-menu ul li ul li ").on("click", "span.arrow_up", function(){
// 		if(jQuery(this).hasClass('arrow_down')){
// 			jQuery(this).removeClass('arrow_down');
// 		}else{
// 			jQuery(this).addClass('arrow_down');
// 		}
// 	});
// }); 