@extends('layouts.adminlte')

@section('title', $title)

@section('content_header')
    <h1>Nouvel utilisateur</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form method="post" action="{{ route('users.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nom <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="{{ Request::old('name') ?: '' }}" id="name" name="name" class="form-control col-md-7 col-xs-12">
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Courriel <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="{{ Request::old('email') ?: '' }}" id="email" name="email" class="form-control col-md-7 col-xs-12">
                                    @if ($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Mot de passe <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" value="{{ Request::old('password') ?: '' }}" id="password" name="password" class="form-control col-md-7 col-xs-12">
                                    @if ($errors->has('password'))
                                        <span class="help-block">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirm_password">Confirmer le mot de passe <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" value="{{ Request::old('confirm_password') ?: '' }}" id="confirm_password" name="confirm_password" class="form-control col-md-7 col-xs-12">
                                    @if ($errors->has('confirm_password'))
                                        <span class="help-block">{{ $errors->first('confirm_password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <!---  form input ---->
                            <div class="form-group {{ $errors->first('', 'has-error') }}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isAdmin">Est administrateur
                                </label>
                                <div class="col-md-7 col-xs-12">
                                    {{ Form::checkbox('isAdmin', true) }}
                                </div>
                            </div>

                            <div class="ln_solid"></div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop