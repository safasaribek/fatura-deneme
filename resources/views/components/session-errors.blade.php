<div class="my-3">
    @if ($errors->any())
        <div class="bg-primary-100 border border-primary-400 text-primary-700 px-4 py-3 rounded relative"
             role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
             role="alert">
            <ul>
                <li>{{ \Illuminate\Support\Facades\Session::get('success') }}</li>
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-primary-100 border border-primary-400 text-primary-700 px-4 py-3 rounded relative"
             role="alert">
            {{ session('error') }}
        </div>
    @endif
</div>
