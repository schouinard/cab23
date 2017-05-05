@extends('layouts.adminlte')

@section('title', 'Gestion des utilisateurs')

@section('content_header')
    <h1>Utilisateurs</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Filtres</h3>
                    <div class="box-tools pull-right">
                        <!-- This will cause the box to collapse when clicked -->
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <form action="" method="get">
                        <div class="form-group col-md-3">
                            {{ Form::label('statut', 'Statut:') }}
                            {{ Form::select('statut', ['Inactifs' => 'Inactifs', 'Tous' => 'Tous'],request('statut'), ['class' => 'form-control', 'placeholder' => 'Actifs']) }}
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-primary" value="Filtrer"/>
                            <a href="/benevoles" class="btn btn-primary">Effacer les filtres</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body table-responsive">
                    <table class="datatable table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Courriel</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><a href="{{ $user->path() }}">{{ $user->name }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->isAdmin)
                                        Admin
                                    @else
                                        Accueil
                                    @endif
                                </td>
                                <td>
                                    {{ $user->trashed() ? 'Inactif' : 'Actif' }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop