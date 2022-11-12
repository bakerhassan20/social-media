@extends('layouts.master')

@section('content')
	<section>

<div class="feature-photo">
	<figure>
        <img  id="output2" style="height:400px;min-width:1366px"src="{{ asset('assets/Users_Img/'.Auth::user()->cover_img)}}"alt="">
    </figure>
    <form action="{{route('updateimage')}}" method="post" enctype="multipart/form-data">
        @csrf
		<div class="add-btn">
		    <span>1.3k followers</span>
				<button type="submit">Save Photos</button>
		</div>
		<div class="edit-phto">
			<i class="fa fa-camera-retro"></i>
			<label class="fileContainer">
				Edit Cover Photo
			   <input type="file" name="cover_image" id="customFiles"onchange="loadFilecover(event)"/>

			</label>
	    </div>
		<div class="container-fluid">
			<div class="row merged">
				<div class="col-lg-2 col-sm-3">
					<div class="user-avatar">
					    <figure>
							<img style="min-height:164px;min-width:169px" src="{{ asset('assets/Users_Img/'.Auth::user()->img)}}" alt="" id="output">
						    <div class="edit-phto">
							    <i class="fa fa-camera-retro"></i>
							    <label class="fileContainer">Edit Display Photo
					                <input type="file" name="image" id="customFile"onchange="loadFile(event)"/>
                                </label>
                            </div>
						</figure>
        </form>


						</div>
					</div>
			    <div class="col-lg-10 col-sm-9">
						<div class="timeline-info">
							<ul>
								<li class="admin-name">
								  <h5>{{ Auth::user()->name }}</h5>
								  <span style="left:0"> {{ Auth::user()->email }}</span>
								</li>
								<li style="margin-left: 160px;">
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
												<li>
													<i class="ti-lock"></i>
													<a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">change password</a>

												</li>
											</ul>
										</div><!-- settings widget -->

								</aside>
							</div><!-- sidebar -->


<div class="col-lg-5" id="post_section">
	<div class="central-meta">
		<div class="new-postbox">
			<figure>
			<img style="height:50px;width:50px" src="{{ asset('assets/Users_Img/' . Auth::user()->img) }}" alt="">
			</figure>
			<div class="newpst-input">
				<form method="post" action="{{route('post.store')}}"enctype="multipart/form-data">
                    {{ csrf_field() }}
						<textarea rows="3" name="desc" placeholder="write something" required></textarea>
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
					<button type="submit">Publish</button>
				</li>
			</ul>
		</div>
				</form>
			</div>
	</div>
</div><!-- add post new box -->



                                {{-- POSTS --}}

<div class="loadMore" >
    @foreach ($posts as $post)
		<div class="central-meta item">
		    <div class="user-post">
				<div class="friend-info">
					<figure>
						<img src="{{ asset('assets/Users_Img/' . Auth::user()->img) }}" alt="">
					</figure>
				<div class="friend-name">
				<ins><a href="{{ route('profile') }}" title="">{{ Auth::user()->name }}</a></ins>
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
			<img style="height:40px;width:40px" src="{{ asset('assets/Users_Img/' .$comment->user->img) }}" alt="">
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
                        <img src="{{ asset('assets/Users_Img/' . Auth::user()->img) }}" alt="">
                    </div>
                    <div class="post-comt-box">
                        <form method="post" action="{{ route('comment.store') }}">
                            {{ csrf_field() }}
                            <input type="hidden"name="post_id"value="{{ $post->id }}">
                            <textarea name="content" placeholder="Post your comment" required></textarea>
                            <div class="add-smiles">
                                <button class="btn btn-Primary"style="background-color:#088dcd;color:snow" title="add icon">
                                    comment
                                </button>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
			</div>
		</div>
	</div>
@endforeach
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
									<div class="widget friend-list stick-widget">
										<h4 class="widget-title">Friends</h4>
										<div id="searchDir"></div>
									<ul id="people-list" class="friendz-list">
									@if($friends != null)
                                        @foreach ($friends as $user )
                                        <li>
											<figure>
												<a href="{{ route('user_profile',$user->id) }}">
                                                <img src="{{URL::asset('assets/Users_Img/' .$user->img) }}" alt="">
												<span class="status f-online"></span>
											</figure>
											<div class="friendz-meta">
												<a href="{{ route('user_profile',$user->id) }} ">{{ $user->name }}</a>
												<i><a href="{{ route('user_profile',$user->id)}}" class="__cf_email__">{{ $user->email }}</a></i>
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







