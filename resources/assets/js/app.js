$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('a.btn-delete').click(function(){
    if (!confirm('确定要删除吗?')) return false;
    var el = $(this);
    $.ajax({
        url: el.attr('href'),
        dataType: "json",
        type: 'DELETE',
        success:  function(result) {
            if (result){
                console.log(result);
                if (result['error_code']==0) {
                    while (el[0].tagName != 'TR') {
                        el = el.parent();
                    }
                    el.fadeOut(600);
                } else {
                    alert(result['error_message']);
                }
            }
        }
    });

    return false;
});