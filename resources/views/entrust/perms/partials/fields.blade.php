<h3 class="form-section">Información Básica</h3>
<div class="col-lg-12">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label col-lg-4">Nombre del Permiso</label>
        <div class="col-lg-8">
            <input type="text" {{($perm)?'disabled':''}} class="form-control" value="@if($perm){{ $perm->name }}@else{{ old('name') }}@endif" name="name" placeholder="Permiso">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
        <label class="control-label col-lg-4">Nombre para Mostrar</label>
        <div class="col-lg-8">
            <input type="text" name="display_name" value="@if($perm){{ $perm->display_name }}@else{{ old('display_name') }}@endif" class="form-control" placeholder="Nombre Mostrar">
            @if ($errors->has('display_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('display_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label class="control-label col-lg-4">Descripción:</label>
        <div class="col-lg-8">
            <textarea name="description" class="form-control" rows="4">@if($perm){{ $perm->description }}@else{{ old('description') }}@endif</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>