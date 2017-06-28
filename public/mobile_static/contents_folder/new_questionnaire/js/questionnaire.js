/*
 * Copyright (c) 2017. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * Created by yuejd on 2017/6/23.
 */
var png_path = "../../mobile_static/contents_folder/new_questionnaire/img/";

//单选按钮点击效果
$(".option label input[type='radio']").click(function () {
    var $radio = $(this).parents("label");
    var radio_new = $radio.find(".radio_new");
    var sib = $radio.parents(".option").siblings(".option").find(".radio_new");
    changeBlue(radio_new);changeWhite(sib);
    $(this).parents(".question").find(".error_tips").hide();
    var jump = parseInt($(this).parents(".option").attr("data-jump")) ;
    var id = parseInt($(this).parents(".question").attr("data-id"));
    if(jump){

        $(".question").each(function () {
            var index = parseInt($(this).attr("data-id"));
            if(index>id && index<jump){
                $(this).hide();
            }else{
                $(this).show();
            }
        })
    }




});
$(".rank_item input[type='radio']").click(function () {
    var radio_new = $(this).parents("label").find(".radio_new");
    changeBlue(radio_new);
    var sib = $(this).parents("label").siblings("label").find(".radio_new");
    changeWhite(sib);
    $(this).parents(".question").find(".error_tips").hide();
});
$(".array_single input[type='radio']").click(function () {
    var radio_new = $(this).parents("td").find(".radio_new");
    var sib = $(this).parents("td").siblings("td").find(".radio_new");
    changeBlue(radio_new);
    changeWhite(sib);
    $(this).parents(".question").find(".error_tips").hide();
});
//多选按钮点击效果
$(".option label input[type='checkbox']").click(function () {
    var choice= $(this).is(":checked");
    var $checkbox = $(this).parents("label").find(".check_new");
    var question = $(this).parents(".question");
    var limit = question.attr("data-max");
    choice? $checkbox.css({"background":"url('" + png_path + "check.png') no-repeat left top 0", "background-size":"cover"}):
        $checkbox.css({"background":"url('" + png_path + "check.png') no-repeat left top -1.29rem", "background-size":"cover"});
    $(this).parents(".question").find(".error_tips").hide();
    if(limit){
        var check_num = question.find(".answer input[type='checkbox']:checked").length;
        if(check_num>limit){
            $(".limit_tips").show().focus();
            return false;
        }else{
            $(".limit_tips").hide();
        }
    }
});

// 选择其他焦点到输入框
$(".other_click").click(function () {
    var type = $(this).parents(".question").attr("data-type");
    if(type=='1'){
        $(this).siblings(".option_content").find(".other").focus();
    }
    if(type=="2"){
        var choice= $(this).is(":checked");
        choice? $(this).siblings(".option_content").find(".other").focus():"";
    }

});

// 焦点到输入框默认选中此选项
$(".question .option_content>.other").click(function () {
    console.log(111)
    $(this).parents("label").find(".other_click").trigger("click");
});

$(".fill_in,.mul_fill_input").keyup(function () {
    $(this).parents(".question").find(".error_tips").hide();
});

//点击提交按钮
$(".submit").click(function () {
    //验证没填的题目
    var state = true;
    $(".question").each(function () {
        var $this = $(this);
        var type = $this.attr("data-type");
        var anw =  $this.find(".answer");

        if(type == "1" ||type =="2"){
            var l = anw.find(".option input:checked").length;
            if(l==0){
                $this.children(".error_tips").show().focus();
                state = false;
                return false;
            }
        }
        if(type == "3"){
            var con =$.trim(anw.find(".fill_in").val());
            if(con==""){
                anw.children(".fill_in").focus();
                $this.children(".error_tips").show();
                state = false;
                return false;
            }
        }
        if(type == "4" || type =="5"){
            var tr = anw.find("table tbody tr");
            tr.each(function () {
                var l = $(this).find("input:checked").length;
                if(l==0){
                    $this.children(".error_tips").show().focus();
                    state = false;
                    return false;
                }
            })
        }
        if(type == "7"){
            var option = anw.find(".option");
            option.each(function () {
                var con = $.trim($(this).find(".mul_fill_input").val());
                if(con==""){
                    $(this).parents('.question').find(".error_tips").show();
                    $(this).find(".mul_fill_input").focus();
                    state=false;
                    return false;
                }
            });
        }
    });

    //传数据
    if(state==true){

    }






});





function changeBlue(item) {
    item.css({"background":"url('" + png_path + "btn.png') no-repeat left top 0", "background-size":"cover"});
}
function changeWhite(item) {
    item.css({"background":"url('" + png_path + "btn.png') no-repeat left top -1.35rem", "background-size":"cover"})
}