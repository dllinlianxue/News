/**
 * Created by inner on 2017/10/21.
 */
 var login = {
     check: function () {
         var username = $("input[name='username']").val();
         var password = $("input[name='password']").val();
         if (!username) {
dialog.error('用户名为空')
         }
         if(!password) {
             dialog.error('密码为空')
         }
         var url = '/admin.php?c=login&a=check';
         var data = {
             'username' : username,
             'password' : password
         };

         $.post(url,data,function (result) {
             if (result.status == 0){
                 dialog.error(result.message);
             }
             if(result.status == 1) {
                 dialog.success(result.message,'/admin.php');
             }
         },'JSON')
     }
}