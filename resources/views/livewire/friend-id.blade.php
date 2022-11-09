<div>






<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-3">
								<aside class="sidebar static">
                                     <div class="widget friend-list stick-widget">
                                    <!-- main-sidebar -->
                                           <div class="fixed-sidebar right">
                                                <div class="chat-friendz">


                                            <ul class="chat-users ps-container ps-theme-default ps-active-y" data-ps-id="c0656fb0-bc73-670e-a210-4dc757da0c8d">
                                            @php
                                            $friend1 = collect();
                                            $friend2 = collect();
                                            $friends1 =\App\Models\Friends::where('user_id',Auth::user()->id)->get('friend_id');
                                            $friends2 =\App\Models\Friends::where('friend_id',Auth::user()->id)->get('user_id');
                                            foreach($friends1 as $friend){
                                                $fr1 = \App\Models\User::where('id',$friend->friend_id)->first();
                                                $friend1->add($fr1);
                                            }
                                            foreach($friends2 as $friend){
                                                $fr2 = \App\Models\User::where('id',$friend->user_id)->first();
                                                 $friend2->add($fr2);
                                                }

                                            if(isset($friend1)&&isset($friend2)){$friend = $friend1->merge($friend2);}
                                            elseif(!isset($friend1)&&isset($friend2)){$friend = $friend2;}
                                            elseif(isset($friend1)&&!isset($friend2)){$friend = $friend1;}
                                            else{$friend=null;}
                                            @endphp
                                            @if($friend != null)
                                            @foreach ($friend as $user )
                                                <li>
                                                    <div class="author-thmb">
                                                        <img wire:click="addTodo({{$user->id}})"style="height:50px;width:50px" src="{{URL::asset('assets/Users_Img/' .$user->img) }}" alt="">
                                                        <span class="status f-online"></span>
                                                    </div>
                                                </li>
                                            @endforeach
                                            @endif

                                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 527px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 467px;"></div></div>
                                            </ul>

                                           </div>


                                    <!-- main-sidebar -->
									  </div>
								   </aside>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
	</section>

</div>
