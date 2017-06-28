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

$(".option label input[type='radio']").click(function () {
    var $radio = $(this).parents("label");
    $radio.find(".radio_new").css({"background":"url('" + png_path + "btn.png') no-repeat left top 0", "background-size":"cover"});
    $radio.parents(".option").siblings(".option").find(".radio_new").css({"background":"url('" + png_path + "btn.png') no-repeat left top -1.35rem", "background-size":"cover"})

});
$(".option label input[type='checkbox']").click(function () {
    var choice= $(this).is(":checked");
    var $checkbox = $(this).parents("label").find(".check_new");
    choice? $checkbox.css({"background":"url('" + png_path + "check.png') no-repeat left top 0", "background-size":"cover"}):
            $checkbox.css({"background":"url('" + png_path + "check.png') no-repeat left top -1.29rem", "background-size":"cover"});

});

$(".rank_item input[type='radio']").click(function () {
    $(this).parents("label").find(".radio_new").css({"background":"url('" + png_path + "btn.png') no-repeat left top 0", "background-size":"cover"});
    $(this).parents("label").siblings("label").find(".radio_new").css({"background":"url('" + png_path + "btn.png') no-repeat left top -1.35rem", "background-size":"cover"});
});

$(".array_single input[type='radio']").click(function () {
    $(this).parents("td").find(".radio_new").css({"background":"url('" + png_path + "btn.png') no-repeat left top 0", "background-size":"cover"});
    $(this).parents("td").siblings("td").find(".radio_new").css({"background":"url('" + png_path + "btn.png') no-repeat left top -1.35rem", "background-size":"cover"});
});