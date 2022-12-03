jQuery(document).ready(function($) {

	"use strict";


 //--- Notifications dropdown on topbar
 $('.Notifi').on("click",function(){
    $('.Notifications').toggleClass("active");
    $('.Messages').removeClass("active");
    $('.languages').removeClass("active");
    $('.user-setting').removeClass("active");
  });


  //--- languages dropdown on topbar
 $('.lang').on("click",function(){
    $('.languages').toggleClass("active");
    $('.Notifications').removeClass("active");
    $('.Messages').removeClass("active");
    $('.user-setting').removeClass("active");

  });

//--- user setting dropdown on topbar
$('.user-img').on('click', function() {
	$('.user-setting').toggleClass("active");
    $('.languages').removeClass("active");
    $('.Notifications').removeClass("active");
    $('.Messages').removeClass("active");

});

 //--- side message box {chat}
 $('.chat-users > li').on('click', function() {
	$('.chat-box').addClass("show");

});
	$('.close-mesage').on('click', function() {
		$('.chat-box').removeClass("show");
	});

/*--- socials menu scritp {share}---*/
	$('.trigger').on("click", function() {
	    $(this).parent(".menu").toggleClass("active");
	  });


//===== Search Filter =====//
	(function ($) {
	// custom css expression for a case-insensitive contains()
	jQuery.expr[':'].Contains = function(a,i,m){
	  return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
	};

	function listFilter(searchDir, list) {
        var form = $("<form>").attr({"class":"filterform","action":"#"}),
        input = $("<input>").attr({"class":"filterinput","type":"text","placeholder":"Search Contacts..."});
        $(form).append(input).appendTo(searchDir);

        $(input)
        .change( function () {
          var filter = $(this).val();
          if(filter) {
            $(list).find("li:not(:Contains(" + filter + "))").slideUp();
            $(list).find("li:Contains(" + filter + ")").slideDown();
          } else {
            $(list).find("li").slideDown();
          }
          return false;
        })
        .keyup( function () {
          $(this).change();
        });
      }

//search friends widget
$(function () {
    listFilter($("#searchDir"), $("#people-list"));
  });
  }(jQuery));

//progress line for page loader
	$('body').show();
	NProgress.start();
	setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 2000);


// Sticky Sidebar & header
	if($(window).width() < 769) {
		jQuery(".sidebar").children().removeClass("stick-widget");
	}

	if ($.isFunction($.fn.stick_in_parent)) {
		$('.stick-widget').stick_in_parent({
			parent: '#page-contents',
			offset_top: 60,
		});


		$('.stick').stick_in_parent({
		    parent: 'body',
            offset_top: 0,
		});

	}



if ($.isFunction($.fn.loadMoreResults)) {
	$('.loadMore').loadMoreResults({
		displayedItems: 3,
		showItems: 1,
		button: {
		  'class': 'btn-load-more',
		  'text': 'Load More'
		}
	});
}


//---- responsive header


// login & register form
	$('button.signup').on("click", function(){
		$('.login-reg-bg').addClass('show');

	  });

	  $('.already-have').on("click", function(){
		$('.login-reg-bg').removeClass('show');

	  });



//inbox page



});//document ready end



  //live porfile image

var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

 //live cover image
  var loadFilecover = function(event) {
    var output2 = document.getElementById('output2');
    output2.src = URL.createObjectURL(event.target.files[0]);
    output2.onload = function() {
      URL.revokeObjectURL(output2.src) // free memory
    }
  };



   //live post image
   var loadFilepost = function(event) {
    var post_img = document.getElementById('post_img');
    const element = document.getElementById('output3');
    if(element != null){
        element.remove();
        const element2 = document.getElementById('close-img');
        element2.remove();
        var el = document.createElement('img');
        el.setAttribute('id','output3');
        el.setAttribute('style','height:70px;width:80px;');
        el.setAttribute('src');
        post_img.appendChild(el);
        //close icone
        $( "#post_img" ).append( "<span id='close-img'><i class='fas fa-window-close' onclick='closeimg()'></i></span>" );

    }else{

        var el = document.createElement('img');
        el.setAttribute('id','output3');
        el.setAttribute('style','height:70px;width:80px;');
        el.setAttribute('src');
        post_img.appendChild(el);
        //close icone
        $( "#post_img" ).append( "<span id='close-img'><i class='fas fa-window-close' onclick='closeimg()'></i></span>" );

    }
    var output3 = document.getElementById('output3');
    output3.src = URL.createObjectURL(event.target.files[0]);
    output3.onload = function() {
      URL.revokeObjectURL(output3.src) // free memory
    }

  };

  function closeimg(){
    var post_file = document.getElementById('post_file').value='';
    const element = document.getElementById('output3');
    const element2 = document.getElementById('close-img');
    element.remove();
    element2.remove();
  }


//toggle show between photos and posts in profile page

$('#ps_section').on("click", function(event) {
    $('#ps_section').toggleClass("active");
    $('#ps_photo').removeClass("active");
    $("#img_section").attr("style","display:none;");
    $("#post_section").attr("style","display:unset;");
});


$('#ps_photo').on("click", function(event) {
    $('#ps_photo').toggleClass("active");
    $('#ps_section').removeClass("active");
    $("#post_section").attr("style","display:none;");
    $("#img_section").attr("style","display:unset; !important;");
});


// widget (my page) in Home Page

$('#Posts_link').on("click", function(event) {
    $('#Posts_link').addClass("active");
    $('#Friends_link').removeClass("active");
    $('#link1').addClass("show");
    $('#link2').removeClass("show");
    $('#link1').addClass("active");
    $('#link2').removeClass("active");


});

$('#Friends_link').on("click", function(event) {
    $('#Friends_link').addClass("active");
    $('#Posts_link').removeClass("active");
    $('#link2').addClass("show");
    $('#link1').removeClass("show");
    $('#link2').addClass("active");
    $('#link1').removeClass("active");

});



