@extends('layouts.app')

@section("page_404")

        <div class="container-fluid">
            <div class="row justify-content-center">
                <section id="error">
                	<div class="content text-center">
                		<i class="fas fa-exclamation-triangle fa-9x mb-3"></i>
                		<h1>404</h1>
                		<p>{{__('404_tras.Alert')}}</p>
                		<a class="btn btn-success mt-3" href="{{ route('home') }}">{{__('404_tras.Button')}}</a>
                	</div>
                </section>
        	</div>
            </div>
        </div>

@endsection
