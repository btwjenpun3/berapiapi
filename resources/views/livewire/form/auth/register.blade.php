<div>
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div><a class="logo" href="index.html"><img class="img-fluid for-light"
                                src="/assets/images/logo/logo.png" alt="looginpage"><img class="img-fluid for-dark"
                                src="/assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
                    <div class="login-main">
                        <form class="theme-form" wire:submit='submit'>
                            <h4>Create your account</h4>
                            <p>Enter your personal details to create account</p>
                            <div id="error" wire:ignore></div>
                            <div class="form-group">
                                <label class="col-form-label pt-0">Your Name</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input class="form-control @error('firstName') is-invalid @enderror"
                                            type="text" placeholder="First name" wire:model='firstName'>
                                        @error('firstName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control @error('lastName') is-invalid @enderror"
                                            type="text" placeholder="Last name" wire:model='lastName'>
                                        @error('lastName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Email Address</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                    placeholder="your@email.com" wire:model='email'>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <div class="form-input position-relative">
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        placeholder="*********" wire:model='password'>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password Confirmation</label>
                                <div class="form-input position-relative">
                                    <input class="form-control @error('passwordConfirmation') is-invalid @enderror"
                                        type="password" placeholder="*********" wire:model='passwordConfirmation'>
                                    @error('passwordConfirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox p-0">
                                    <input id="checkbox1" type="checkbox">
                                    <label class="text-muted" for="checkbox1">
                                        Agree with
                                        <a class="ms-2" href="#">Privacy Policy</a>
                                    </label>
                                </div>
                                <button class="btn btn-primary btn-block w-100" type="submit">
                                    Create Account
                                </button>
                            </div>
                            <h6 class="text-muted mt-4 or">Or signup with</h6>
                            <div class="social mt-4">
                                <div class="btn-showcase" wire:ignore>
                                    <a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank">
                                        <i class="txt-linkedin" data-feather="linkedin"></i>
                                        Google
                                    </a>
                                </div>
                                <p class="mt-4 mb-0">
                                    Already have an account?
                                    <a class="ms-2" href="{{ route('auth.login') }}">
                                        Sign in
                                    </a>
                                </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @script
        <script>
            $wire.on('error', (message) => {
                $('#error').html(`
                <div class="alert alert-danger dark" role="alert">
                    ` + message + `
                </div>
            `);
            })
        </script>
    @endscript
</div>
