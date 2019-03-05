jQuery(function($){
    //ajax送信
    $.ajax({
        url : "ajax.php",
        type : "POST",
        dataType:"json",
        data : {post_data_1:"hoge", post_data_2:"piyo"},
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("ajax通信に失敗しました");
        },
        success : function(response) {
            console.log("ajax通信に成功しました");
            console.log(response[0]);
            console.log(response[1]);
            $('#response').html(response[0]+', '+response[0]);
        }
    });
});