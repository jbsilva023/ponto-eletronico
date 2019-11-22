<form name="registro" class="form-horizontal mt-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="preload"></div>
                    <div class="row">
                        <input type="hidden" name="id" id="id" class="form-control" value="{{ $registro->id }}">
                        <div class="col-md-4">
                            <label for="data">Data</label>
                            <input type="text" name="data" id="data" class="form-control"
                                   value="{{ \Carbon\Carbon::parse($registro->data)->format('d/m/Y') }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="entrada">Entrada</label>
                            <input type="text" name="entrada" id="entrada" class="form-control time"
                                   value="{{ $registro->entrada }}">
                        </div>
                        <div class="col-md-4">
                            <label for="entrada_intervalo">Entrada intervalo</label>
                            <input type="text" name="entrada_intervalo" id="entrada_intervalo"
                                   class="form-control time" value="{{ $registro->entrada_intervalo }}">
                        </div>
                        <div class="col-md-4">
                            <label for="saida_intervalo">Saída intervalo</label>
                            <input type="text" name="saida_intervalo" id="saida_intervalo"
                                   class="form-control time" value="{{ $registro->saida_intervalo }}">
                        </div>
                        <div class="col-md-4">
                            <label for="saida">Saída</label>
                            <input type="text" name="saida" id="saida" class="form-control time"
                                   value="{{ $registro->saida }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="/app/public/js/jquery.funcoes.js"></script>