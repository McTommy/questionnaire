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

//----------------单选按钮点击效果-----------------
$(".option label input[type='radio']").click(function () {
    var $radio = $(this).parents("label");
    var radio_new = $radio.find(".radio_new");
    var sib = $radio.parents(".option").siblings(".option").find(".radio_new");
    changeBlue(radio_new);
    changeWhite(sib);
    $(this).parents(".question").find(".error_tips").hide();
    var jump = parseInt($(this).parents(".option").attr("data-jump"));
    var id = parseInt($(this).parents(".question").attr("data-id"));
    if (jump) {
        //跳题效果
        $(".question").each(function () {
            var index = parseInt($(this).attr("data-id"));
            if (index > id && index < jump) {
                $(this).hide();
            } else {
                $(this).show();
            }
        })
    } else if(jump==0) {
        $(".question").each(function () {
            var $this = $(this);
            var index = parseInt($this.attr("data-id"));
            if(index>id){
                $this.hide();
            }
        })
    } else {
        $(".question").show();

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
//----------------多选按钮点击效果----------------
$(".option label input[type='checkbox']").click(function () {
    var choice = $(this).is(":checked");
    var $checkbox = $(this).parents("label").find(".check_new");
    var question = $(this).parents(".question");
    var limit = question.attr("data-max");
    choice ? $checkbox.css({
            "background": "url('" + png_path + "check.png') no-repeat left top 0",
            "background-size": "cover"
        }) :
        $checkbox.css({
            "background": "url('" + png_path + "check.png') no-repeat left top -1.29rem",
            "background-size": "cover"
        });
    $(this).parents(".question").find(".error_tips").hide();
    if (limit) {
        var check_num = question.find(".answer input[type='checkbox']:checked").length;
        if (check_num > limit) {
            $(this).parents(".question").find(".limit_tips").show().focus();
        } else {
            $(this).parents(".question").find(".limit_tips").hide();
        }
    }
});

//-------------选择其他焦点到输入框----------------------
$(".other_click").click(function () {
    var type = $(this).parents(".question").attr("data-type");
    if (type == '1') {
        $(this).siblings(".option_content").find(".other").focus();
    }
    if (type == "2") {
        var choice = $(this).is(":checked");
        choice ? $(this).siblings(".option_content").find(".other").focus() : "";
    }

});

//-----------焦点到输入框默认选中此选项------------------
$(".question .option_content>.other").click(function () {
    var other = $(this).parents("label").find(".other_click");
    var choice = other.is(":checked");
    choice ? "" : other.trigger("click");
});

$(".fill_in,.mul_fill_input").keyup(function () {
    $(this).parents(".question").find(".error_tips").hide();
});


//------------验证手机号那道题-----------------
$("#phone_que").blur(function () {
    var phone_number = $(this).val();
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/api/answer/verify_phone",
        data: {
            "questionnaire_id": $(".questionnaire_id").text(),
            "question_id": $(this).attr("question-id"),
            "phone_number": phone_number
        },
        type: "post",
        dataType: "json",
        success: function (data) {
            if (data.code == 200) {

            } else {
                $("#phone_que").val("");
                alert("您已参与此次调查问卷")
            }
        },
        error: function () {
            alert("操作失败，请刷新重试")
        }
    });
});


//------------点击提交按钮---------------------
$(".submit").click(function () {
    //验证没填的题目
    var state = true;
    $(".question").each(function () {
        var $this = $(this);
        var type = $this.attr("data-type");
        var anw = $this.find(".answer");
        if ($this.is(":visible")) {
            if (type == "1" || type == "2") {
                var l = anw.find(".option input:checked").length;
                if (l == 0) {
                    $this.children(".error_tips").show().focus();
                    state = false;
                    return false;
                }
            }
            if (type == "3") {
                var con = $.trim(anw.find(".fill_in").val());
                if (con == "") {
                    anw.children(".fill_in").focus();
                    $this.children(".error_tips").show();
                    state = false;
                    return false;
                }
            }
            if (type == "4" || type == "5") {
                var tr = anw.find("table tbody tr");
                tr.each(function () {
                    var l = $(this).find("input:checked").length;
                    if (l == 0) {
                        $this.children(".error_tips").show().focus();
                        state = false;
                        return false;
                    }
                })
            }
            if (type == "7") {
                var option = anw.find(".option");
                option.each(function () {
                    var con = $.trim($(this).find(".mul_fill_input").val());
                    if (con == "") {
                        $(this).parents('.question').find(".error_tips").show();
                        $(this).find(".mul_fill_input").focus();
                        state = false;
                        return false;
                    }
                });
            }
        }

    });

    //传数据
    if (state == true) {
        var datas = [];
        var phone = {};
        $(".question").each(function () {
            var data = {};
            var $this = $(this);
            var type = $this.attr("data-type");
            var que_id = $this.attr("question-id");    //问题的id
            var $ops = $this.find(".option");
            if ($this.is(":visible")) {       //判断这道题被没被隐藏，跳过的题不传
                if (type == "1") {
                    var option = $this.find("input[type='radio']:checked");    //  被选中的那个选项
                    var option_id = option.attr("choice-id");                //选中选项的id
                    // var option_con = option.siblings(".option_content").text();    // 选中选项的内容
                    if ($this.find('.other_click').is(":checked")) {         // 如果选的是其他，获取填的内容
                        var other_fill = $this.find(".other").val();
                    }
                    data.question_id = que_id;
                    data.type = 1;
                    data.choice_id = option_id;
                    data.other = other_fill;
                    datas.push(data);
                }
                if (type == "2") {
                    $ops.each(function () {
                        var data = {};
                        var option = $(this).find("input[type='checkbox']:checked");
                        if (option.length) {
                            var option_id = option.attr("choice-id");
                            if ($this.find('.other_click').is(":checked")) {         // 如果选的是其他，获取填的内容
                                var other_fill = $this.find(".other").val();
                            }
                            data.question_id = que_id;
                            data.type = 2;
                            data.choice_id = option_id;
                            data.other = other_fill;
                            datas.push(data);
                        }
                    });
                }
                if (type == "3") {
                    var fill = $this.find(".fill_in").val();
                    var is_phone_number = $this.find("#phone_que");
                    if (is_phone_number.length == 1) {
                        phone.question_id = que_id;
                        phone.content = fill;
                    }
                    data.question_id = que_id;
                    data.type = 3;
                    data.content = fill;
                    datas.push(data);
                }
                if (type == "4" || type == "5") {
                    var $tr = $this.find("table tbody tr");
                    $tr.each(function () {
                        var data = {};
                        var rank_option = $(this).find("input[type='radio']:checked");
                        data.question_id = rank_option.attr("question-id");
                        data.type = type;
                        data.choice_id = rank_option.attr("choice-id");
                        datas.push(data);
                    })
                }
                if (type == "7") {
                    $ops.each(function () {
                        var data = {};
                        var mul_fill = $(this).find(".mul_fill_input").val();
                        data.choice_id = $(this).find(".mul_fill_input").attr("choice-id");
                        data.question_id = que_id;
                        data.type = 7;
                        data.multi_blank = mul_fill;
                        datas.push(data)
                    })
                }

            }
        });
        $.ajax({
            // csrf-token
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/api/answer/store",
            data: {
                "questionnaire_id": $(".questionnaire_id").text(),
                "datas": datas,
                "phone": phone
            },
            type: "post",
            dataType: "json",
            success: function (data) {
                if (data.code == 200) window.location.href = "/questionnaire/mobile/thanks";
            },
            error: function () {
                alert("操作失败，请刷新重试")
            }
        });
    }

});


function changeBlue(item) {
    item.css({"background": "url('" + png_path + "btn.png') no-repeat left top 0", "background-size": "cover"});
}
function changeWhite(item) {
    item.css({"background": "url('" + png_path + "btn.png') no-repeat left top -1.35rem", "background-size": "cover"})
}