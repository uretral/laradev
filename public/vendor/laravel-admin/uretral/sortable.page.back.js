$('.dd').nestable({
    maxDepth: 1
});

$(document).on('change','#new_block',function(){




    $.ajax({
        type: "get",
        url: "/admin/block/sample/create",
        data: {
            _token:LA.token,
        }
    }).success(function( data ) {
        // $('#tag').html(data);


        var sc = $(data).find('script');




        var item = '<li class="dd-item" data-id=""><div class="dd-handle">Block </div><div class="fform">'+data+'</div></li>';
        // item = $(item).find('form').attr('target','_blank');
        // var tt = $(item).find('form').attr('target','_blank');






        $('.dd-list').append(item);

        $(document).find('form:eq(1)').attr('target','_blank');
        console.log(sc);


    });
    console.log($(this).val());

});
$(document).on('click','#add_nest',function(){

});
console.log($('.dd').nestable('serialize'));
