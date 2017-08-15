var stringsss = window.location.protocol + '//' + window.location.hostname + ':' + window.location.port;

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
        en_name = $(".questionnaire_en_name").val();
        var parent = /^[A-Za-z]+$/;
        if (en_name) {
            if (parent.test(en_name)) {
                $.ajax({
                    // csrf-token
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/questionnaire/verify_en_name",
                    data: {
                        "en_name": en_name
                    },
                    type: "post",
                    dataType: "json",
                    success: function (data) {
                        if (data.code != 200) {
                            $(".en_name_error").show();
                            $(".questionnaire_en_name").select();
                            return false;
                        }
                    },
                    error: function () {
                        alert("操作失败，请刷新重试")
                    }
                });
            } else {
                $(".en_name_type_error").show();
                $(".questionnaire_en_name").select();
                return false;
            }
        }
        var title = $(".input_title").val();
        var start_time = $(".start_time").val();
        var end_time = $(".end_time").val();
        if (title == "" || title == null) {
            $(".error_tips").show();
        } else if (start_time == "" || start_time == null || end_time == "" || end_time == null) {
            $(".time_error_tips").show();
        } else {
            $("#submit").trigger("click");
        }
    });

    //点击删除
    $(".template_list_table").delegate(".btn_delete", "click", function (event) {
        event.stopPropagation();
        var id = $(this).parents("tr").attr('data-id');
        $("#modal-delete .delete_questionnaire").attr('action', 'questionnaire/' + id);
        $("#modal-delete").modal("show");
    });

    //确认删除
    $(".modal .delete_submit").click(function () {
        $(".delete_questionnaire_button").trigger("click");
    });

    //点击激活
    $(".active_questionnaire").click(function () {
        id = $(this).parents('tr').attr('data-id');
        $("#modal-active").modal("show");
        $("#modal-active").attr('data-id', id);
    });

    //点击确认激活
    $(".active_submit").click(function () {

        var end_time = $(".new_end_time").val();
        if (end_time == "" || end_time == null) {
            $(".new_time_error_tips").show();
        } else {
            id = $("#modal-active").attr('data-id');
            $.ajax({
                // csrf-token
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/questionnaire/update_end_time",
                data: {
                    "id": id,
                    "new_time": end_time
                },
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.code == 200) {
                        alert("操作成功");
                        $(".close").trigger("click");
                        $("tr[data-id=" + id + "]").find(".questionnaire_end_time").text(data.message);
                        $("tr[data-id=" + id + "]").find(".active_questionnaire").attr("disabled", true);
                        $("tr[data-id=" + id + "]").find(".active_questionnaire").removeClass("active_questionnaire").attr("disabled")
                    }
                    else alert("操作失败，请刷新重试");
                },
                error: function () {
                    alert("操作失败，请刷新重试")
                }
            });
        }
    });

    //点击保存为模板按钮
    $(".toggle_template").click(function () {
        $this = $(this);
        text = $this.text();
        id = $(this).parents('tr').attr('data-id');
        $.ajax({
            // csrf-token
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/api/question/toggle_template",
            data: {
                "questionnaire_id": id
            },
            type: "post",
            dataType: "json",
            success: function (data) {
                if (data.code == 200) {
                    if (text == "已保存为模板") {
                        $this.text("保存为模板");
                    } else {
                        $this.text("已保存为模板");
                    }
                    alert("操作成功");
                } else {
                    alert("操作失败，请刷新重试");
                }
            },
            error: function () {
                alert("操作失败，请刷新重试")
            }
        });

    });

    //ajax查询英文名是否唯一
    $(".questionnaire_en_name").blur(function () {
        en_name = $(".questionnaire_en_name").val();
        var parent = /^[A-Za-z]+$/;
        if (en_name) {
            if (parent.test(en_name)) {
                $.ajax({
                    // csrf-token
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/questionnaire/verify_en_name",
                    data: {
                        "en_name": en_name
                    },
                    type: "post",
                    dataType: "json",
                    success: function (data) {
                        if (data.code != 200) {
                            $(".en_name_error").show();
                            $(".questionnaire_en_name").select();
                        }
                    },
                    error: function () {
                        alert("操作失败，请刷新重试")
                    }
                });
            } else {
                $(".en_name_type_error").show();
                $(".questionnaire_en_name").select();
            }
        }
    });

    //点击更改英文名
    $(".btn_update_en_name").click(function () {
        id = $(this).parents('tr').attr('data-id');
        $("#modal-update-name").modal("show");
        $("#modal-update-name").attr('data-id', id);
    });

    //点击确认更改英文名
    $(".update_name_submit").click(function () {
        id = $("#modal-update-name").attr('data-id');
        en_name = $(".update_en_name").val();
        var parent = /^[A-Za-z]+$/;
        if (en_name) {
            if (parent.test(en_name)) {
                $.ajax({
                    // csrf-token
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/questionnaire/update_en_name",
                    data: {
                        "en_name": en_name,
                        "id": id
                    },
                    type: "post",
                    dataType: "json",
                    success: function (data) {
                        if (data.code == 200) {
                            alert('更新成功');
                            $(".close").trigger("click");
                            $("tr[data-id=" + id + "]").find(".questionnaire_en_name").text(data.message);
                        } else {
                            $(".en_name_error").show();
                            $(".update_en_name").select();
                        }
                    },
                    error: function () {
                        alert("操作失败，请刷新重试")
                    }
                });
            } else {
                $(".en_name_type_error").show();
                $(".update_en_name").select();
            }
        }
    });

    //点击获取url
    $(".btn_get_c_url").click(function () {
        $("#modal-get-c-url").modal('show');
        $(".qrcode_png").empty();
        id = $(this).parents('tr').attr('data-id');
        $(".url_detail").text(stringsss + "/questionnaire/show/" + id);
        $.ajax({
            // csrf-token
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/api/questionnaire/get_c_qrcode",
            data: {
                "id": id
            },
            type: "post",
            dataType: "json",
            success: function (data) {
                qrcode = $.parseHTML(data.message);
                $(".qrcode_png").append(qrcode);
            }
        });
    });


    //---------------------活动时间选择(插件)----------------------
    $('#from').datepicker({
        duration: '',
        showTime: true,
        constrainInput: false,
        minDate: "+1D"
    });
    $('#to').datepicker({
        duration: '',
        showTime: true,
        constrainInput: false
    });
    $('#new_to').datepicker({
        duration: '',
        showTime: true,
        constrainInput: false,
        minDate: "+1D"
    });


});