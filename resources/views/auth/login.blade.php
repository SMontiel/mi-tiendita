@extends('template')

@section('title', 'Login')

@section('content')
<div class="w-full flex justify-center p-4">
    <div class="w-1/4 rounded shadow-lg">
        <div class="">
            <div class="">
                <div class="p-4 rounded-t text-lg tracking-wide uppercase font-normal">{{ __('Login') }}</div>

                <div class="p-4 rounded-b bg-grey-lightest">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="pb-2">
                            <label for="email" class="text-sm text-soft-black">{{ __('Correo electrónico') }}</label>

                            <div class="">
                                <input id="email" type="email" class="focus:bg-grey-lighter leading-tight appearance-none w-full rounded h-8 border-2 border-primary-lightest form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="py-2">
                            <label for="password" class="text-sm text-soft-black">{{ __('Contraseña') }}</label>

                            <div class="">
                                <input id="password" type="password" class="focus:bg-grey-lighter leading-tight appearance-none w-full rounded h-8 border-2 border-primary-lightest form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="">
                            <div class="">
                                <div class="">

                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="border-t pt-2">
                                <button type="submit" class="rounded bg-primary px-4 py-2">
                                    {{ __('Login') }}
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
