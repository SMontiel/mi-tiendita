@extends('template')

@section('title', 'Registrar')

@section('content')
<div class="w-full flex justify-center p-4">
    <div class="w-1/4 rounded shadow-lg">
        <div class="">
            <div class="">
                <div class="p-4 rounded-t text-lg tracking-wide uppercase font-normal">{{ __('Regístrate') }}</div>

                <div class="p-4 rounded-b bg-grey-lightest">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="pb-2">
                            <label for="name" class="text-sm text-soft-black">{{ __('Nombre completo') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="focus:bg-grey-lighter leading-tight appearance-none w-full rounded h-8 border-2 border-primary-lightest form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="pb-2">
                            <label for="direccion" class="text-sm text-soft-black">{{ __('Dirección') }}</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="focus:bg-grey-lighter leading-tight appearance-none w-full rounded h-8 border-2 border-primary-lightest form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ old('direccion') }}" required autofocus>

                                @if ($errors->has('direccion'))
                                    <span class="" role="alert">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="py-2">
                            <label for="email" class="text-sm text-soft-black">{{ __('Correo electrónico') }}</label>

                            <div class="">
                                <input id="email" type="email" class="focus:bg-grey-lighter leading-tight appearance-none w-full rounded h-8 border-2 border-primary-lightest form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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

                        <div class="py-2">
                            <label for="password-confirm" class="text-sm text-soft-black">{{ __('Confirma contraseña') }}</label>

                            <div class="">
                                <input id="password-confirm" type="password" class="focus:bg-grey-lighter leading-tight appearance-none w-full rounded h-8 border-2 border-primary-lightest form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="">
                            <div class="border-t pt-2">
                                <button type="submit" class="rounded bg-primary px-4 py-2">
                                    {{ __('Registrar') }}
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
