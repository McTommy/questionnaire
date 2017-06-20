/* +--------------------------------------------------------------------------
 // | Author: Merrier <953075999@qq.com> <http://> <Date:2016/5/10 9:43>
 // +--------------------------------------------------------------------------*/
// JavaScript Document

$(function () {

    //-----------------------------------模版列表----------------------------------------

    //点击选取创建卡券
    $(".btn_create_questionnaire").click(function () {
        $("#modal-questionnaire").modal("show");
    });

    //点击取消
    $(".modal .cancel").click(function () {
        $(".close").trigger("click");
    });

    //提交创建表单
    $(".questionnaire_submit").click(function () {
       var title = $(".input_title").val();
       if(title == "" || title == null) {
           $(".error_tips").show();
       } else {
           $("#submit").trigger("click");
       }
    });

    //点击删除
    $(".template_list_table").delegate(".btn_delete","click",function(event){
        event.stopPropagation();
        var id = $(this).parents("tr").attr('data-id');
        $("#modal-delete .delete_questionnaire").attr('action', 'questionnaire/' + id);
        $("#modal-delete").modal("show");
    });

    //确认删除
    $(".modal .delete_submit").click(function () {
        $(".delete_questionnaire_button").trigger("click");
    });


    //---------------------活动时间选择(插件)----------------------
    $('#from').datepicker({
        duration: '',
        showTime: true,
        constrainInput: false
    });
    $('#to').datepicker({
        duration: '',
        showTime: true,
        constrainInput: false
    });





});