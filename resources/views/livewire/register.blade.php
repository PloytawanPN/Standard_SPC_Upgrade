<div>
    
    <div class="register_body">
        <div class="container_register">
            <div class="signin-container">
                <div class="p-field">
                    <h1>Welcome Back!</h1>
                    <p>
                        To keep connected with us please login with your personal info
                    </p>
                    <button id="sign_up" wire:click='re_login'>SIGN IN</button>
                    <div class="box_1"></div>
                    <div class="box_2"></div>
                    <div class="box_3"></div>
                </div>
            </div>
            <div class="signup-container">
                <div class="form">
                    <h1>Sign up</h1>
                    <div class="custom-select">
                        <div class="icon_select">
                            <box-icon name='buildings'></box-icon>
                        </div>
                        <select wire:model.lazy='department'>
                            <option value="" selected hidden>Department</option>
                            @foreach ($department_all as $dep)
                                <option value={{ $dep->department }}>{{ $dep->department }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <div class="icon">
                            <box-icon name="grid-alt"></box-icon>
                        </div>
                        <input name="employee_id" placeholder="Employee ID" type="text"
                            wire:model.live='employee_id' />
                        <div class="underline"></div>
                        @error('employee_id')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <div class="icon">
                            <box-icon name="user"></box-icon>
                        </div>
                        <input name="username" placeholder="username" style="text-transform: capitalize;" type="text"
                            wire:model.live='username' />
                        <div class="underline"></div>
                        @error('username')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <div class="icon">
                            <box-icon name="lock-alt"></box-icon>
                        </div>
                        <input name="password" placeholder="password" type="password" wire:model.live='password' />
                        <div class="underline"></div>
                        @error('password')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <div class="icon">
                            <box-icon name="revision"></box-icon>
                        </div>
                        <input name="confirmpassword" placeholder="confirm password" type="password"
                            wire:model.live='confirm_password' />
                        <div class="underline"></div>
                        @error('confirm_password')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <button wire:click='register'>REGISTER</button>
                </div>
            </div>
        </div>
    </div>
</div>
