/**
 * Created by Wudi on 2017/10/23.
 */



// 跳转添加界面
$('#button-add').click(function () {
    var url = SCOPE.add_url;
    window.location.href = url;
});

// 添加提交按钮
$('#cms-button-submit').click(function () {

    var data = $('#cms-form').serializeArray();
    var postData = {};
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });

    var url = SCOPE.save_url;
    $.post(url, postData, function (result) {
        if (result.status == 0){
            dialog.error(result.message);
        }
        if (result.status == 1){
            dialog.success(result.message, SCOPE.jump_url);
        }
    }, 'JSON');
});



// 删除
$('.cms-table #cms-delete').click(function () {
    var id = $(this).attr('attr-id');
    var message = $(this).attr('attr-message');

    var data = {};
    data['id'] = id;
    data['status'] = -1;

    dialog.warning(message, SCOPE.set_status_url, data);

});

function todelete(url, data) {
    $.post(url, data, function (result) {
        if (result.status == 0){
            dialog.error(result.message);
        }
        if (result.status == 1){
            dialog.success(result.message, '');
        }
    }, 'JSON');
}



$('.cms-table #cms-edit').on('click',function(){
    var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url + '&id='+id;
    window.location.href = url;
});



$('#button-listorder').click(function() {
    // 获取 listorder内容
    var data = $("#cms-listorder").serializeArray();

    postData = {};
    $(data).each(function(i){
        postData[this.name] = this.value;
    });


    var url = SCOPE.listorder_url;
    $.post(url,postData,function(result){
        if(result.status === 1) {
            //成功
            return dialog.success(result.message,result['data']['jump_url']);


        }else if(result.status === 0) {
            // 失败
            return dialog.error(result.message,result['data']['jump_url']);
        }
    },"JSON");
});

$('#cms-push').click(function () {
    var position_id = $('#select-push').val();
   //获取position_id的值
   var news_id = $('input[name="pushcheck"]:checked').each(function () {
       news_id[this.name]= this.value;
   });

   var url = SCOPE.push_url;

   var data ={
    'position_id' : position_id,
       'news_id' : news_id
   };

   $.post(url,data,function (result) {

    if (result.status==0) {
        return dialog.error(result.message);
    } else if (result.status==1) {
        return dialog.success(result.message,url);
    }
   },'JSON');
});