<div>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>
                        <div>
                            <a class="logo" href="index.html">
                                <img class="img-fluid for-light" src="/assets/images/logo/logo.png" alt="loginpage">
                                <img class="img-fluid for-dark" src="/assets/images/logo/logo_dark.png" alt="loginpage">
                            </a>
                        </div>
                        <div class="login-main">
                            <form class="theme-form "wire:submit='login'>
                                <h4>Sign in to account</h4>
                                <p>Enter your email & password to login</p>
                                @if (session()->has('success'))
                                    <div class="alert alert-success dark">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div id="error" wire:ignore></div>
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
                                        <input class="form-control @error('email') is-invalid @enderror" type="password"
                                            placeholder="*********" wire:model='password'>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox">
                                        <label class="text-muted" for="checkbox1">Remember password</label>
                                    </div>
                                    <a class="link" href="forget-password.html">Forgot password?</a>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit"
                                            wire:loading.attr='disabled'>
                                            Sign in
                                        </button>
                                    </div>
                                </div>
                                <h6 class="text-muted mt-4 or">Or Sign in with</h6>
                                <div class="social mt-4">
                                    <div class="btn-showcase" wire:ignore>
                                        <a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank">
                                            <i class="txt-linkedin" data-feather="linkedin"></i>
                                            Google
                                        </a>
                                    </div>
                                </div>
                                <p class="mt-4 mb-0 text-center">
                                    Don't have account?
                                    <a class="ms-2" href="{{ route('auth.register') }}">
                                        Create Account
                                    </a>
                                </p>
                            </form>
                        </div>
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
