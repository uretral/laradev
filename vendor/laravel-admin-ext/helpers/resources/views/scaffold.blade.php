<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Scaffold</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <form method="post" action="{{$action}}" id="scaffold" pjax-container>

            <div class="box-body">

                <div class="form-horizontal">

                <div class="form-group">

                    <label for="inputTableName" class="col-sm-1 control-label">Table name</label>

                    <div class="col-sm-4">
                        <input type="text" name="table_name" class="form-control" id="inputTableName" placeholder="table name" value="{{ old('table_name') }}">
                    </div>

                    <span class="help-block hide" id="table-name-help">
                        <i class="fa fa-info"></i>&nbsp; Table name can't be empty!
                    </span>

                </div>
                <div class="form-group">
                    <label for="inputModelName" class="col-sm-1 control-label">Model</label>

                    <div class="col-sm-4">
                        <input type="text" name="model_name" class="form-control" id="inputModelName" placeholder="model" value="{{ old('model_name', "App\\Models\\") }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputControllerName" class="col-sm-1 control-label">Controller</label>

                    <div class="col-sm-4">
                        <input type="text" name="controller_name" class="form-control" id="inputControllerName" placeholder="controller" value="{{ old('controller_name', "App\\Admin\\Controllers\\") }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-11">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" checked value="migration" name="create[]" /> Create migration
                            </label>
                            <label>
                                <input type="checkbox" checked value="model" name="create[]" /> Create model
                            </label>
                            <label>
                                <input type="checkbox" checked value="controller" name="create[]" /> Create controller
                            </label>
                            <label>
                                <input type="checkbox" checked value="migrate" name="create[]" /> Run migrate
                            </label>
                        </div>
                    </div>
                </div>

                </div>



                <h4>Тип:</h4>
                <hr />
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-11">
                        <div class="checkbox">
                            <label>
                                <input type="radio" checked value="controller"  name="table_mode" /> Пустая
                            </label>
                            <label>
                                <input type="radio"  value="resource_controller" name="table_mode" /> Ресурсная
                            </label>
                            <label>
                                <input type="radio"  value="block_controller" name="table_mode" /> Блок
                            </label>
                        </div>
                    </div>
                </div>
                <br/>

                <hr />




                <div class="form-horizontal" id="block_fields" style="display: none;">
                    <h4>Доп поля для блока:</h4>
                    <hr />
                    <br/>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Название блока</label>
                        <div class="col-sm-4">
                            <input type="text" name="block_name" class="form-control" placeholder="Название блока" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Алиас блока</label>
                        <div class="col-sm-4">
                            <input type="text" name="block_alias" class="form-control" placeholder="Алиас блока" value="">
                        </div>
                    </div>
                    <br/>
                </div>


                <h4>Поля таблицы</h4>



                <table class="table table-hover" id="table-fields">
                    <thead>
                    <tr>
                        <th style="width: 200px">Field name</th>
                        <th>Type</th>
                        <th>Nullable</th>
                        <th>Key</th>
                        <th>Default value</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>



