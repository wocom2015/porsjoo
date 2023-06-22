@if ($message = Session::get('success'))
    <div class="alert alert-success fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">{{ $message }}</div>
    </div>

@endif



@if ($message = Session::get('error'))


    <div class="alert alert-custom alert-danger fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">{{ $message }}</div>

    </div>

@endif



@if ($message = Session::get('warning'))
    <div class="alert alert-custom alert-warning fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">{{ $message }}</div>

    </div>

@endif



@if ($message = Session::get('info'))

    <div class="alert alert-custom alert-primary fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">{{ $message }}</div>

    </div>

@endif



@if ($errors->any())
    <div class="alert alert-danger">
        <strong>لطفا موارد زیر را تکمیل نمایید:</strong>
        <ul class="mr-5 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif
