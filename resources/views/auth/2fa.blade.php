@extends('auth.template')

@section('page-title')
    Two Factor Authentication
@endsection

@section('login-body')

    <form method="POST" action="{{ route('login::post') }}">

        {!! csrf_field() !!}

        <div class="form-group">
            <input type="text" class="form-control" id="code" name="2fa_totp_token"
                   placeholder="Enter Time Based Auth Token">
        </div>

        <button type="submit" class="btn btn-default" style="width: 100%;">Submit</button>

    </form>
@endsection