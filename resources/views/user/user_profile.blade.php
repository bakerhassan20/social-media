@extends('layouts.master')

@section('content')
	<section>

		<div class="feature-photo">
			<figure><img  id="output2" style="height:400px;min-width:1366px"src="{{ asset('assets/Users_Img/'.$user->cover_img)}}"alt=""></figure>


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
                    <button style="background-color:red;margin:30px 7px 35px 0px" type="submit"><i class="fas fa-window-close"></i> Cancel Request</button><br></div></form>
          <?php
            }elseif( \App\Models\FriendRequest::where(['user_id'=>$user->id,'friend_id'=>Auth::user()->id])->exists()){
            ?>
                    <form action='{{ route('add_friend') }}' method="post">
                    @csrf
                    <div class="add-btn">
                    <span>1.3k followers</span>
                    <input type="hidden"value="{{ $user->id }}" name="friend_id">
                    <input type="hidden"value="cancel" name="cancel">
                    <button style="background-color:red;margin:30px 7px 35px 0px" type="submit"><i class="fas fa-window-close"></i> Cancel Request</button><br></div></form>


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
								<li>
									<a class="active" href="fav-page.html" title="" data-ripple="">Page</a>
									<a class="" href="notifications.html" title="" data-ripple="">Notifications</a>
									<a class="" href="inbox.html" title="" data-ripple="">inbox</a>
									<a class="" href="insights.html" title="" data-ripple="">insights</a>
									<a class="" href="fav-page.html" title="" data-ripple="">posts</a>
									<a class="" href="page-likers.html" title="" data-ripple="">likers</a>
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

									<div class="widget">
										<h4 class="widget-title">Shortcuts</h4>
										<ul class="naves">
											<li>
												<i class="ti-clipboard"></i>
												<a href="newsfeed.html" title="">News feed</a>
											</li>
											<li>
												<i class="ti-mouse-alt"></i>
												<a href="inbox.html" title="">Inbox</a>
											</li>
											<li>
												<i class="ti-files"></i>
												<a href="fav-page.html" title="">My pages</a>
											</li>
											<li>
												<i class="ti-user"></i>
												<a href="timeline-friends.html" title="">friends</a>
											</li>
											<li>
												<i class="ti-image"></i>
												<a href="timeline-photos.html" title="">images</a>
											</li>
											<li>
												<i class="ti-video-camera"></i>
												<a href="timeline-videos.html" title="">videos</a>
											</li>
											<li>
												<i class="ti-comments-smiley"></i>
												<a href="messages.html" title="">Messages</a>
											</li>
											<li>
												<i class="ti-bell"></i>
												<a href="notifications.html" title="">Notifications</a>
											</li>
											<li>
												<i class="ti-share"></i>
												<a href="people-nearby.html" title="">People Nearby</a>
											</li>
											<li>
												<i class="fa fa-bar-chart-o"></i>
												<a href="insights.html" title="">insights</a>
											</li>
											<li>
												<i class="ti-power-off"></i>
												<a href="landing.html" title="">Logout</a>
											</li>
										</ul>
									</div><!-- Shortcuts -->


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
												<li>
													<i class="ti-lock"></i>
													<a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">change password</a>

												</li>
											</ul>
										</div><!-- settings widget -->

								</aside>
							</div><!-- sidebar -->


							<div class="col-lg-6">


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
												<ins><a href="time-line.html" title="">{{ $user->name }}</a></ins>
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
															<h5><a href="time-line.html" title="">{{ $comment->user->name }}</a></h5>
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
															<div class="smiles-bunch">
																<i class="em em---1"></i>
																<i class="em em-smiley"></i>
																<i class="em em-anguished"></i>
																<i class="em em-laughing"></i>
																<i class="em em-angry"></i>
																<i class="em em-astonished"></i>
																<i class="em em-blush"></i>
																<i class="em em-disappointed"></i>
																<i class="em em-worried"></i>
																<i class="em em-kissing_heart"></i>
																<i class="em em-rage"></i>
																<i class="em em-stuck_out_tongue"></i>
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
							<div class="col-lg-3">
								<aside class="sidebar static">
									<div class="advertisment-box">
										<h4 class="">advertisment</h4>
										<figure>
											<a href="#" title="Advertisment"><img src="images/resources/ad-widget.jpg" alt=""></a>
										</figure>
									</div>

									<div class="widget">
										<h4 class="widget-title">Invite friends</h4>
										<ul class="invition">
											<li>
												<figure><img src="images/resources/friend-avatar8.jpg" alt=""></figure>
												<div class="friend-meta">
													<h4><a href="time-line.html" class="underline" title="">Sophia hayat</a></h4>
													<a href="#" title="" class="invite" data-ripple="">invite</a>
												</div>
											</li>
											<li>
												<figure><img src="images/resources/friend-avatar4.jpg" alt=""></figure>
												<div class="friend-meta">
													<h4><a href="time-line.html" class="underline" title="">Issabel kaif</a></h4>
													<a href="#" title="" class="invite" data-ripple="">invite</a>
												</div>
											</li>
											<li>
												<figure><img src="images/resources/friend-avatar2.jpg" alt=""></figure>
												<div class="friend-meta">
													<h4><a href="time-line.html" class="underline" title="">Kelly Bill</a></h4>
													<a href="#" title="" class="invite" data-ripple="">invite</a>
												</div>
											</li>
											<li>
												<figure><img src="images/resources/friend-avatar3.jpg" alt=""></figure>
												<div class="friend-meta">
													<h4><a href="time-line.html" class="underline" title="">Allen jhon</a></h4>
													<a href="#" title="" class="invite" data-ripple="">invite</a>
												</div>
											</li>
											<li>
												<figure><img src="images/resources/friend-avatar6.jpg" alt=""></figure>
												<div class="friend-meta">
													<h4><a href="time-line.html" class="underline" title="">tom Andrew</a></h4>
													<a href="#" title="" class="invite" data-ripple="">invite</a>
												</div>
											</li>

											<li>
												<figure><img src="images/resources/friend-avatar3.jpg" alt=""></figure>
												<div class="friend-meta">
													<h4><a href="time-line.html" title="" class="underline">Allen doe</a></h4>
													<a href="#" title="" class="invite" data-ripple="">invite</a>
												</div>
											</li>
										</ul>
									</div><!-- invite for page  -->



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







