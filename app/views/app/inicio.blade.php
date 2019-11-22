@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-right">
                <form name="importar-registros" method="post" action="/arquivo/importar"
                      class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-12">
                            <label class="file-upload btn btn-primary mt-2">
                                Upload Registos <input type="file" name="arquivo" id="arquivo"/>
                            </label>
                            <input type="submit" class="btn btn-success" vlaue="enviar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="preload"></div>
        <div class="container mb-2">
            <form name="form-filtro" id="form-filtro" method="post" action="/" class="clearfix">
                @include('app.form-registro-filtro')
            </form>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-success float-right"
                            data-toggle="modal" data-target="#novo-registro">Novo registro</button>
                        </div>
                    </div>
                    <table class="table table-responsive-lg table-striped table-hover mt-2 table-sm">
                        <thead class="table-dark">
                        <tr>
                            <th>Data</th>
                            <th>Entrada</th>
                            <th>Entrada intervalo</th>
                            <th>Saída intervalo</th>
                            <th>Saída</th>
                            <th>Cumpridas</th>
                            <th>Saldo dia</th>
                            <th>Saldo total</th>
                            <th width="10%">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($registros as $registro)
                            @php
                            $saldo[] =$registro->saldo;
                            $saldo_dia[] =$registro->saldo_dia;
                            $saldo_total[] =$registro->saldo_total;
                            @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($registro->data)->format('d/m/Y') }}</td>
                                <td>{{ $registro->entrada }}</td>
                                <td>{{ $registro->entrada_intervalo }}</td>
                                <td>{{ $registro->saida_intervalo }}</td>
                                <td>{{ $registro->saida }}</td>
                                <td>{{ $registro->saldo }}</td>
                                <td class="{{\App\Helpers\Helper::tipoSaldo($registro->saldo_dia)}}">
                                    {{ $registro->saldo_dia }}</td>
                                <td class="{{\App\Helpers\Helper::tipoSaldo($registro->saldo_total)}}">
                                    {{ $registro->saldo_total }} </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary" data-idregistro="{{ $registro->id }}"
                                       data-dtregistro="{{ \Carbon\Carbon::parse($registro->data)->format('d/m/Y') }}"
                                       data-target="#update-registro" data-toggle="modal"><i class="fas fa-edit"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger delete-cartorio"
                                       data-idregistro="{{ $registro->id }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"></td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfooter>
                            <tr>
                                <th colspan="5">Total de horas:</th>
                                <th class="text-left">{{ $registros[0]->calcularTotalHoras($saldo) }}</th>
                                <th></th>
                                <th colspan="2" class="text-left">{{ $registros[0]->calcularTotalHoras($saldo_total) }}</th>
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>

        {{--<div class="row">
            <div class="col">
                <span class="paginate-info">
                    Exibindo de <b>{{ $paginator->getCurrentPageFirstItem() }}</b> até
                    <b>{{ $paginator->getCurrentPageLastItem() }}</b> de
                    <b>{{ $paginator->getTotalItems() }}</b> registros.
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                {!! $paginator !!}
            </div>
        </div>--}}
    </div>
    <div id="novo-registro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="novo-registro"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success save">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="update-registro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="update-registro"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success save">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@stop
