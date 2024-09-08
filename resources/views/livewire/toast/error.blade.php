<div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3 toast-index toast-rtl" wire:ignore.self>
        <div class="toast" id="liveToast4" role="alert" aria-live="polite" aria-atomic="true">
            <div class="d-flex justify-content-between align-items-center alert-light-danger">
                <div class="toast-body">A database connection error has occurred
                </div>
                <button class="btn-close" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    @script
        <script>
            $wire.on('error', () => {
                const toastLiveExample4 = document.getElementById("liveToast4");
                const toast = new bootstrap.Toast(toastLiveExample4);

                toast.show();
            })
        </script>
    @endscript
</div>
