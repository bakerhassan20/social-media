@extends('layouts.master')

@section('content')
	<section>

		<div class="feature-photo">
			<figure><img  id="output2" style="height:400px;min-width:1366px"src="{{ asset('assets/Users_Img/'.$user->cover_img)}}"alt=""></figure>

    <div id="rerequest">
      <?php

          if(\App\Models\Friends::where(['user_id'=>Auth::user()->id,'friend_id'=>$user->id])->count() > 0 ||\App\Models\Friends::where(['user_id'=>$user->id,'friend_id'=>Auth::user()->id])->count() > 0){
        ?> <form action='{{ route('add_friend') }}' method="post">
                    @csrf
			       <div class="add-btn">
                   <input type="hidden"value="{{ $user->id }}" name="friend_id">
                   <input type="hidden"value="delete" name="delete">
                   <button style="background-color:#cbcb0b" type="submit"><i class="fas fa-window-close"></i> delete Friend</button>
        </div></form>

         <?php
          }
          else{

            if(\App\Models\FriendRequest::where(['user_id'=>Auth::user()->id,'friend_id'=>$user->id])->exists()){
        ?>
            <form action='{{ route('add_friend') }}' method="post">
                    @csrf
                    <div class="add-btn">
                    <span>1.3k followers</span>
                    <input type="hidden"value="{{ $user->id }}" name="friend_id">
                    <input type="hidden"value="cancel" name="cancel">
                    <button style="background-color:red;margin:30px 7px 35px 0px" type="submit"><i class="fas fa-window-close"></i> Cancel Request</button></div></form>
          <?php
            }elseif( \App\Models\FriendRequest::where(['user_id'=>$user->id,'friend_id'=>Auth::user()->id])->exists()){
            ?>
                    <form action='{{ route('add_friend') }}' method="post">
                    @csrf
                    <div class="add-btn">
                    <span>1.3k followers</span>
                    <input type="hidden"value="{{ $user->id }}" name="friend_id">
                    <input type="hidden"value="cancel" name="cancel">
                    <button style="background-color:red;margin:30px 7px 35px 0px" type="submit"><i class="fas fa-window-close"></i> Cancel Request </button></div></form>


                    <form action='{{ route('add_friend') }}' method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="add-btn">
                    <span>1.3k followers</span>
                    <input type="hidden"value="{{ $user->id }}" name="friend_id">
                    <input type="hidden"value="accept" name="accept">
                    <button style="background-color:green" type="submit"><i class="fas fa-user-check"></i> Accept Request</button>
                    </div>
                    </form>


            <?php
        }else{
         ?>
           <form action='{{ route('add_friend') }}' method="post" enctype="multipart/form-data">
                 @csrf
			     <div class="add-btn">
				 <span>1.3k followers</span>
                 <input type="hidden"value="{{ $user->id }}" name="friend_id">
                 <input type="hidden"value="add" name="add">
                <button type="submit"><i class="fas fa-user-plus"></i> Add Friend</button>
                </div>
                </form>
        <?php
              }
     }
        ?>


