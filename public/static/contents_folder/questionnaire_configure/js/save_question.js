
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
// $(".edit_question_box .edit_question_submit").click(function () {
//     $.ajax({
//         // csrf-token
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         url:"/api/question/update_question",
//         data:{
//             "questionnaire_id":$(".activity_info_id").text(),
//             "old_order":$(".edit_question_box").attr('data-id'),
//             "order":$(".input_sort_num").val(),
//             // "is_required":$(".must").is(":checked") == true ? 1 : 0,
//             "is_required":1,
//             "name":$(".input_question").val()
//         },
//         type:"post",
//         dataType:"json",
//         success:function (data) {
//             alert("success")
//         }
//     })
// });



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