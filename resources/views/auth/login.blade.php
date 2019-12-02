@extends('auth.contenido')

@section('login')
<div class="d-flex justify-content-center h-100">
    <div class="user_card">
        <div class="d-flex justify-content-center">
            <div class="brand_logo_container">
                <img src="{{ asset('img/crecer.png') }}" class="brand_logo" alt="Logo">
            </div>
        </div>
        <div class="d-flex justify-content-center form_container">
            <form class="form-horizontal"  method="POST" action="{{ route('access')}}">
                {{ csrf_field() }}

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="usuario" id="usuario" class="form-control input_user{{$errors->has('usuario' ? 'is-invalid' : '')}}" value="{{old('usuario')}}" placeholder="usuario">
                    {!!$errors->first('usuario','<span class="invalid-feedback" style="display:block">:message</span>')!!}
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password" id="password" class="form-control input_pass{{$errors->has('usuario' ? 'is-invalid' : '')}}" value="" placeholder="clave">
                    {!!$errors->first('usuario','<span class="invalid-feedback" style="display:block">:message</span>')!!}
                </div>

                <div class="d-flex justify-content-center mt-3 login_container">
                    <button type="submit" name="button" class="btn login_btn">INGRESAR AL SISTEMA</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
