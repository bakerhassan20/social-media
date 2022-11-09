@extends('layouts.master')

@section('content')




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
													<a  href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     {{ __('Logout') }}
                                                    </a>
		                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
												<figure>
                                                <a href="{{ route('user_profile',$user->id) }}" title=""><img src="{{ asset('assets/Users_Img/'.$user->img)}}" alt=""></figure>
												<div class="friend-meta">
													<h5>{{ $user->name }}</h5>
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
											<img  style="height:50px;width:50px" src="{{ asset('assets/Users_Img/'.Auth::user()->img)}}" alt="">
										</figure>
										<div class="newpst-input">
											<form method="post" action="{{route('post.store')}}">
                                             {{ csrf_field() }}
												<textarea name="desc" rows="2" placeholder="write something"></textarea>
												<div class="attachments">
													<ul>
														<li>
															<i class="fa fa-image"></i>
															<label class="fileContainer">
																<input type="file">
															</label>
														</li>
														<li>
															<i class="fa fa-video-camera"></i>
															<label class="fileContainer">
																<input type="file">
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
								<img src="{{ asset('assets/Users_Img/' .$post->users->img) }}" alt="">
											</figure>
											<div class="friend-name">
												<ins><a href="{{ route('user_profile',$post->users->id) }}" title="">
                                                {{ $post->users->name}}</a></ins>
												<span>published: june,2 2018 19:PM</span>
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
														<img style="height:45px;width:45px" src="{{ asset('assets/Users_Img/'. $comment->user->img)}}" alt="">
													</div>
													<div class="we-comment">
														<div class="coment-head">
															<h5><a href="time-line.html" title="">{{ $comment->user->name }}</a></h5>
															<span>{{ $comment->created_at }}</span>
															<a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
														</div>
														<p>{{ $comment->content }}</p>
													</div>

												</li>
                                            @endforeach

                                <li class="post-comment">
                                    <div class="comet-avatar">
                                            <img style="height:30px;width:30px" src="{{ asset('assets/Users_Img/' . Auth::user()->img) }}" alt="">
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
												<a href="#" title=""><img src="{{URL::asset('assets/images/resources/friend-avatar9.jpg')}}" alt=""></a>
											</figure>
											<div class="page-meta">
												<a href="#" title="" class="underline">My page</a>
												<span><i class="ti-comment"></i><a href="insight.html" title="">Messages <em>9</em></a></span>
												<span><i class="ti-bell"></i><a href="insight.html" title="">Notifications <em>2</em></a></span>
											</div>
											<div class="page-likes">
												<ul class="nav nav-tabs likes-btn">
													<li class="nav-item"><a class="active" href="#link1" data-toggle="tab">likes</a></li>
													 <li class="nav-item"><a class="" href="#link2" data-toggle="tab">views</a></li>
												</ul>
												<!-- Tab panes -->
												<div class="tab-content">
												  <div class="tab-pane active fade show " id="link1" >
													<span><i class="ti-heart"></i>884</span>
													  <a href="#" title="weekly-likes">35 new likes this week</a>
													  <div class="users-thumb-list">
														<a href="#" title="Anderw" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-1.jpg')}}" alt="">
														</a>
														<a href="#" title="frank" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-2.jpg')}}" alt="">
														</a>
														<a href="#" title="Sara" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-3.jpg')}}" alt="">
														</a>
														<a href="#" title="Amy" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-4.jpg')}}" alt="">
														</a>
														<a href="#" title="Ema" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-5.jpg')}}" alt="">
														</a>
														<a href="#" title="Sophie" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-6.jpg')}}" alt="">
														</a>
														<a href="#" title="Maria" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-7.jpg')}}" alt="">
														</a>
													  </div>
												  </div>
												  <div class="tab-pane fade" id="link2" >
													  <span><i class="ti-eye"></i>440</span>
													  <a href="#" title="weekly-likes">440 new views this week</a>
													  <div class="users-thumb-list">
														<a href="#" title="Anderw" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-1.jpg')}}" alt="">
														</a>
														<a href="#" title="frank" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-2.jpg')}}" alt="">
														</a>
														<a href="#" title="Sara" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-3.jpg')}}" alt="">
														</a>
														<a href="#" title="Amy" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-4.jpg')}}" alt="">
														</a>
														<a href="#" title="Ema" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-5.jpg')}}" alt="">
														</a>
														<a href="#" title="Sophie" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-6.jpg')}}" alt="">
														</a>
														<a href="#" title="Maria" data-toggle="tooltip">
															<img src="{{URL::asset('assets/images/resources/userlist-7.jpg')}}" alt="">
														</a>
													  </div>
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
													<a href="{{ route('user_profile',$user->id) }}"><img src="{{URL::asset('assets/Users_Img/' .$user->img) }}" alt="">
													<span class="status f-online"></span>
												</figure>
												<div class="friendz-meta">
													<a href="{{ route('user_profile',$user->id) }} ">{{ $user->name }}</a>
													<i><a href="{{ route('user_profile',$user->id) }}" class="__cf_email__" data-cfemail="a0d7c9ced4c5d2d3cfccc4c5d2e0c7cdc1c9cc8ec3cfcd">{{ $user->email }}</a></i>
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
