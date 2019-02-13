<div class="col-12 mb-3">
    <label for="validationServer01"><i class="fas fa-signature"></i> Nome</label>
    {!! Form::text('name', null, ['class' => 'form-control is-valid', 'for' => 'validationServer01', 'placeholder' => 'Nome', 'required' ]) !!}
</div>

<div class="col-12 mb-3">
    <label for="validationServer01"><i class="fas fa-envelope"></i> Email:</label>
    {!! Form::email('email', null, ['class' => 'form-control is-invalid', 'for' => 'validationServer01', 'placeholder' => 'E-mail', 'required']) !!}
</div>

<div class="col-12 mb-3">
    <label for="inputPassword"><i class="fas fa-key"></i> Senha (Nova Senha)</label>
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Senha', 'for' => 'inputPassword', 'required']) !!}
</div>

<div class="col-12 mb-3">
    {!! Form::checkbox('is_admin', true, null) !!}
    <label for="validationServer01">É admin?</label>
</div>

<div class="pt-4 pb-5 col-12" >
    <button type="submit" class="btn btn-success" name="SendFormContato" value="Enviar"><i class="fas fa-check"></i> Enviar</button>
    <button type="reset" class="btn btn-danger ml-3" ><i class="fas fa-eraser"></i> Limpar </button>
</div>
