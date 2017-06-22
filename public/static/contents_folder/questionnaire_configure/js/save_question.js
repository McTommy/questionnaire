
//问题类型转换为数字
function question_type(type) {
    switch (type) {
        case "单选":
            type_num = 1;
            break;
        case "多选":
            type_num = 2;
            break;
        case "填空":
            type_num = 3;
            break;
        case "矩阵单选题":
            type_num = 4;
            break;
        case "矩阵量表题":
            type_num = 5;
            break;
        case "段落说明":
            type_num = 6;
            break;
        case "多项填空题":
            type_num = 7;
            break;
    }
    return type_num;
}

//创建问题的ajax提交方法
function create_question_ajax() {
    var type = $(".creat_question_box .radio input:radio:checked").val();
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/question/create_question",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "order":$(".creat_question_box .input_sort_num").val(),
            "is_required":$(".must").is(":checked") == true ? 1 : 0,
            "type":question_type(type),
            "name":$(".creat_question_box .input_question").val()
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            alert("success")
        }
    })
}


//编辑问题ajax提交方法
// TODO::是否必填
function edit_question_ajax(input_num, input_question) {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/question/update_question",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "old_order":$(".edit_question_box").attr('data-id'),
            "order":input_num,
            // "is_required":$(".must").is(":checked") == true ? 1 : 0,
            "is_required":1,
            "name":input_question
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            alert("success")
        }
    });
}

//删除问题ajax提交方法
//TODO::提供data-id
function delete_question_ajax() {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/question/delete_question",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "order":$(".confirm_delete_box").attr('data-id')
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            alert("success")
        }
    });
}

//创建单选多选选项的ajax方法
function create_single_multi_ajax() {
    if($(".creat_answer_box_choice span").text() == "【多选】"){
        max_num_raw = $(".max_choose option:selected").val();
        max_num = max_num_raw == "不限" ? 0 : max_num_raw;
    } else {
        max_num = null;
    }
    var choice = [];
    $(".table tbody tr").each(function () {
        order = $(this).children('td:eq(0)').text();
        content = $(this).children('td:eq(1)').text();
        choice[order-1] = content;
    });
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/choice/create_choice",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "question_order":$(".creat_answer_box").attr("data-id"),
            "choices":choice,
            "maximum_option":max_num
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            alert("success")
        }
    });
}

//编辑单选多选选项的ajax方法
function edit_single_multi_ajax() {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/choice/update_choice",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "question_order":$("#modal-edit-answer").attr('table-id'),
            "old_order":$("#modal-edit-answer").attr('tr-id'),
            "order":$(".edit_answer_box .input_sort_num").val(),
            "content":$(".edit_answer_box .input_answer").val(),
            "jump_to":$(".jump input").val()
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            alert("success")
        }
    });
}

//删除单选多选的ajax方法
//TODO::提供对应该选项的定位数据
function delete_single_multi_ajax($this) {
    order = $this.parents("tr").attr('tr-id');
    question_order = $this.parents("table").attr('data-id');
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/choice/delete_choice",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "question_order":$this.parents("table").attr('data-id'),
            "order":$this.parents("tr").attr('tr-id')
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            alert("success")
        }
    });
}

//矩阵单选配置选项ajax方法
function create_matrix_single_ajax(que_array, option_array) {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/choice/configure_choice",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "question_order":$(this).parents(".modal").attr('data-id'),
            "sub_question":que_array,
            "sub_choice":option_array,
            "type":4
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            alert("success")
        }
    });
}


//矩阵量表创建配置选项ajax方法
function create_matrix_scale_ajax(pro_array, range, type) {
    sub_choice = [];
    for(var j=1;j<=range;j++){
        sub_choice.push(j);
    }
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/choice/configure_choice",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "question_order":$(this).parents(".modal").attr('data-id'),
            "sub_question":pro_array,
            "sub_choice":sub_choice,
            "type":5,
            "measure_word":type
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            alert("success")
        }
    });
}

//矩阵单选 矩阵多选 删除行ajax方法
function delete_matrix_sub_question_ajax($this) {
    order = $this.parents("tr").attr('tr-id');
    question_order = $this.parents("table").attr('data-id');
    ques_type = $this.parents("table").attr('data-type');
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/choice/delete_choice",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "question_order":$this.parents("table").attr('data-id'),
            "order":$this.parents("tr").attr('tr-id'),
            "type":ques_type
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            alert("success")
        }
    });
}

//单选多选 创建选项
// $(".creat_answer_box .creat_answer_submit").click(function () {
//    if($(".creat_answer_box_choice span").text() == "【多选】"){
//        max_num_raw = $(".max_choose option:selected").val();
//        max_num = max_num_raw == "不限" ? 0 : max_num_raw;
//    } else {
//        max_num = null;
//    }
//     var choice = [];
//    $(".table tbody tr").each(function () {
//        order = $(this).children('td:eq(0)').text();
//        content = $(this).children('td:eq(1)').text();
//        choice[order-1] = content;
//    });
//     $.ajax({
//         // csrf-token
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         url:"/api/choice/create_choice",
//         data:{
//             "questionnaire_id":$(".activity_info_id").text(),
//             "question_order":$(".creat_answer_box").attr("data-id"),
//             "choices":choice,
//             "maximum_option":max_num
//         },
//         type:"post",
//         dataType:"json",
//         success:function (data) {
//             alert("success")
//         }
//     });
// });

//单选多选编辑选项
// $(".edit_answer_box .edit_answer_submit").click(function () {
//     $.ajax({
//         // csrf-token
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         url:"/api/choice/update_choice",
//         data:{
//             "questionnaire_id":$(".activity_info_id").text(),
//             "question_order":$("#modal-edit-answer").attr('table-id'),
//             "old_order":$("#modal-edit-answer").attr('tr-id'),
//             "order":$(".edit_answer_box .input_sort_num").val(),
//             "content":$(".edit_answer_box .input_answer").val(),
//             "jump_to":$(".jump input").val()
//         },
//         type:"post",
//         dataType:"json",
//         success:function (data) {
//             alert("success")
//         }
//     });
// });

//删除问题
// $(".confirm_delete_box .delete_submit").click(function () {
//     $.ajax({
//         // csrf-token
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         url:"/api/question/delete_question",
//         data:{
//             "questionnaire_id":$(".activity_info_id").text(),
//             "order":$(".confirm_delete_box").attr('data-id')
//         },
//         type:"post",
//         dataType:"json",
//         success:function (data) {
//             alert("success")
//         }
//     });
// });
//编辑问题
$(".edit_question_box .edit_question_submit").click(function () {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/question/update_question",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "old_order":$(".edit_question_box").attr('data-id'),
            "order":$(".edit_question_box .input_sort_num").val(),
            // "is_required":$(".must").is(":checked") == true ? 1 : 0,
            "is_required":1,
            "name":$(".edit_question_box .input_question").val()
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            alert("success")
        }
    })
});


// 创建问题
$(".creat_question_box .question_submit").click(function () {
    var type = $(".creat_question_box .radio input:radio:checked").val();
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/question/create_question",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "order":$(".input_sort_num").val(),
            "is_required":$(".must").is(":checked") == true ? 1 : 0,
            "type":question_type(type),
            "name":$(".input_question").val()
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            alert("success")
        }
    })
});