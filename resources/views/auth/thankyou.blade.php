@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center">
                        {{ __('Thank you for registering!') }}
                    </div>
                    <br/>
                    <div class="text-center">
                        <a href="{{ route('home') }}">
                            <input type="button" value="Continue" class="btn btn-primary" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