</div>


			<div class="container-fluid">
				<div class="row merged">
					<div class="col-lg-2 col-sm-3">
						<div class="user-avatar">
							<figure>
								<img style="min-height:164px;min-width:169px" src="{{ asset('assets/Users_Img/'.$user->img)}}" alt="" id="output">
							</figure>
						</div>
					</div>
					<div class="col-lg-10 col-sm-9">
						<div class="timeline-info">
							<ul>
								<li class="admin-name">
								  <h5>{{$user->name }}</h5>
								  <span style="left:0"> {{ $user->email }}</span>
								</li>
								<li style="margin-left: 130px;">
									<a class="active" id="ps_section" href="#"data-ripple="">Posts</a>
									<a class="" href="#"id="ps_photo"data-ripple="">Photos</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>

	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">
							<div class="col-lg-3">
								<aside class="sidebar static">

										<div class="widget stick-widget">
											<h4 class="widget-title">Edit info</h4>
											<ul class="naves">
												<li>
													<i class="ti-info-alt"></i>
													<a href="edit-profile-basic.html" title="">Basic info</a>
												</li>
												<li>
													<i class="ti-mouse-alt"></i>
													<a href="edit-work-eductation.html" title="">Education & Work</a>
												</li>
												<li>
													<i class="ti-heart"></i>
													<a href="edit-interest.html" title="">My interests</a>
												</li>
												<li>
													<i class="ti-settings"></i>
													<a href="edit-account-setting.html" title="">account setting</a>
												</li>

											</ul>
										</div><!-- settings widget -->

								</aside>
							</div><!-- sidebar -->


							<div class="col-lg-5" id="post_section">


                                {{-- POSTS --}}

								<div class="loadMore">
                               @if ($posts->count() == 0)

                              <div class="text-center mt-5">
                               <h2>There Is No Posts Yet</h2>
                              </div>

                              @else

                                @foreach ($posts as $post)


								<div class="central-meta item">
									<div class="user-post">
										<div class="friend-info">
											<figure>
												<img src="{{ asset('assets/Users_Img/' . $user->img) }}" alt="">
											</figure>
											<div class="friend-name">
												<ins><a href="{{ route('user_profile',$user->id) }}" title="">{{ $user->name }}</a></ins>
												<span>{{ $post->created_at }}</span>
											</div>
											<div class="post-meta">

												<div class="we-video-info">
													<ul>
														<li>
															<span class="comment" data-toggle="tooltip" title="Comments">
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
								<span class="like" title="like" id="like" onclick="likes({{ $post->id }})"data-postId="{{ $post->id }}">
                                        @php
                                        if(\App\Models\likes::where(['user_id'=> Auth::user()->id,'post_id'=>$post->id])->exists() ){
                                          echo'<i class="fas fa-heart" style="color:green;"></i>';
                                        }
                                        else{
                                          echo'<i class="far fa-heart" style="color:green;"></i>';
                                        }
                                        @endphp


										<ins id="likes-number" data-postId="{{ $post->id }}">{{ $post->likes }}</ins>
								</span>
							</li>

							<li>
								<span class="dislike" id="dislike" title="dislike"onclick="dislikes({{ $post->id }})"data-postId="{{ $post->id }}">
                                 @php
                                     if(\App\Models\dislikes::where(['user_id'=> Auth::user()->id,'post_id'=>$post->id])->exists()){
                                          echo'<i class="fas fa-heart-broken" style="color:red;"></i>';
                                        }
                                        else{
                                          echo'<i class="far fa-heart" style="color:red;"></i>';
                                        }
                                 @endphp

										<ins id="dislikes-number" data-postId="{{ $post->id }}">{{ $post->desliks }}</ins>
								</span>
							</li>

                                                     {{--share social-media --}}
														<li class="social-media">
															<div class="menu">
															  <div class="btn trigger"><i class="fa fa-share-alt"></i></div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-html5"></i></a></div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-facebook"></i></a></div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-google-plus"></i></a></div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-twitter"></i></a></div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-css3"></i></a></div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-instagram"></i></a>
																</div>
															  </div>
																<div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-dribbble"></i></a>
																</div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-pinterest"></i></a>
																</div>
															  </div>

															</div>
														</li>
                                                      {{-- end share social-media --}}

													</ul>
												</div>
                                        @if($post->file_name != null)
                                            <img src="{{ asset('assets/Posts_Img/' . $post->file_name) }}" alt="">
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
														<img style="height:40px;width:40px" src="{{ asset('assets/Users_Img/' . $comment->user->img) }}" alt="">
													</div>
													<div class="we-comment">
														<div class="coment-head">
															<h5><a href="{{ route('user_profile',$comment->user->id) }}" title="">{{ $comment->user->name }}</a></h5>
															<span>{{ $comment->created_at }}</span>
															<a class="we-reply"></a>
														</div>
														<p>{{ $comment ->content }}</p>
													</div>
												</li>

                                           @endforeach


												<li class="post-comment">
													<div class="comet-avatar">
														<img src="{{ asset('assets/Users_Img/'.Auth::user()->img)}}" alt="">
													</div>
													<div class="post-comt-box">
														<form method="post" action="{{ route('comment.store') }}">
                                                         {{ csrf_field() }}
                                                         <input type="hidden"name="post_id"value="{{ $post->id }}">
															<textarea name="content" placeholder="Post your comment" required></textarea>
															<div class="add-smiles">
																<button class="btn btn-Primary"style="background-color:#088dcd;color:snow" title="add icon">comment</button>
															</div>
														</form>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
                            @endforeach
                           @endif
		</div>
                    {{-- end POSTS --}}
</div><!-- centerl meta -->


 	<div class="col-lg-5 img_section" id="img_section">
						<div class="central-meta">
									<ul class="photos">
                                    @foreach ($posts as $post)
                                        @if($post->file_name != null)
                                          <li>
											<a class="strip" href="{{ asset('assets/Posts_Img/'.$post->file_name) }}" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">
												<img style="height:120px;width:120px"src="{{ asset('assets/Posts_Img/'.$post->file_name) }}" alt=""></a>
										</li>
                                        @endif
                            @endforeach
									</ul>
			</div><!-- photos -->
	</div><!-- centerl meta -->


							<div class="col-lg-3">
								<aside class="sidebar static">
									<div class="advertisment-box">
										<h4 class="">advertisment</h4>
										<figure>
											<a href="#" title="Advertisment"><img src="images/resources/ad-widget.jpg" alt=""></a>
										</figure>
									</div>

									<div class="widget friend-list stick-widget">
										<h4 class="widget-title">Friends</h4>
										<div id="searchDir"></div>
										<ul id="people-list" class="friendz-list">

                                        @foreach ($friends2 as $friend)

											<li>
												<figure>
													<img src="{{ asset('assets/Users_Img/' . $friend->user->img) }}" alt="">
													<span class="status f-online"></span>
												</figure>
												<div class="friendz-meta">
													<a href="time-line.html">{{ $friend->user->name}}</a>
													<i><a href="https://wpkixx.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1e6977706a7b6c6d71727a7b6c5e79737f7772307d7173">[email&#160;protected]</a></i>
												</div>
											</li>
                                        @endforeach
                                        @foreach ($friends1 as $friend)
											<li>
												<figure>
													<img src="{{ asset('assets/Users_Img/' . $friend->fri->img) }}" alt="">
													<span class="status f-online"></span>
												</figure>
												<div class="friendz-meta">
													<a href="time-line.html">{{ $friend->fri->name }}</a>
													<i><a href="https://wpkixx.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1e6977706a7b6c6d71727a7b6c5e79737f7772307d7173">[email&#160;protected]</a></i>
												</div>
											</li>
                                        @endforeach
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







