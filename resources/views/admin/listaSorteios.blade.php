@extends('adminlte::page')


@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @include('partials.admin._alerts')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar Sorteio</h3>
                </div>
                <div class="box-body">
                    <form action="{{route('sorteio.save')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <label>Titulo do Sorteio</label>
                        <div class="input-group">
                            <span class="input-group-addon">T</span>
                            <input type="text" class="form-control" placeholder="Titulo do Sorteio" maxlength="45" name="titulo_sorteio" required>
                        </div>
                        <br>

                        <label>Descrição</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-align-left"></i></span>
                            <input type="text" class="form-control" placeholder="Descrição do Sorteio" maxlength="300" name="descricao_sorteio" required>
                        </div>
                        <br>

                        <label>Brinde</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-trophy"></i></span>
                            <input type="text" class="form-control" placeholder="Descrição  do Sorteio" maxlength="100" name="brinde_sorteio" required>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-lg-6">
                                    <label>Data Inicial</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control pull-right" id="datepicker" name="data_inicio" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label>Data Final</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control pull-right" id="datepicker" name="data_fim" required>

                                </div>
                            </div>
                        </div>
                        <br>

                        <label>Imagem</label>
                        <div class="file-input file-input-ajax-new">
                            <div class="file-preview">
                                <input id="input-b1" name="foto_sorteio" type="file" class="file" required>
                            </div>
                        </div>
                        <br>

                        <button class="btn btn-success pull-right" type="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--LISTA SORTEIOS-->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Responsive Hover Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>Descricao</th>
                                <th>Brinde</th>
                                <th>Data Inicio</th>
                                <th>Data Fim</th>
                                <th>Alteração</th>
                            </tr>
                            @foreach($soteios as $soteio)
                                <tr>
                                    <td>{{$soteio->id}}</td>
                                    <td>{{$soteio->titulo_sorteio}}</td>
                                    <td>{{$soteio->descricao_sorteio}}</td>
                                    <td>{{$soteio->brinde_sorteio}}</td>
                                    <td>{{date( 'd/m/Y' , strtotime($soteio->data_inicio))}}</td>
                                    <td>{{date( 'd/m/Y' , strtotime($soteio->data_fim))}}</td>
                                    <td>
                                        <i class="fa fa-pencil"></i>
                                        &nbsp;
                                        <i class="fa fa-trash"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div align="center">
                        {{ $soteios->links() }}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop
