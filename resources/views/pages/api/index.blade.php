@extends('layout.app')

@section('main_title')
    <title>Berapiapi 🔥 | Api Key</title>
@endsection

@section('page_title')
    <h4 class="f-w-700">Api Key</h4>
@endsection

@section('breadcrumb')
    <nav>
        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> <i data-feather="home"> </i></a></li>
            <li class="breadcrumb-item f-w-400">Api Key</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="col-12 col-md-12">
        <div class="card common-hover">
            <div class="card-header border-r-secondary">
                <h4>Api Key</h4>
                <p class="mt-1 f-m-light">Start using our application from generate your <code>own Api Key</code></p>
            </div>
            <div class="card-body">
                <p>
                    Our Api Key are <strong>Unique</strong> among users and your Api Key are <strong>NOT STORING</strong>
                    into our database for security reason. Thats why you should store your own Api Key into safe place.
                </p>
                <p>You may regenerate your Api Key anytime using this form, but remember once you regenerate after make key,
                    you <strong>cannot use old Api Key</strong> anymore!
                </p>
                <div class="accordion dark-accordion" id="simpleaccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed bg-light-primary txt-primary active" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                How to generate Api Key ?
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-down svg-color">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="collapseOne" aria-labelledby="headingOne"
                            data-bs-parent="#simpleaccordion">
                            <div class="accordion-body">
                                <p>1. Fill your account password below</p>
                                <p>2. Click <strong>Generate</strong> Button</p>
                                <p>3. Copy your <strong>Api Key</strong> into safe place</p>
                                <p>4. Thats it! You ready to go</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12">
        @livewire('form.api.generate')
    </div>
@endsection

@section('js')
    <script>
        function copyApiKey() {
            // Dapatkan elemen input dengan ID 'apiKey'
            var copyText = document.getElementById("apiKey");

            // Pilih teks dari input
            copyText.select();
            copyText.setSelectionRange(0, 99999); // Untuk perangkat mobile

            // Salin teks ke clipboard
            document.execCommand("copy");

            // Tampilkan pesan sukses (opsional)
            alert("Api Key copied: " + copyText.value);
        }
    </script>
@endsection