{{--                    @php--}}
{{--                        $uFields = array(--}}
{{--                            array('name' => 'alias','type' => 'string'),--}}
{{--                            array('name' => 'parent','type' => 'integer'),--}}
{{--                            array('name' => 'name','type' => 'string'),--}}
{{--                            array('name' => 'intro_img','type' => 'string'),--}}
{{--                            array('name' => 'intro','type' => 'text'),--}}
{{--                            array('name' => 'detail_img','type' => 'string'),--}}
{{--                            array('name' => 'detail','type' => 'text'),--}}
{{--                            array('name' => 'seo_title','type' => 'text'),--}}
{{--                            array('name' => 'seo_desc','type' => 'text'),--}}
{{--                            array('name' => 'seo_key','type' => 'text'),--}}
{{--                        )--}}
{{--                    @endphp--}}
{{--                    @if(!old('fields'))--}}
{{--                    @foreach($uFields as $k => $uField)--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <input type="text" readonly  name="fields[{{$k}}][name]" class="form-control"  value="{{$uField['name']}}" />--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input type="text" readonly name="fields[{{$k}}][type]" class="form-control"  value="{{$uField['type']}}" />--}}
{{--                            </td>--}}
{{--                            <td><input type="checkbox" name="fields[{{$k}}][nullable]" checked /></td>--}}
{{--                            <td>--}}
{{--                                <input type="text" readonly name="fields[{{$k}}][key]" class="form-control"  value="" />--}}
{{--                            </td>--}}
{{--                            <td><input type="text" class="form-control" placeholder="default value" name="fields[{{$k}}][default]" value=""/></td>--}}
{{--                            <td><input type="text" class="form-control" placeholder="comment" name="fields[{{$k}}][comment]" value="" /></td>--}}
{{--                            <td><a class="btn btn-sm btn-danger table-field-remove"><i class="fa fa-trash"></i> remove</a></td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    @endif--}}


                    @if(old('fields'))
                        @foreach(old('fields') as $index => $field)
                            <tr>
                                <td>
                                    <input type="text" name="fields[{{$index}}][name]" class="form-control" placeholder="field name" value="{{$field['name']}}" />
                                </td>
                                <td>
                                    <select style="width: 200px" name="fields[{{$index}}][type]">
                                        @foreach($dbTypes as $type)
                                            <option value="{{ $type }}" {{$field['type'] == $type ? 'selected' : '' }}>{{$type}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="checkbox" name="fields[{{$index}}][nullable]" {{ array_get($field, 'nullable') == 'on' ? 'checked': '' }}/></td>
                                <td>
                                    <select style="width: 150px" name="fields[{{$index}}][key]">
                                        <option value="primary">Primary</option>
                                        <option value="" {{$field['key'] == '' ? 'selected' : '' }}>NULL</option>
                                        <option value="unique" {{$field['key'] == 'unique' ? 'selected' : '' }}>Unique</option>
                                        <option value="index" {{$field['key'] == 'index' ? 'selected' : '' }}>Index</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" placeholder="default value" name="fields[{{$index}}][default]" value="{{$field['default']}}"/></td>
                                <td><input type="text" class="form-control" placeholder="comment" name="fields[{{$index}}][comment]" value="{{$field['comment']}}" /></td>
                                <td><a class="btn btn-sm btn-danger table-field-remove"><i class="fa fa-trash"></i> remove</a></td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>


                <hr style="margin-top: 0;"/>

                <div class='form-inline margin' style="width: 100%">

                    <input type="hidden" id="stub_name"  value="controller"/>


                    <div class='form-group'>
                        <button type="button" class="btn btn-sm btn-success" id="add-table-field"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add field</button>
                    </div>

                    <div class='form-group pull-right' style="margin-right: 20px; margin-top: 5px;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" checked name="timestamps"> Created_at & Updated_at
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input type="checkbox" name="soft_deletes"> Soft deletes
                            </label>

                        </div>
                    </div>

                    <div class="form-group pull-right" style="margin-right: 20px;">
                        <label for="inputPrimaryKey">Primary key</label>
                        <input type="text" name="primary_key" class="form-control" id="inputPrimaryKey" placeholder="Primary key" value="id" style="width: 100px;">
                    </div>

                </div>

                {{--<hr />--}}

                {{--<h4>Relations</h4>--}}

                {{--<table class="table table-hover" id="model-relations">--}}
                    {{--<tbody>--}}
                    {{--<tr>--}}
                        {{--<th style="width: 200px">Relation name</th>--}}
                        {{--<th>Type</th>--}}
                        {{--<th>Related model</th>--}}
                        {{--<th>forignKey</th>--}}
                        {{--<th>OtherKey</th>--}}
                        {{--<th>With Pivot</th>--}}
                        {{--<th>Action</th>--}}
                    {{--</tr>--}}
                    {{--</tbody>--}}
                {{--</table>--}}

                {{--<hr style="margin-top: 0;"/>--}}

                {{--<div class='form-inline margin' style="width: 100%">--}}

                    {{--<div class='form-group'>--}}
                        {{--<button type="button" class="btn btn-sm btn-success" id="add-model-relation"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add relation</button>--}}
                    {{--</div>--}}

                {{--</div>--}}

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">submit</button>
            </div>

            {{ csrf_field() }}

            <!-- /.box-footer -->
        </form>

    </div>

</div>

<template id="table-field-tpl">
    <tr>
        <td>
            <input type="text" name="fields[__index__][name]" class="form-control" placeholder="field name" />
        </td>
        <td>
            <select style="width: 200px" name="fields[__index__][type]">
                @foreach($dbTypes as $type)
                    <option value="{{ $type }}">{{$type}}</option>
                @endforeach
            </select>
        </td>
        <td><input type="checkbox" name="fields[__index__][nullable]" /></td>
        <td>
            <select style="width: 150px" name="fields[__index__][key]">
                <option value="" selected>NULL</option>
                <option value="unique">Unique</option>
                <option value="index">Index</option>
            </select>
        </td>
        <td><input type="text" class="form-control" placeholder="default value" name="fields[__index__][default]"></td>
        <td><input type="text" class="form-control" placeholder="comment" name="fields[__index__][comment]"></td>
        <td><a class="btn btn-sm btn-danger table-field-remove"><i class="fa fa-trash"></i> remove</a></td>
    </tr>
</template>

<template id="table-predefined-tpl">
    <tr>
        <td>
            <input type="text" readonly name="fields[__index__][name]" value="__name__" class="form-control" placeholder="field name" />
        </td>
        <td>
            <input type="text" readonly name="fields[__index__][type]" value="__type__" class="form-control" placeholder="field name" />
        </td>
        <td><input type="checkbox" checked disabled name="fields[__index__][nullable]" /></td>
        <td>
            <select style="width: 150px"  name="fields[__index__][key]">
                <option value="" selected>NULL</option>
                <option value="unique">Unique</option>
                <option value="index">Index</option>
            </select>
        </td>
        <td><input type="text" class="form-control" placeholder="default value" name="fields[__index__][default]"></td>
        <td><input type="text" class="form-control" placeholder="comment" name="fields[__index__][comment]"></td>
        <td><a class="btn btn-sm btn-danger table-field-remove"><i class="fa fa-trash"></i> remove</a></td>
    </tr>
</template>

<template id="model-relation-tpl">
    <tr>
        <td><input type="text" class="form-control" placeholder="relation name" value=""></td>
        <td>
            <select style="width: 150px">
                <option value="HasOne" selected>HasOne</option>
                <option value="BelongsTo">BelongsTo</option>
                <option value="HasMany">HasMany</option>
                <option value="BelongsToMany">BelongsToMany</option>
            </select>
        </td>
        <td><input type="text" class="form-control" placeholder="related model"></td>
        <td><input type="text" class="form-control" placeholder="default value"></td>
        <td><input type="text" class="form-control" placeholder="default value"></td>
        <td><input type="checkbox" checked /></td>
        <td><a class="btn btn-sm btn-danger model-relation-remove"><i class="fa fa-trash"></i> remove</a></td>
    </tr>
</template>

<script>

$(function () {
    let tables = {
        'resource_controller' : [{
            'name': 'alias',
            'type': 'string',
            'default': true,
        }, {
            'name': 'parent',
            'type': 'integer',
            'default': true,
        }, {
            'name': 'sort',
            'type': 'integer',
            'default': true,
        }, {
            'name': 'name',
            'type': 'string',
            'default': true,
        }, {
            'name': 'intro_img',
            'type': 'string',
            'default': false,
        },{
            'name': 'intro',
            'type': 'text',
            'default': false,
        },{
            'name': 'detail_img',
            'type': 'string',
            'default': false,
        },{
            'name': 'detail',
            'type': 'text',
            'default': false,
        },{
            'name': 'seo_title',
            'type': 'text',
            'default': false,
        },{
            'name': 'seo_desc',
            'type': 'text',
            'default': false,
        },{
            'name': 'seo_key',
            'type': 'text',
            'default': false,
        }],
        'block_controller' : [{
            'name': 'parent',
            'type': 'integer',
            'default': true,
        }, {
            'name': 'name',
            'type': 'string',
            'default': true,
        }, {
            'name': 'nr',
            'type': 'integer',
            'default': true,
        }],
        'controller' : []
    }

    $(document).on('change','[name="table_mode"]',function(){
        $('#table-fields tbody').html('');
        if($(this).val() == 'block_controller'){
            $('#block_fields').show()
            $('#inputModelName').val('App\\Models\\Blocks\\');
            $('#inputControllerName').val('App\\Admin\\Controllers\\Blocks\\Controller');
        } else {
            $('#block_fields').hide()
            $('#inputModelName').val('App\\Models\\');
            $('#inputControllerName').val('App\\Admin\\Controllers\\Controller');
        }


        let fields = tables[$(this).val()];
        for(var i = 0, len = fields.length; i < len; i++) {
            $('#table-fields tbody').append($('#table-predefined-tpl').html()
                .replace(/__index__/g, $('#table-fields tr').length - 1)
                .replace(/__name__/g, fields[i].name)
                .replace(/__type__/g, fields[i].type)
                .replace(fields[i].default ? /<a class="btn btn-sm btn-danger table-field-remove"><i class="fa fa-trash"><\/i> remove<\/a>/g : '', '')
            );
            $('select').select2();
            $('input[type=checkbox]').iCheck({checkboxClass:'icheckbox_minimal-blue'});
        }
    });


    $('input[type=checkbox]').iCheck({checkboxClass:'icheckbox_minimal-blue'});
    $('select').select2();

    $('#add-table-field').click(function (event) {
        $('#table-fields tbody').append($('#table-field-tpl').html().replace(/__index__/g, $('#table-fields tr').length - 1));
        $('select').select2();
        $('input[type=checkbox]').iCheck({checkboxClass:'icheckbox_minimal-blue'});
    });

    $('#table-fields').on('click', '.table-field-remove', function(event) {
        $(event.target).closest('tr').remove();
    });

    $('#add-model-relation').click(function (event) {
        $('#model-relations tbody').append($('#model-relation-tpl').html().replace(/__index__/g, $('#model-relations tr').length - 1));
        $('select').select2();
        $('input[type=checkbox]').iCheck({checkboxClass:'icheckbox_minimal-blue'});

        relation_count++;
    });

    $('#model-relations').on('click', '.model-relation-remove', function(event) {
        $(event.target).closest('tr').remove();
    });

    $('#scaffold').on('submit', function (event) {

        //event.preventDefault();

        if ($('#inputTableName').val() == '') {
            $('#inputTableName').closest('.form-group').addClass('has-error');
            $('#table-name-help').removeClass('hide');

            return false;
        }

        return true;
    });
});

</script>
