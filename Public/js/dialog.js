 var dialog = {
    error:function (message) {
        layer.open({
            content:message,
            icon:2,
            title:'错误提示'
        })
    },
     success:function (message,url) {
         layer.open({
             content:message,
             icon:1,
             yes : function () {
                 location.href=url;
             }
         })
     },

     warning : function (message, url, data) {
        layer.open({
            type : 0,
            title : '是否确认?',
            btn : ['yes', 'no'],
            icon : 3,
            closeBtn : 2,
            content : "是否确定"+message,
            scrollbar : true,
            yes : function () {
                todelete(url, data);
            }
        })
     }

 }