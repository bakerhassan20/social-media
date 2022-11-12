{{--  wire:poll  --}}
 <div>

                                                <div class="chat-head">
                                                    <span class="status f-online"></span>
                                                    <h6>{{ $user_info->name }}</h6>
                                                    <div class="more">
                                                        <span class="more-optns"><i class="ti-more-alt"></i>
                                                            <ul>
                                                                <li>block chat</li>
                                                                <li>unblock chat</li>
                                                                <li>conversation</li>
                                                            </ul>
                                                        </span>
                                                        <span class="close-mesage"><i class="ti-close"></i></span>
                                                    </div>
                                                </div>
                                                <div class="chat-list">
                                                    <ul id="chat" style="margin-botton:20px" class="ps-container ps-theme-default ps-active-y" data-ps-id="a4ff9a09-ac31-3d5c-e28e-f9549cac0d68">

                            @forelse ($messages as $message)
                                @if ($message->user_id_send == auth()->user()->id)

                                    <li class='me'>
                                     <div class='d-flex justify-content-end'>
                                        <div class='msg_cotainer_send'>{{ $message->message_text }}</div>
                                     </div>
                                    </li>
                                @else
                                        <li class='you'>
                                            <div class='d-flex justify-content-start'>
                                                <div class='msg_cotainer'>{{ $message->message_text }}</div>
                                            </div>
                                        </li>

                                @endif

                            @empty
                                <h5 style="text-align: center;color:red"> لاتوجد رسائل سابقة</h5>
                            @endforelse

                                    </ul>
                        <form wire:submit.prevent="sendMessage">
                            <div class="row">
                                <div class="col-10">
	                               <input type="text" class="form-control" placeholder="Typing...."
                                     wire:model.defer="messageText"required>
                                </div>
                                <div class="col-1" style="">
								<button type="submit" class="btn btn-primary ">
								<i class="far fa-paper-plane" aria-hidden="true"></i>
								</button>
                                </div>
                                </div>
                        </form>
                </div>

</div>
