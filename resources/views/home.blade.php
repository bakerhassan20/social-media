@extends('layouts.master')

@section('content')

    <section>
        <div class="gap gray-bg">
            <div class="container-fluid" style="margin-top: 50px;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                            <div class="col-lg-3">
                                <aside class="sidebar static">
                                    <div class="widget">
                                        <h4 class="widget-title">Shortcuts</h4>
                                        <ul class="naves">
                                            <li>
                                                <i class="ti-files"></i>
                                                <a href="{{ route('profile') }}" title="">My Posts</a>
                                            </li>
                                            <li>
                                                <i class="ti-image"></i>
                                                <a href="timeline-photos.html" title="">images</a>
                                            </li>
                                            <li>
                                                <i class="ti-power-off"></i>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                                                <form id="logout-form1" action="{{ route('logout') }}" method="POST"
                                                      class="d-none">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </div><!-- Shortcuts -->

                    <div class="widget stick-widget">
                        <h4 class="widget-title">People You May Know</h4>

                        <ul class="followers">
                            @foreach ($users as $user)
                               @if($friends->contains('id', $user->id))
                                @else
                                    <li>
                                      <a href="{{ route('user_profile',$user->id) }}"title="">
                                        <figure>
                                            <img src="{{ asset('assets/Users_Img/'.$user->img)}}"alt=""style="height:50px;width:50px">
                                        </figure>
                                        <div class="friend-meta">
                                          <h6>{{ $user->name }}</h6>
                                    </a>
                                        </div>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </div><!-- People You May Know -->
            </aside>
        </div><!-- sidebar -->


                <div class="col-lg-5">
                    <div class="central-meta">
                        <div class="new-postbox">
                            <figure>
                                <img style="height:50px;width:50px"
                                    src="{{ asset('assets/Users_Img/'.Auth::user()->img)}}" alt="">
                            </figure>
                            <div class="newpst-input">
                                <form method="post" action="{{route('post.store')}}"enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <textarea name="desc" rows="2" placeholder="write something"></textarea>
                                           <div id="post_img">
                                            <!-- append code by js -->
                                            </div>
                                    <div class="attachments">
                                        <ul>
                                            <li>
                                                <i class="fa fa-image"></i>
                                                <label class="fileContainer">
                                                    <input type="file"onchange="loadFilepost(event)"id="post_file"name="post_file">
                                                </label>
                                            </li>
                                            <li>
                                                <button type="submit">Post</button>
                                            </li>
                                         </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- add post new box -->


        <div class="loadMore">
            @foreach ( $posts as $post)
                @if($friends->contains('id', $post->user_id) ||$post->user_id == Auth::user()->id )
                    <div class="central-meta item">
                        <div class="user-post">
                            <div class="friend-info">
                                <figure>
                                    <img src="{{ asset('assets/Users_Img/' .$post->users->img) }}"alt=""style="height:50px;width:50px">
                                </figure>
                            <div class="friend-name">
                                <ins>
                                    <a href="{{ route('user_profile',$post->users->id) }}"title="">
                                        {{ $post->users->name}}
                                    </a>
                                </ins>
                                <span>published: {{ $post->created_at }}</span>
                            </div>

        <div class="post-meta">
            <div class="we-video-info">
                <ul>
                    <li>
					    <span class="comment"title="Comments">
							<i class="fa fa-comments-o"></i>
							<ins>
                            @php
                            $count= \App\Models\Comments::where('post_id', $post->id )->count();
                                echo $count;
                            @endphp
                            </ins>
					    </span>
                    </li>

                    <li>
						<span class="like" title="like" id="like"onclick="likes({{ $post->id }})"     data-postId="{{ $post->id }}">
                         @php
                        if(\App\Models\likes::where(['user_id'=> Auth::user()->id,'post_id'=>$post->id])->exists() ){echo'<i class="fas fa-heart" style="color:green;"></i>';}

                        else{echo'<i class="far fa-heart" style="color:green;"></i>';}
                        @endphp
							<ins id="likes-number" data-postId="{{ $post->id }}">{{ $post->likes }}</ins>
						</span>
                    </li>

                    <li>
					<span class="dislike" id="dislike"title="dislike"onclick="dislikes({{ $post->id }})"data-postId="{{ $post->id }}">
                         @php
                        if(\App\Models\dislikes::where(['user_id'=> Auth::user()->id,'post_id'=>$post->id])->exists()){echo'<i class="fas fa-heart-broken" style="color:red;"></i>';}

                        else{echo'<i class="far fa-heart" style="color:red;"></i>';}

                        @endphp

				        <ins id="dislikes-number"data-postId="{{ $post->id }}">{{ $post->desliks }}</ins>
					</span>
                    </li>

                    <li class="social-media">
                        <div class="menu">
                            <div class="btn trigger"><i class="fa fa-share-alt"></i></div>
                        <div class="rotater">
                             <div class="btn btn-icon"><a href="#"title=""><i class="fa fa-html5"></i></a></div>
                        </div>
                        <div class="rotater">
                            <div class="btn btn-icon"><a href="#"title=""><i class="fa fa-facebook"></i></a></div>
                        </div>
                        <div class="rotater">
                        <div class="btn btn-icon"><a href="#"title=""><i class="fa fa-google-plus"></i></a></div>
                        </div>
                        <div class="rotater">
                            <div class="btn btn-icon"><a href="#"title=""><i class="fa fa-twitter"></i></a></div>
                        </div>
                        <div class="rotater">
                            <div class="btn btn-icon"><a href="#"title=""class="fa fa-css3"></i></a></div>
                        </div>
                        <div class="rotater">
                        <div class="btn btn-icon"><a href="#"title=""><i class="fa fa-instagram"></i></a></div>
                        </div>
                        <div class="rotater">
                            <div class="btn btn-icon"><a href="#"title=""><i class="fa fa-dribbble"></i></a></div>
                        </div>
                        <div class="rotater">
                        <div class="btn btn-icon"><a href="#"title=""><i class="fa fa-pinterest"></i></a></div>
                        </div>

                            </div>

                    </li>
           </ul>
        </div>


            @if($post->file_name != null)
                <img src="{{ asset('assets/Posts_Img/' . $post->file_name) }}"alt="">
            @endif
            <div class="description">
                <span>{{ $post->desc }}</span>
            </div>
    </div>
