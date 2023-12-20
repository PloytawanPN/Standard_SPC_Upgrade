<div>
    <div class="login_body">
        <div class="container_login">
            <div class="signin-container">
                <div class="form">
                    <h1>Sign in</h1>
                    <div class="input-field">
                        <label class="label">username</label>
                        <div class="icon">
                            <box-icon name="user"></box-icon>
                        </div>
                        <input placeholder="username" type="text" name="username" wire:model.live='username' />
                        <div class="underline"></div>
                        @error('username')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <label>password</label>
                        <div class="icon">
                            <box-icon name="lock-alt"></box-icon>
                        </div>
                        <input placeholder="password" type="password" name="password" wire:model.live='password' />
                        <div class="underline"></div>
                        @error('password')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <button wire:click='sign_in'>SIGN IN</button>
                    <a id="myBtn">Forgot your password?</a>
                </div>
            </div>
            <div class="signup-container">
                <div class="p-field">
                    <h1>Welcome to SPC!</h1>
                    <p>Enter your personal detail and start journey with us</p>
                    <button id="sign_up" wire:click='re_signun'>SIGN UP</button>
                </div>
                <div class="box_1"></div>
                <div class="box_2"></div>
                <div class="box_3"></div>
            </div>
        </div>
    </div>
</div>
