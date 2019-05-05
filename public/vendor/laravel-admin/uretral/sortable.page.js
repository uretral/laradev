$(document).ready(function()
{
    window.blocks = '';
   function updateOutput (e)
    {
        let list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            window.blocks = window.JSON.stringify(list.nestable('serialize'));
            $('#blocks_json').val(window.blocks);
            console.log($('#blocks_json').val());
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    $('.dd').nestable({
        maxDepth: 1
    })
        .on('change', updateOutput);

    $(document).on('change','select.blocks',function(){
        let max = 1000000;
        let min = 9000000;
        let itemNr = Math.floor(Math.random() * (max - min + 1)) + min;
        let name = $(this).find('option:selected').text();
        let url = $(this).val();
        let res = $('#block_target').attr('rel');

        window.blocks = window.JSON.stringify($('.dd').nestable('serialize'));

        $.ajax({
            type: "get",
            url: "/admin/block/"+url+"/create?parent="+res+"&nr="+itemNr,
            data: { _token:LA.token}
        }).success(function( data ) {
            $('.modal-body').html(data);
            $('.modal-title').html(name + ' блок');
            $('.grid-expand').click();
        });


        $('#blocks_json').val(window.blocks);

        console.log($('#blocks_json').val());
    });

    $(document).on('click','.block_edit',function(){
        $.ajax({
            type: "get",
            url: $(this).attr('rel'),
            data: { _token:LA.token}
        }).success(function( data ) {
            $('.modal-body').html(data);
            $('.modal-title').html($(this).attr('data-name') + ' блок');
            $('.grid-expand').click();
        });
        console.log($('#blocks_json').val());
    });

    $(document).on('click','.block_view',function(){
        $(this).removeClass('block_view');
        $(this).addClass('block_viewed');
        $(this).text('Скрыть');
        let nest = $('#nest_'+$(this).attr('data-code'));
        $.ajax({
            type: "get",
            url: $(this).attr('rel'),
            data: {
                _token:LA.token
            }
        }).success(function( data ) {
            $(nest).html(data);

        });
        console.log($('#blocks_json').val());
    });
    $(document).on('click','.block_viewed',function(){
        $(this).removeClass('block_viewed');
        $(this).addClass('block_view');
        let nest = $('#nest_'+$(this).attr('data-code'));
        $(nest).html('');
        $(this).text('Просмотр');
        console.log($('#blocks_json').val());
    });


    $(document).on('click','.block_delete',function(){

        var url = $(this).attr('rel');
        var code = $(this).attr('data-code');

        swal({
            title: "Вы уверены, что хотите удалить эту запись?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Подтвердить",
            showLoaderOnConfirm: true,
            cancelButtonText: "Отмена",
            preConfirm: function() {

                return new Promise(function(resolve) {
                    $.ajax({
                        method: 'post',
                        url: url,
                        data: {
                            _method:'delete',
                            _token:LA.token,
                        },
                        success: function (data) {

                            $.pjax({container:'#pjax-container', url: location.href });
                            resolve(data);
                            location.reload();
                        }
                    });
                });
            }
        }).then(function(result) {
            var data = result.value;
            if (typeof data === 'object') {
                if (data.status) {
                    swal(data.message, '', 'success');
                } else {
                    swal(data.message, '', 'error');
                }
            }
        });

    });
});


