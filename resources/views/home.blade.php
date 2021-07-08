@extends('layouts.app')
<title>Sanad | Home</title>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
				<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> Language 
				<span class="caret"></span>
				</a>
				<div class="dropdown-menu">
				<a class="dropdown-item" href="/lang/en">English</a>
				<a class="dropdown-item" href="/lang/ar">Arabic</a>
				</div>
 			
                <div class="card-header">{{ __('language.dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