</div>

<div class="coment-area">
    <ul class="we-comet">
        @foreach ($post->comments as $comment )
            <li>
                <div class="comet-avatar">
                    <img style="height:45px;width:45px"src="{{ asset('assets/Users_Img/'. $comment->user->img)}}">
                </div>
                <div class="we-comment">
                    <div class="coment-head">
                        <h5><a href="time-line.html"title="">{{ $comment->user->name }}</a></h5>
                        <span>{{ $comment->created_at }}</span>
                        <a class="we-reply" href="#"title="Reply"><i class="fa fa-reply"></i></a>
                    </div>
                    <p>{{ $comment->content }}</p>
                </div>
            </li>
        @endforeach

            <li class="post-comment">
                <div class="comet-avatar">
                    <img style="height:30px;width:30px"src="{{ asset('assets/Users_Img/' . Auth::user()->img)}}">
                </div>
                <div class="post-comt-box">
                    <form method="post"action="{{ route('comment.store') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="post_id"value="{{ $post->id }}">
                        <textarea name="content"placeholder="Post your comment"required></textarea>
                        <div class="add-smiles">
                            <button class="btn btn-Primary"style="background-color:#088dcd;color:snow"title="add icon">comment
                            </button>
                        </div>

                        </form>
                    </div>
            </li>
        </ul>
    </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div><!-- centerl meta -->


<div class="col-lg-3">
    <aside class="sidebar static">
        <div class="widget">
            <h4 class="widget-title">Your page</h4>
        <div class="your-page">
        <figure>
            <a href="#" title=""><img src="{{ asset('assets/Users_Img/' . Auth::user()->img) }}" style="height:60px;width:60px"></a>
        </figure>
            <div class="page-meta">
                <a href="{{ route('profile') }}" title="" class="underline">My page</a>

            </div>
            <div class="page-likes">
                <ul class="nav nav-tabs likes-btn">
                    <li class="nav-item"><a class="active" href="#"id="Posts_link">Posts</a></li>
                    <li class="nav-item"><a class="" href="#" id="Friends_link">Friends</a></li>
                </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active fade show " id="link1">
                    <span><i class="fas fa-paste"></i>@php echo \App\Models\Post::where('user_id',Auth::user()->id)->count();@endphp
                    </span>
                </div>
                <div class="tab-pane fade" id="link2">
                    <span><i class="fas fa-user-friends"></i>@php echo $friends->count();@endphp</span>
                </div>
            </div>
        </div>
    </div>
</div><!-- page like widget -->



<div class="widget friend-list stick-widget">
    <h4 class="widget-title">Friends</h4>
    <div id="searchDir"></div>
        <ul id="people-list" class="friendz-list">
            @if($friends != null)
                @foreach ($friends as $user )
                    <li>
                        <figure>
                            <a href="{{ route('user_profile',$user->id) }}">
                            <img src="{{URL::asset('assets/Users_Img/' .$user->img) }}"alt=""style="height:50px;width:50px">
                            <span class="status f-online"></span>
                        </figure>
                        <div class="friendz-meta">
                            <a href="{{ route('user_profile',$user->id) }} ">{{ $user->name }}</a>
                            <i><a href="{{ route('user_profile',$user->id) }}"class="__cf_email__"
                                data-cfemail="a0d7c9ced4c5d2d3cfccc4c5d2e0c7cdc1c9cc8ec3cfcd">{{ $user->email }}</a></i>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
</div><!-- friends list sidebar -->

                            </aside>
                        </div><!-- sidebar -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



 
