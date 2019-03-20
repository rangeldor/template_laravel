<div class="col-12 mb-3">
    <label for="validationServer01"><i class="fas fa-signature"></i> Nome</label>
    {!! Form::text('name', null, ['class' => 'form-control is-valid', 'for' => 'validationServer01', 'placeholder' => 'Nome', 'required' ]) !!}
</div>
<div class="row">
    <div class="col-12">
        <p><strong>Adicione função para o perfil:</strong></p>
    </div>

    <div class="col-3 mb-3">
        {!! Form::checkbox('create', true, true) !!}
        <label for="validationServer01">Cadastrar</label>
    </div>

    <div class="col-3 mb-3">
        {!! Form::checkbox('read', true, null) !!}
        <label for="validationServer01">Visualizar</label>
    </div> 

    <div class="col-3 mb-3">
        {!! Form::checkbox('update', true, null) !!}
        <label for="validationServer01">Atualizar</label>
    </div> 

    <div class="col-3 mb-3">
        {!! Form::checkbox('delete', true, null) !!}
        <label for="validationServer01">Deletar</label>
    </div> 

    <div class="pt-4 pb-5 col-12" >
        <button type="submit" class="btn btn-success" name="SendFormContato" value="Enviar"><i class="fas fa-check"></i> Enviar</button>
        <button type="reset" class="btn btn-danger ml-3" ><i class="fas fa-eraser"></i> Limpar </button>
    </div>
</div>
