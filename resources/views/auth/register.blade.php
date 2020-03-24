@extends('layouts.app')

@section('login-content')
<div class="container">
    <div id="homeLeftBox" class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form class="needs-validation" novalidate method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Aggiunto campo inserimento nome -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" minlength="3" maxlength="20" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="text-transform:capitalize">
                                <div class="name valid-feedback">
                                    Inserimento corretto!
                                </div>
                                <div class="name invalid-feedback">
                                    Inserisci un nome valido - min 3 caratteri
                                </div>
                            </div>
                        </div>

                        <!-- Aggiunto campo inserimento cognome -->
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" minlength="3" maxlength="20" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus style="text-transform: capitalize">
                                <div class="surname valid-feedback">
                                    Inserimento corretto!
                                </div>
                                <div class="surname invalid-feedback">
                                    Inserisci un nome valido - min 3 caratteri
                                </div>

                            </div>
                        </div>

                        <!-- Aggiunto campo inserimento data di nascita -->
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" autofocus>
                                <div class="date valid-feedback">
                                    Inserimento corretto!
                                </div>
                                <div class="date invalid-feedback">
                                    Devi avere almeno 18 anni
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  {{-- onclick="validateEmail('#email')"--}} >
                                <div class="mail valid-feedback">
                                    Inserimento corretto!
                                </div>
                                <div class="mail invalid-feedback">
                                    Inserisci una mail corretta
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" minlength="8" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <div class="valid-feedback">
                                    Inserimento corretto!
                                </div>
                                <div class="invalid-feedback">
                                    Inserisci una password valida
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
