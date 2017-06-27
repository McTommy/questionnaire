

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
function create_question_ajax(order, is_required, type, name, is_phone_number) {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/question/create_question",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "order":order,
            "is_required":is_required,
            "type":question_type(type),
            "name":name,
            "is_phone_number":arguments[4] ? arguments[4] : null
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            if(data.status == 200) alertShow("操作成功");
            else alertShow("操作失败，请刷新重试");
        },
        error:function () {
            alertShow("操作失败，请刷新重试")
        }
    })
}

//编辑问题ajax提交方法
function edit_question_ajax(input_num, input_question, is_required, old_order) {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/question/update_question",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "old_order":old_order,
            "order":input_num,
            "is_required":is_required,
            "name":input_question
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            if(data.status == 200) alertShow("操作成功");
            else alertShow("操作失败，请刷新重试");
        },
        error:function () {
            alertShow("操作失败，请刷新重试")
        }
    });
}

//删除问题ajax提交方法
function delete_question_ajax(order) {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/question/delete_question",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "order":order
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            if(data.status == 200) alertShow("操作成功");
            else alertShow("操作失败，请刷新重试");
        },
        error:function () {
            alertShow("操作失败，请刷新重试")
        }
    });
}

//创建单选多选多项填空选项的ajax方法
function create_single_multi_ajax(question_order, choice, max_num) {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/choice/create_choice",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "question_order":question_order,
            "choices":choice,
            "maximum_option":max_num
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            if(data.status == 200) alertShow("操作成功");
            else alertShow("操作失败，请刷新重试");
        },
        error:function () {
            alertShow("操作失败，请刷新重试")
        }
    });
}

//编辑单选多选多项填空选项的ajax方法
function edit_single_multi_ajax(question_order, old_order, order, content, jump_to) {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/choice/update_choice",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "question_order":question_order,
            "old_order":old_order,
            "order":order,
            "content":content,
            "jump_to":jump_to
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            if(data.status == 200) alertShow("操作成功");
            else alertShow("操作失败，请刷新重试");
        },
        error:function () {
            alertShow("操作失败，请刷新重试")
        }
    });
}

//删除单选多选多项填空的ajax方法
function delete_single_multi_ajax(question_order, order) {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/choice/delete_choice",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "question_order":question_order,
            "order":order
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            if(data.status == 200) alertShow("操作成功");
            else alertShow("操作失败，请刷新重试");
        },
        error:function () {
            alertShow("操作失败，请刷新重试")
        }
    });
}

//矩阵单选配置选项ajax方法
function create_matrix_single_ajax(question_order, que_array, option_array) {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/api/choice/configure_choice",
        data:{
            "questionnaire_id":$(".activity_info_id").text(),
            "question_order":question_order,
            "sub_question":que_array,
            "sub_choice":option_array,
            "type":4
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            if(data.status == 200) alertShow("操作成功");
            else alertShow("操作失败，请刷新重试");
        },
        error:function () {
            alertShow("操作失败，请刷新重试")
        }
    });
}

//矩阵量表创建配置选项ajax方法
function create_matrix_scale_ajax(question_order, pro_array, range, type) {
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
            "question_order":question_order,
            "sub_question":pro_array,
            "sub_choice":sub_choice,
            "type":5,
            "measure_word":type
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            if(data.status == 200) alertShow("操作成功");
            else alertShow("操作失败，请刷新重试");
        },
        error:function () {
            alertShow("操作失败，请刷新重试")
        }
    });
}

//矩阵单选 矩阵多选 删除行ajax方法
function delete_matrix_sub_question_ajax(question_order, order, ques_type) {
    $.ajax({
        // csrf-token
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/api/choice/delete_choice",
        data: {
            "questionnaire_id": $(".activity_info_id").text(),
            "question_order": question_order,
            "order": order,
            "type": ques_type
        },
        type: "post",
        dataType: "json",
        success: function (data) {
            if (data.status == 200) alertShow("操作成功");
            else alertShow("操作失败，请刷新重试");
        },
        error: function () {
            alertShow("操作失败，请刷新重试")
        }
    });
}


