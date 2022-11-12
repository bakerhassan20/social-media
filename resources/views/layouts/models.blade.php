<!-- Message Modal -->
<!-- Modal -->
{{-- <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a> --}}
<div class="modal  fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style=" position: abslute;z-index:10">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"style="border:none;margin-top:20px">
        <h5 class="f-title"><i class="ti-lock"></i>Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"style="padding-top:0px">

		<form action="{{route('update_password')}}" method="post">
            {{ csrf_field() }}
			<div class="form-group">
				<input type="password" id="input"id="passwordNew"name='new_password' required/>
				<label class="control-label" for="input">New password</label><i class="mtrl-select"></i>
			</div>
            @error('new_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
			<div class="form-group">
				<input type="password" id="passwordRe" name='new_password_confirmation' required/>
				<label class="control-label" for="input">Confirm password</label><i class="mtrl-select"></i>
			</div>
            @error('new_password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
			<div class="form-group">
				<input type="password" id="passwordOld" name='old_password' required/>
				<label class="control-label" for="input">Current password</label><i class="mtrl-select"></i>
			</div>
              @error('old_password')
              <span class="text-danger">{{ $message }}</span>
               @enderror
            <a class="forgot-pwd underline" title="" href="#">Forgot Password?</a>

			<div class="submit-btns">
				<button  class="mtr-btn"data-bs-dismiss="modal"><span>Cancel</span></button>
				<button type="submit" class="mtr-btn"><span>Update</span></button>
			</div>
		</form>


      </div>
    </div>
  </div>
</div>
<!-- modal -->
