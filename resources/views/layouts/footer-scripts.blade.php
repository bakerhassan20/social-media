<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>


 <script src="{{URL::asset('assets/../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>

	 <script src="{{URL::asset('assets/js/map-init.js')}}"></script> }

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{URL::asset('assets/js/main.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/script.js')}}"></script>

<script>

</script>

<script>

function likes(postId){
    $("#like[data-postId='" + postId +"']").find("i").toggleClass("far fas");
    if($("#dislike[data-postId='" + postId +"']").find("i").attr('class') == 'fas fa-heart-broken'){
    $("#dislike[data-postId='" + postId +"']").find("i").toggleClass("fas fa-heart-broken far fa-heart");
    }
   var postId = postId;
    $.ajax({
        type:'get',
        url:"{{ route('likes') }}",
        data: { postId: postId },

        success: function (data) {
        $("#likes-number[data-postId='" + postId +"']").text(data.likes);
            $("#dislikes-number[data-postId='" + postId +"']").text(data.dislikes);
        },
    error: function(error) {
    console.log(error.responseText);
        }
    });
   }



function dislikes(postId){
   $("#dislike[data-postId='" + postId +"']").find("i").toggleClass("fas fa-heart-broken far fa-heart");
       if($("#like[data-postId='" + postId +"']").find("i").attr('class') == 'fas fa-heart' ||$("#like[data-postId='" + postId +"']").find("i").attr('class') == 'fa-heart fas'){
        $("#like[data-postId='" + postId +"']").find("i").toggleClass("fas fa-heart far fa-heart");
      // console.log('ggg');
    }
   var postId = postId;
    $.ajax({
        type:'get',
        url:"{{ route('dislikes') }}",
        data: { postId: postId },

        success: function (data) {
            $("#likes-number[data-postId='" + postId +"']").text(data.likes);
            $("#dislikes-number[data-postId='" + postId +"']").text(data.dislikes);
        },
    error: function(error) {
    console.log(error.responseText);
        }
    });
   }


function scrollDown(){
   document.getElementById("chat").scrollTop = document.getElementById("chat").scrollHeight
 }
setInterval(scrollDown,10);

</script>
