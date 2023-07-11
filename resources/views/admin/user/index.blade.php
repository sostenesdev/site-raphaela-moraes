@extends('layouts.admin')

@section('title', 'Usuários')
@section('content')
<!-- alert message -->
@if(isset($message))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @else
        @if(isset($error_message))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <strong>{{$error_message}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
@endif
<div class="row">
    <div class="card">
        <div class="card-title">
            <h4>Usuários</h4>
        </div> <!-- end card title -->
        <div class="card-body">
            @if($currentRouteName == 'admin.user.edit')
            <!-- multipart formdata -->
            <form method="post" action="{{ route('admin.user.update') }}"
                enctype="multipart/form-data">
            @else
                <form method="post" action="{{ route('admin.user.save') }}"
                    enctype="multipart/form-data">
        @endif
        @csrf
        <!-- id hidden -->
        <input type="hidden" name="id"
            value="{{ isset($user->id)? $user->id : "" }}" />
            <div class="row">
                <div class="col col-md-6">
                    <label class="form-label">Nome</label>
                    <input class="form-control form-control-lg" type="text" name="name"
                    value="{{ isset($user->name)? $user->name : "" }}" placeholder="Enter your name" />
                </div>
            
        <div class="col col-md-6">
            <label class="form-label">E-mail</label>
            <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email"
                value="{{ isset($user->email)? $user->email:"" }}" />
        </div>
        <div class="col col-md-6">
            <label class="form-label">Senha</label>
            <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password"
                value="" />
        </div>
        <div class="col col-md-6">
            <label class="form-label">Perfil</label>
            <select class="form-control form-control-lg" name="group" placeholder="Escolha o perfi">
                @foreach($permissions as $key=>$val)
                    <option value="{{$val}}" {{ $user->group==$val? "selected" : "" }} >{{ $val }}</option>
                @endforeach
            </select>
        </div>
        <div class="text-end mt-3">
            {{-- <a href="index.html" class="btn btn-lg btn-primary">Salvar</a> --}}
            <button type="submit" class="btn btn-lg btn-primary">Salvar</button>
        </div>
        </div>
        </form>

    </div>
</div>
<div class="row">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Perfil</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable({
            serverSide: true,
            processing: true,
            "lengthChange": false,
            ajax: '{{ route("admin.user.data_table") }}',
            columns: [{
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'group'
                },
                {
                    class: 'dt-right',
                    render: function (data, type, row) {
                        let buttons =
                            '<a class="btn btn-sm btn-primary" href="{{ route("admin.user.edit") }}/' +
                            row.id + '"><i class="fa fa-pencil"></i></a> &nbsp;';
                        buttons = buttons +
                            '<a class="btn btn-sm btn-danger" href="{{ route("admin.user.delete") }}/' +
                            row.id + '"><i class="fa fa-trash"></i></a>';
                        return buttons;
                    }
                }
            ]
        });
    });

</script>

@endsection
