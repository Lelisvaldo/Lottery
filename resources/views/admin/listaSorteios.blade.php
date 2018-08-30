@extends('adminlte::page')


@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
        <div class="row">
        <div class="col-xs-8">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar Sorteio</h3>
                </div>
                <div class="box-body">
                    <form action="" method="post">
                        <label>Titulo do Sorteio</label>
                        <div class="input-group">
                            <span class="input-group-addon">T</span>
                            <input type="text" class="form-control" placeholder="Titulo do Sorteio" maxlength="45" name="titulo" required>
                        </div>
                        <br>

                        <label>Descrição</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-align-left"></i></span>
                            <input type="text" class="form-control" placeholder="Descrição do Sorteio" maxlength="45" name="descricao" required>
                        </div>
                        <br>

                        <label>Brinde</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-trophy"></i></span>
                            <input type="text" class="form-control" placeholder="Descrição  do Sorteio" maxlength="100" name="brinde" required>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-lg-6">
                                    <label>Data Inicial</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control pull-right" id="datepicker" name="dtInicial" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label>Data Final</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control pull-right" id="datepicker" name="dtFinal" required>

                                </div>
                            </div>
                        </div>
                        <br>

                        <label>Imagem</label>
                        <div class="file-input file-input-ajax-new">
                            <div class="file-preview">
                                <input id="input-b1" name="input-b1" type="file" class="file">
                            </div>
                        </div>
                        <br>

                        <input class="btn btn-success pull-right" type="submit">
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

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Buscar">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Data Inicio</th>
                                <th>Data Fim</th>
                                <th>Alteração</th>
                            </tr>
                            {{--@foreach($clientes as $cliente)--}}
                                <tr>
                                    <td>1</td>
                                    <td>Sorteio Teste</td>
                                    <td>14/08/2018</td>
                                    <td>14/09/2018</td>
                                    <td>
                                        <i class="fa fa-pencil"></i>
                                        &nbsp;
                                        <i class="fa fa-trash"></i>
                                    </td>
                                </tr>
                            {{--@endforeach--}}
                        </tbody>
                    </table>
                    <div align="center">
                        {{--{!!$clientes->links()!!}--}}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop
