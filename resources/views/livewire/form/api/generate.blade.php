<div>
    <div class="card common-hover">
        <div class="card-body">
            <div id="error" wire:ignore></div>
            <form wire:submit='generate'>
                <label class="form-label" for="password">Your Account Password</label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="******"
                    wire:model='password'>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="d-flex justify-content-between mt-3">
                    @if ($generatedAt)
                        <small><i>Key Generated At : <b>{{ $generatedAt }}</b></i></small>
                    @endif
                    <button class="btn btn-primary" type="submit" wire:loading.attr='disabled'>
                        {{ $buttonText }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($showApi)
        <div class="card common-hover bg-success">
            <div class="card-body">
                <label class="form-label" for="password">Congratulations! This is your new Api Key</label>
                <input type="text" id="apiKey" class="form-control" value='{{ $apiKey }}' readonly>
                <p class="mt-2" style="cursor: pointer;" onclick="copyApiKey()"><i><u>Click here to copy</i></u></p>
            </div>
        </div>
    @endif

    @script
        <script>
            $wire.on('error', (message) => {
                $('#error').html(`
                <div class="alert alert-danger dark mb-3" role="alert">
                    ` + message + `
                </div>
            `);
            })
        </script>
    @endscript
</div>
