$(document).ready(function () {
    /**
     * TODO  Get free user
     */
    $('.add-user-for-group-btn').click(function () {
        $.ajax({
            url: 'http://'+location.hostname +'/admin/ajax/free_user',
            cache: false,
            success: function (city)
            {
                $('.select-add-user').html(city);
            }
        });
    });
    /**
     * TODO Add user for group
     */
    $('.add-new-user-btn').click(function () {
        var id_user = $('.select-add-user option:selected').val();
        var data = getUrlVar();


       $.ajax({
            url: 'http://'+location.hostname +'/admin/ajax/add_user_for_group',
            cache: false,
            data:{id_user: id_user, id_group: data.id },
            type: "POST",
            success: function (data)
            {
                var user = JSON.parse(data);
                var list_user = $('.user-for-group-item');
                $('.user-for-group').append('<tr class="user-for-group-item-'+user.id+'"> <td class="col-md-1 count">'+user.id +'</td> <td class="col-md-8">'+user.name+'</td> <td class="col-md-1">  <a href="#" class="delete-user-for-group" id="'+user.id+'"> <span class="glyphicon glyphicon-trash" ></span></a></tr>');
                $('.btn-close').click();
            }
        });
    });

    /**
     * TODO Delete user for group
     */

    $(document).on("click", ".delete-user-for-group", function(e){
        console.log(2);
        e.preventDefault();


        var id_user = $(this).attr('id');

        $.ajax({
            url: 'http://'+location.hostname +'/admin/ajax/delete_user_for_group',
            cache: false,
            data:{id_user: id_user },
            type: "POST",
            success: function (id)
            {
                $('.user-for-group-item-'+id).remove();
            }
        });
    });
    /**
     * TODO Delete group
     */
    $('.delete-group').click(function () {
        var data = getUrlVar();

        $.ajax({
            url: 'http://'+location.hostname +'/admin/ajax/delete_group',
            cache: false,
            data:{id_group: data.id },
            type: "POST",
            success: function (result)
            {
                if(result == 1)
                {
                    location.href = 'http://'+location.hostname+'/admin/group/index';
                }else
                {
                    toastr.warning("Вы не можете удалять группы когда у них есть пользователи");
                }
            }
        });
    });

});
function getUrlVar(){
    var urlVar = window.location.search;
    var arrayVar = [];
    var valueAndKey = [];
    var resultArray = [];
    arrayVar = (urlVar.substr(1)).split('&');
    if(arrayVar[0]=="") return false;
    for (i = 0; i < arrayVar.length; i ++) {
        valueAndKey = arrayVar[i].split('=');
        resultArray[valueAndKey[0]] = valueAndKey[1];
    }
    return resultArray;
}