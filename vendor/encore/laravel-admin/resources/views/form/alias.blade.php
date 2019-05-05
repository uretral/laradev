<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6">

        @include('admin::form.error')
        <input type="text" id="alias" name="{{$name}}" value="{{ old($column, $value) }}" class="form-control {{$class}}" placeholder="{{ $placeholder }}" {!! $attributes !!} >
        @include('admin::form.help-block')

    </div>
</div>
