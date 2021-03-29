<div class="modal" id="AddUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                </div><br>

                <div class="form-group row">
                    <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                    <div class="col-md-6">
                        <input id="age" type="number" min="1" max="100" class="form-control" name="age" value="{{ old('age') }}" required>
                    </div>
                </div><br>

                <div class="form-group row">
                    <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                    <div class="col-md-6">
                        <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                          <option value="M" selected>Male</option>
                          <option value="F">Female</option>
                        </select>                            
                    </div>
                </div><br>

                <div class="form-group row">
                    <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>

                    <div class="col-md-6">
                        <select class="form-select" aria-label="Default select example" name="rol" id="rol">
                          <option value="2" selected>User</option>
                          <option value="1">Admin</option>
                        </select>                            
                    </div>
                </div><br>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                </div><br>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                    </div>
                </div><br>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div><br>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitAddUserModal" style="margin-right: 20px">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>