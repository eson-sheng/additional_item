$(function(){
    // 关闭窗口时弹出确认提示
    //页面内的跳转操作均不弹出确认窗口
    $(window).bind('mouseover mouseleave', function(event){
        is_confirm = event.type == 'mouseleave';
    });
    /*表格头部滚动固定*/
    window.onscroll = function(){
        var top = document.documentElement.scrollTop || document.body.scrollTop;
        if (top > 255) {
            $("thead").addClass("navbar navbar-default navbar-fixed-top");
        } else {
            $("thead").removeClass("navbar navbar-default navbar-fixed-top");
        }
    }
    /*表单重置*/
    $("#reset").click(function(){
        $("#key_time_out_value").attr("value","");
        $("#log_datetime_start").attr("value",default_time);
        $("#log_datetime_end").attr("value","");
        $("#reqnum").attr("value","");
        $("#username").attr("value","");
        $("#mobile").attr("value","");
        $("#r_url").attr("value","");
        $("#key_request_id_value").attr("value","");
    });
    /*点击刷新更新数据*/
    $(".update_log").click(function(){
        if (request_id_value !== '') {
            $("#key_request_id_value").val(request_id_value);
            window.location.reload(true);
        } else {
            return true;
        }
    });
    /*调试查看SQL语句*/
    var str_sql = $("#data_for_sql").text();
    console.log(str_sql);
    /*定时器每秒更新后台数据*/
    setInterval(UpdateBackgroundData, 5000);

    /**
     * ajax更新后台数据
     * @constructor
     */
    function UpdateBackgroundData() {
        $.get("./bin/Storage/do_log_url.php", {"url":log_url}, function (result) {
            console.log(result);
        }, 'json');
    }
});