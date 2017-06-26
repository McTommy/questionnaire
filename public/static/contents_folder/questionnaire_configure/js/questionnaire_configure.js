/**
 * Created by yuejd on 2017/4/10.
 */
window.onload = $(function () {

    //创建问题btn定位
    //点击选择手机号题目，在题目列表顶部出现
    $(".phone_num").click(function () {
        var $num = $(this);
        if($num.is(":checked")){
            $(".question_content").prepend("<table class='table table-bordered' id='phone_que'><thead><tr> <th>Q<span>1</span></th><th><span>请输入您的手机号" +
                "___________</span><span>【填空】</span><span style='color: red;'>*</span></th><th><div class='btn-group'>" +
                "<div class='btn btn-default btn_edit_question'>编辑</div> <div class='btn btn-default btn_delete_question'>删除</div> </div> </th> </tr> </thead><tbody></tbody></table>");
            sortQuestion();
            $num.attr("disabled",true)
        }
        //新增order为1的问题，题型为填空，必填
        create_question_ajax(1, 1, "填空", "请输入您的手机号____________________", 1);
    });
    //滑到下方时，创建问题按钮固定在顶部
    $(window).scroll(function () {
        var $btn =$(".creat_question_btn");
        var h = 261;
        var s =$(this).scrollTop();
        if(s>=h){
            $btn.addClass("fix");
        }else{
            $btn.removeClass("fix");
        }
    });

    //点击创建问题开始
    $(".creat_question_btn").click(function () {
        $("#modal-question").modal("show").find("input[type='text']").val("");
    });
    //点击确认创建问题
    $(".creat_question_box .question_submit").click(function () {
        var table_num= $(".question_content table").length;
        var input_order=$(".creat_question_box .input_sort_num").val();
        var table_order=input_order-2;
        var q_content=$(".creat_question_box .input_question").val();
        var singleOrMultipal= $(".creat_question_box .radio input:radio:checked").val();
        var must = $(".must").is(":checked");
        var star;
        if (must == true){
            star = "*" ;
        }else if(must == false){
            star = "";
        }
        if (q_content==""||q_content==null){
            $(".error_tips").show();
            $(".creat_question_box input").focus();
        }else {
            if(input_order<=table_num+1 && input_order>0){
                var is_required = must == true ? 1 : 0;
                if(input_order==1){
                    var $que_von = $(".question_content");
                    if(singleOrMultipal=="多选" || singleOrMultipal=="单选"){
                        var i = createAnswer("single",input_order,q_content,singleOrMultipal,star);
                        $que_von.prepend(i);
                    }else if(singleOrMultipal=="填空"){
                        i = createAnswer("txt",input_order,q_content,singleOrMultipal,star);
                        $que_von.prepend(i);
                    }else if(singleOrMultipal=="矩阵单选题"){
                        i = createAnswer("box",input_order,q_content,singleOrMultipal,star);
                        $que_von.prepend(i);
                    }else if(singleOrMultipal=="矩阵量表题"){
                        i = createAnswer("rank",input_order,q_content,singleOrMultipal,star);
                        $que_von.prepend(i);
                    }else if(singleOrMultipal=="段落说明"){
                        i=createAnswer("explain",input_order,q_content,singleOrMultipal,star);
                        $que_von.prepend(i);
                    }else if(singleOrMultipal=="多项填空题"){
                        i=createAnswer("mul_txt",input_order,q_content,singleOrMultipal,star);
                        $que_von.prepend(i);
                    }
                    //新增问题调用js
                    create_question_ajax(input_order, is_required, singleOrMultipal, q_content);

                    sortQuestion();//问题列表重新排序
                    $("#modal-question").modal("hide");
                } else{
                    var $que_content =  $(".question_content table:eq("+table_order+")");
                    if(singleOrMultipal=="多选" || singleOrMultipal=="单选"){
                        var i = createAnswer("single",input_order,q_content,singleOrMultipal,star);
                        $que_content.after(i);

                    }else if(singleOrMultipal=="填空"){
                        i = createAnswer("txt",input_order,q_content,singleOrMultipal,star);
                        $que_content.after(i);

                    }else if(singleOrMultipal=="矩阵单选题"){
                        i = createAnswer("box",input_order,q_content,singleOrMultipal,star);
                        $que_content.after(i);

                    }else if(singleOrMultipal=="矩阵量表题"){
                        i = createAnswer("rank",input_order,q_content,singleOrMultipal,star);
                        $que_content.after(i);
                    }else if(singleOrMultipal=="段落说明"){
                        i=createAnswer("explain",input_order,q_content,singleOrMultipal,star);
                        $que_content.after(i);
                    }else if(singleOrMultipal=="多项填空题"){
                        i=createAnswer("mul_txt",input_order,q_content,singleOrMultipal,star);
                        $que_content.after(i);
                    }

                    //新增问题调用js
                    create_question_ajax(input_order, is_required, singleOrMultipal, q_content);

                    //问题列表重新排序
                    sortQuestion();
                    $("#modal-question").modal("hide");
                }

            }else{
                $(".sort_tips").show().find("span:eq(0)").html(table_num).end().find("span:eq(1)").html(table_num+1);
                $(".input_sort_num").focus();
            }
        }
    });
    function createAnswer(option,order,content,choice,star) {
        if(option=="single"){
            var item =  "<table class='table table-bordered'><thead><tr> <th>Q<span>"+order+"</span></th><th><span>" +content+"" +
                "</span><span>【"+choice+"】</span><span style='color: red;' >"+star+"</span></th> <th> <div class='btn-group'> <div class='btn btn-default btn_creat_answer'>创建答案</div> " +
                "<div class='btn btn-default btn_edit_question'>编辑</div> <div class='btn btn-default btn_delete_question'>删除</div> </div> </th></tr></thead><tbody></tbody></table>";
        }else if(option =="txt"){
            item = "<table class='table table-bordered'><thead><tr> <th>Q<span>"+order+"</span></th><th><span>" +content+"" +
                "___________</span><span>【"+choice+"】</span><span style='color: red;'>"+star+"</span></th> <th> <div class='btn-group'>" +
                "<div class='btn btn-default btn_edit_question'>编辑</div> <div class='btn btn-default btn_delete_question'>删除</div> </div> </th> </tr> </thead><tbody></tbody></table>";
        }else if(option=="mul_txt"){
            item = "<table class='table table-bordered'><thead><tr> <th>Q<span>"+order+"</span></th><th><span>" +content+"" +
                "</span><span>【"+choice+"】</span><span style='color: red;'>"+star+"</span></th> <th> <div class='btn-group'><div class='btn btn-default btn_creat_answer'>创建答案</div>" +
                "<div class='btn btn-default btn_edit_question'>编辑</div> <div class='btn btn-default btn_delete_question'>删除</div> </div> </th> </tr> </thead><tbody></tbody></table>";
        }
        else if(option == "box"){
            item = "<table class='table table-bordered'><thead><tr> <th>Q<span>"+order+"</span></th><th><span>" +content+"" +
                "</span><span>【"+choice+"】</span><span style='color: red;'>"+star+"</span></th> <th> <div class='btn-group'> <div class='btn btn-default btn_config_option'>配置选项</div> " +
                "<div class='btn btn-default btn_edit_question'>编辑</div> <div class='btn btn-default btn_delete_question'>删除</div> </div> </th> </tr> </thead><tbody></tbody></table>";
        }else if(option =="rank"){
            item = "<table class='table table-bordered'><thead><tr> <th>Q<span>"+order+"</span></th><th><span>" +content+"" +
                "</span><span>【"+choice+"】</span><span style='color: red;'>"+star+"</span></th> <th> <div class='btn-group'> <div class='btn btn-default btn_config_rank'>配置选项</div> " +
                "<div class='btn btn-default btn_edit_question'>编辑</div> <div class='btn btn-default btn_delete_question'>删除</div> </div> </th> </tr> </thead><tbody></tbody></table>";
        }else if(option =="explain"){
            item = "<table class='table table-bordered'><thead><tr> <th>Q<span>"+order+"</span></th><th><span>" +content+"" +
                "</span><span>【"+choice+"】</span><span style='color: red;'>"+star+"</span></th> <th> <div class='btn-group'>" +
                "<div class='btn btn-default btn_edit_question'>编辑</div> <div class='btn btn-default btn_delete_question'>删除</div> </div> </th> </tr> </thead><tbody></tbody></table>";
        }
        return item;
    }

    //点击编辑问题
    $(".question_content").delegate("table .btn_edit_question","click",function () {
        setDataId();
        var $this=$(this);
        var table=$this.parents("table");
        var data_id=table.attr("data-id");
        $("#modal-edit-question").modal("show").attr("data-id",data_id);
        var current_in=table.find("th:eq(1)").find("span:eq(0)").html();
        $(".edit_question_box .input_question").val(current_in);
        $(".edit_question_box .input_sort_num").val(table.attr("data-id"));
        var must = table.find("thead th:eq(1) span:eq(2)").text();
        if(must=="*"){
            $(".edit_must").prop("checked",true);
        }else{
            $(".edit_must").prop("checked",false);
        }
    });

    //点击编辑问题中的确认
    $(".edit_question_box .edit_question_submit").click(function () {
        var table_num= $(".question_content table").length;
        var input_question=$(".edit_question_box .input_question").val();
        var input_num=$(".edit_question_box .input_sort_num").val();
        var data_id=parseInt($("#modal-edit-question").attr("data-id")) - 1;
        var table=$(".question_content table:eq("+data_id+")");
        // var singleOrMultipal= $(".edit_question_box .radio input:radio:checked").val();
        var must = $(".edit_must").prop("checked");
        if(input_num<=table_num && input_num>0){
            if(input_num==1){
                table.find("th:eq(1)").find("span:eq(0)").html(input_question);
                // table.find("th:eq(1)").find("span:eq(1)").html("【"+singleOrMultipal+"】");
                var $r_table= table.remove();
                $r_table.prependTo($(".question_content"))
                $("#modal-edit-question").modal("hide");
            }else{
                table.find("th:eq(1)").find("span:eq(0)").html(input_question);
                // table.find("th:eq(1)").find("span:eq(1)").html("【"+singleOrMultipal+"】");
                var $rr_table= table.remove();
                var input_new_num=input_num-2;
                $rr_table.insertAfter($(".question_content table:eq("+ input_new_num +")"));
                $("#modal-edit-question").modal("hide");
            }
            if(must==true){
                table.find("th:eq(1) span:eq(2)").remove();
                table.find("th:eq(1)").append("<span style='color:red'>*</span>");
            }else {
                table.find("th:eq(1) span:eq(2)").remove();
            }

            //编辑问题ajax
            var old_order = $(".edit_question_box").attr('data-id');
            var is_required = must == true ? 1 : 0;
            edit_question_ajax(input_num, input_question, is_required, old_order);

            setDataId();
            sortQuestion();
        }else{
            $(".sort_tips").find("span:eq(0)").html(table_num);
            $(".sort_tips").find("span:eq(1)").html(table_num);
            $(".sort_tips").show();
            $(".input_sort_num").focus();
        }

    });
    //点击创建问题结束
    // 点击删除单条问题
    $(".question_content").delegate("table .btn_delete_question","click",function () {
        setDataId();
        var $this=$(this);
        var data_id = $this.parents("table").attr("data-id");
        $("#modal-delete").modal("show").attr("data-id",data_id);
        $("#modal-delete").find(".modal-body p").html("确认删除当前问题？");
    });
    $(".confirm_delete_box .delete_submit").click(function () {
        var data_id = $(this).parents(".confirm_delete_box").attr("data-id");
        var $table =$(".question_content table:eq("+(data_id-1)+")");
        var id = $table.attr("id");

        delete_question_ajax(data_id);

        $table.remove();
        if(id=="phone_que"){
            $(".phone_num").attr("disabled",false).attr("checked",false);
        }
        sortQuestion();
        $("#modal-delete").modal("hide");
    });
    //点击创建答案
    $(".question_content").delegate("table .btn_creat_answer","click",function () {
        setDataId();
        var table=$(this).parents("table");
        var answer = table.find("tbody").html();
        var data_id=table.attr("data-id");
        $("#modal-creat-answer").modal("show").attr("data-id",data_id).find("input[type='text']").val("");
        var question=table.find("thead th:eq(1)").find("span:eq(0)").html();
        var choice=table.find("thead th:eq(1)").find("span:eq(1)").html();
        console.log(question);
        $(".creat_answer_box .creat_answer_box_question").text(question);
        $(".creat_answer_box .creat_answer_box_choice span").html(choice);
        if(choice=="【多项填空题】"){
            $(".add_other").hide();
        }else{
            $(".add_other").show();
        }
        if(choice=="【多选】"){
            $(".max_choose_box").show();
            $('.max_choose').empty().append("<option>不限</option>");
        }else {
            $(".max_choose_box").hide();
            $(".max_choose").empty();
        }

        if(answer ==""){
            $(".answer_content tbody").empty();
        }else{
            $(".answer_content tbody").html("");
            table.find("tbody tr").each(function (id,item) {
                var data = $(item).attr("data");
                var input_num = id+1;
                var input_anw = $(item).find("td:eq(1) span:eq(0)").text();
                if(choice=="【多选】"){
                    $(".max_choose").append("<option>"+(id+1)+"</option>");
                }
                $(".answer_content tbody").append("<tr data="+data+"><td>"+input_num+"</td> <td>"+input_anw+"</td> <td> <div class='btn btn-default btn_box_delete_answer'>删除</div> </td> </tr>");
            })

        }
        var state =judge();
        console.log(state)
        if(state==true){
            $(".add_other").css("color","#0096ff");
        }else{
            $(".add_other").css("color","#ccc");
        }

    });
    //结束创建答案

    //点击创建答案中的确认添加
    $(".creat_answer_box .confirm_add").click(function () {
        var input_anw=$(".creat_answer_box .input_answer").val();
        var input_num=$(".creat_answer_box .input_answer_num").val();
        var new_input_num=input_num-2;
        var tr_num=$(".creat_answer_box .answer_content tbody tr").length;
        var type = $(".creat_answer_box_choice span").text();
        if(input_anw=="" || input_anw==null){
            $(".creat_answer_box .answer_error_tips").show();
        }else {
            if (input_num<=tr_num+1 && input_num>0){
                if(input_num==1){
                    if(type =="【多项填空题】"){
                        $(".creat_answer_box .answer_content tbody").prepend("<tr><td>1</td> <td>"+input_anw+"________</td> <td> <div class='btn btn-default btn_box_delete_answer'>删除</div> </td> </tr>");

                    }else{
                        $(".creat_answer_box .answer_content tbody").prepend("<tr><td>1</td> <td>"+input_anw+"</td> <td> <div class='btn btn-default btn_box_delete_answer'>删除</div> </td> </tr>");

                    }
                }else {
                    if(type =="【多项填空题】"){
                        $(".creat_answer_box .answer_content tbody tr:eq("+new_input_num+")").after("<tr> <td>1</td> <td>"+input_anw+"________</td> <td> <div class='btn btn-default btn_box_delete_answer'>删除</div> </td> </tr>");

                    }else {
                        $(".creat_answer_box .answer_content tbody tr:eq("+new_input_num+")").after("<tr> <td>1</td> <td>"+input_anw+"</td> <td> <div class='btn btn-default btn_box_delete_answer'>删除</div> </td> </tr>");

                    }

                }
                if($(".max_choose_box").is(":visible")){
                    $(".max_choose").append("<option>"+(tr_num+1)+"</option>");
                }
                sortAnswer();
            }
            else {
                $(".creat_answer_box .sort_error_tips").show().find("span:eq(0)").html(tr_num).end().find("span:eq(1)").html(tr_num+1);
            }
        }
    });
    //结束创建答案中的确认添加
    //点击创建答案中的删除单个答案
    $(".answer_content").delegate("table tbody .btn_box_delete_answer","click",function () {
        var $tr = $(this).parents("tr");
        $tr.remove();
        sortAnswer();
        var data = $tr.attr("data");
        if(data){
            $(".add_other").css("color","#0096ff");
        }
        $(".max_choose option:last").remove();

    });
    $(".add_other").click(function () {
        var $this = $(this);
        var $tbody =  $(".creat_answer_box .answer_content tbody");
        var l = $tbody.find("tr").length;
        var state = judge();
        if (state==true){
            $tbody.append("<tr data='other'><td>"+(l+1)+"</td><td>其他___</td><td> <div class='btn btn-default btn_box_delete_answer'>删除</div></td></tr>");
            $(".max_choose").append("<option>"+(l+1)+"</option>");
            $this.css("color","#ccc");
        }
    });

    //点击确认创建答案
    $(".creat_answer_box .creat_answer_submit").click(function () {
        var data_id=$("#modal-creat-answer").attr("data-id")-1;
        var choice=  $(".creat_answer_box .creat_answer_box_choice span").html();
        var max_num = $(".max_choose option:selected").val();

        //创建单选多选多项填空选项的ajax方法
        if(!isNaN(max_num)){
            max_number = max_num == "不限" ? 0 : max_num;
        } else {
            max_number = null;
        }
        var choices = [];
        $(".creat_answer_box .table tbody tr").each(function () {
            order = $(this).children('td:eq(0)').text();
            content = $(this).children('td:eq(1)').text();
            if(choice == "【多项填空题】") choices[order-1] = content + "________";
            else choices[order-1] = content;
        });
        create_single_multi_ajax(data_id + 1, choices, max_number);

        if(choice=="【单选】"){
            $(".question_content table:eq("+ data_id +") tbody").empty();
            $(".answer_content tbody tr").each(function(index,item) {
                var answer=$(item).find("td:eq(1)").html();
                var data = $(item).attr("data");
                if(data){
                    $(".question_content table:eq("+ data_id +") tbody").append("<tr data = "+data+"><td><input type='radio' name='radio'> </td> <td><span>"+ answer +"</span></td> <td> <div class='btn btn-group'>" +
                        "<div class='btn btn-default btn_edit_answer'>编辑</div> <div class='btn btn-default btn_delete_answer'>删除</div></div></td> </tr>");
                }else{
                    $(".question_content table:eq("+ data_id +") tbody").append("<tr><td><input type='radio' name='radio'> </td> <td><span>"+ answer +"</span></td> <td> <div class='btn btn-group'>" +
                        "<div class='btn btn-default btn_edit_answer'>编辑</div> <div class='btn btn-default btn_delete_answer'>删除</div></div></td> </tr>");
                }
            });
            $(".question_content table:eq("+ data_id +") tbody tr").each(function (index,element) {
                $(element).attr("tr-id",index+1);
            });
            $("#modal-creat-answer").modal("hide");
        }
        if(choice =="【多项填空题】"){
            $(".question_content table:eq("+ data_id +") tbody").empty();
            $(".answer_content tbody tr").each(function(index,item) {
                var answer=$(item).find("td:eq(1)").html();
                var data = $(item).attr("data");
                if(data){
                    $(".question_content table:eq("+ data_id +") tbody").append("<tr data = "+data+"><td></td> <td><span>"+ answer +"</span></td> <td> <div class='btn btn-group'>" +
                        "<div class='btn btn-default btn_edit_answer'>编辑</div> <div class='btn btn-default btn_delete_answer'>删除</div></div></td> </tr>");
                }else{
                    $(".question_content table:eq("+ data_id +") tbody").append("<tr><td></td> <td><span>"+ answer +"</span></td> <td> <div class='btn btn-group'>" +
                        "<div class='btn btn-default btn_edit_answer'>编辑</div> <div class='btn btn-default btn_delete_answer'>删除</div></div></td> </tr>");
                }
            });
            $(".question_content table:eq("+ data_id +") tbody tr").each(function (index,element) {
                $(element).attr("tr-id",index+1);
            });
            $("#modal-creat-answer").modal("hide");
        }
        if(choice=="【多选】"){
            if(!isNaN(max_num)){
                $(".question_content table:eq("+ data_id +") i").remove();
                $(".question_content table:eq("+ data_id +") thead th:eq(1) span:last").before("<i>(最多可选<span>"+max_num+"</span>项) &nbsp;</i>");
            }else{
                $(".question_content table:eq("+ data_id +") i").remove();
            }
            $(".question_content table:eq("+ data_id +") tbody").empty();
            $(".answer_content tbody tr").each(function(index,item) {
                var answer=$(item).find("td:eq(1)").html();
                var data = $(item).attr("data");
                if(data){
                    $(".question_content table:eq("+ data_id +") tbody").append("<tr data = "+data+"><td><input type='checkbox'></td> <td><span>"+ answer +"</span></td><td><div class='btn btn-group'>" +
                        "<div class='btn btn-default btn_edit_answer'>编辑</div><div class='btn btn-default btn_delete_answer'>删除</div></div></td></tr>")
                }else{
                    $(".question_content table:eq("+ data_id +") tbody").append("<tr><td><input type='checkbox'></td><td><span>"+ answer +"</span></td><td><div class='btn btn-group'>" +
                        "<div class='btn btn-default btn_edit_answer'>编辑</div><div class='btn btn-default btn_delete_answer'>删除</div></div></td></tr>")
                }
            });
            $(".question_content table:eq("+ data_id +") tbody tr").each(function (index,element) {
                $(element).attr("tr-id",index+1);
            });
            $("#modal-creat-answer").modal("hide");
        }
    });
    function judge() {
        var $tbody =  $(".creat_answer_box .answer_content tbody");
        var state = true;
        $tbody.find("tr").each(function () {
            var data = $(this).attr("data");
            if (data=="other"){
                console.log("有other")
                state = false ;
                return false;
            }
        });
        return state;
    }
    //点击编辑答案
    $(".question_content").delegate("table tbody .btn_edit_answer","click",function () {
        var tr=$(this).parents("tr");
        var table=$(this).parents("table");
        var cur_answer=tr.find("td:eq(1) span:eq(0)").text();
        var table_id=table.attr("data-id");
        var choice = table.find("th:eq(1) span:eq(1)").text();
        if(choice=="【单选】"){
            $(".jump_content").show();
        }else{
            $(".jump_content").hide();
        }
        table.find("tbody tr").each(function (index,element) {
            $(element).attr("tr-id",index+1);
        });
        var tr_id=tr.attr("tr-id");
        $("#modal-edit-answer").modal("show").attr({"table-id":table_id,"tr-id":tr_id});
        $(".edit_answer_box .input_answer").val(cur_answer);
        $(".edit_answer_box .input_sort_num").val(tr_id);
        $(".jump input").val("");
        $(".jump_error_tips").hide();
        $(".jump_que").attr("checked",false);
        $(".jump").hide();


    });
    $(".jump_que").click(function () {
        if($(this).is(":checked")){
            $(".jump").show();
        }else {
            $('.jump').hide();
        }
    });
    //点击编辑答案中的确定
    $(".edit_answer_box .edit_answer_submit").click(function () {
        var table_id=$("#modal-edit-answer").attr("table-id") - 1;
        var table=$(".question_content table:eq("+table_id+")");
        var tr_id=$("#modal-edit-answer").attr("tr-id")-1;
        var tr=table.find("tbody tr:eq("+tr_id+")");
        var tr_num= table.find("tbody tr").length;
        var input_answer=$(".edit_answer_box .input_answer").val();
        var input_num=$(".edit_answer_box .input_sort_num").val();
        var jump = $(".jump input").val();
        var l =$(".question_content table").length;
        if(input_num<=tr_num && input_num>0){

            //编辑单选多选多项填空选项的ajax方法
            jump_to = $(".jump_que").is(":checked") ? $(".jump input").val() : null;
            if((jump_to<=l &&jump_to>table_id+1) || jump_to==0 || jump_to==null) {
                edit_single_multi_ajax(table_id + 1, tr_id + 1, input_num, input_answer, jump_to);
            }

            if(input_num==1){
                tr.find("td:eq(1) span").text(input_answer);
                var $r_tr= tr.remove();
                $r_tr.prependTo($(table).find("tbody"));
                table.find("tbody tr").each(function (index,element) {
                    $(element).attr("tr-id",index+1);
                });
                if($(".jump_que").is(":checked")){
                    if(jump<=l &&jump>table_id+1){
                        tr.find("td:eq(1) span:eq(1)").remove();
                        tr.find("td:eq(1) span").after("<span style='color: #00bfd7'>(跳转到第<span>"+jump+"</span>题）</span>");
                    }else if(jump==0){
                        tr.find("td:eq(1) span:eq(1)").remove();
                        tr.find("td:eq(1) span").after("<span style='color: #00bfd7'>(跳转到最后）</span>");
                    }
                    else{
                        $(".jump_error_tips").show().find("span").text(l).end().find("span:eq(1)").text(table_id+2);
                        return false
                    }
                }
                else {
                    tr.find("td:eq(1) span:eq(1)").remove();
                }
            }else{
                tr.find("td:eq(1) span").text(input_answer);
                var $rr_tr= tr.remove();
                var input_new_num=input_num-2;
                $rr_tr.insertAfter($(table).find("tbody tr:eq("+input_new_num+")"));
                table.find("tbody tr").each(function (index,element) {
                    $(element).attr("tr-id",index+1);
                });
                if($(".jump_que").is(":checked")){
                    if(jump<=l &&jump>table_id+1){
                        tr.find("td:eq(1) span:eq(1)").remove();
                        tr.find("td:eq(1) span").after("<span style='color: #00bfd7'>(跳转到第<span>"+jump+"</span>题）</span>");
                    }else if(jump==0){
                        tr.find("td:eq(1) span:eq(1)").remove();
                        tr.find("td:eq(1) span").after("<span style='color: #00bfd7'>(跳转到最后）</span>");
                    }else{
                        $(".jump_error_tips").show().find("span").text(l).end().find("span:eq(1)").text(table_id+2);
                        return false
                    }

                }else {
                    tr.find("td:eq(1) span:eq(1)").remove();
                }
            }
            $("#modal-edit-answer").modal("hide");
        }else{
            $(".sort_tips").show().find("span").html(tr_num);
            $(".input_sort_num").focus();
        }


    });
    //点击答案中的删除
    $(".question_content").delegate("table tbody .btn_delete_answer","click",function (){
        var $this=$(this);
        $("#modal-delete-choice").modal("show");
        $("#modal-delete-choice").find(".modal-body p").html("确认删除当前答案？");
        $(".confirm_delete_choice_box .delete_choice_submit").click(function () {

            //矩阵单选 矩阵多选 删除行ajax方法
            //删除单选多选多项填空的ajax方法
            question_order = $this.parents("table").attr('data-id');
            order = $this.parents("tr").attr('tr-id');
            type = $this.parents("table").find("thead tr th:eq(1) span:eq(1)").text();
            if(type == "【矩阵单选题】" || type == "【矩阵量表题】") {
                ques_type = type == "【矩阵单选题】" ? 4 : 5;
                delete_matrix_sub_question_ajax(question_order, order, ques_type)
            } else {
                delete_single_multi_ajax(question_order, order);
            }

            $this.parents("tr").remove();
            $("#modal-delete-choice").modal("hide");
        });
    });

    //结束确认答案

    //点击配置矩阵单选题的配置选项按钮
    $(".question_content").delegate(".btn_config_option","click",function () {
        setDataId();
        var data_id = $(this).parents('table').attr("data-id");
        var table=$(this).parents("table");
        var question=table.find("thead th:eq(1)").find("span:eq(0)").html();
        var choice=table.find("thead th:eq(1)").find("span:eq(1)").html();
        $(".config_single_box_question").text(question);
        $(".config_single_box_choice").text(choice);
        $("#modal-config-single").modal("show") ;
        $("#modal-config-single").attr("data-id",data_id);
        //初始化模态框，后期有时间加回填
        $(".question_manage_content,.option_manage_content").html("");
        addContent("que",".question_manage_content"); addContent("op",".option_manage_content");
    });
    //点击配置选项中的新建问题
    $(".add_question_manage").click(function () {
        addContent("que",".question_manage_content");
    });
    //点击配置选项中的新建选项
    $(".add_option_manage").click(function () {
        addContent("op",".option_manage_content");
    });
    $('.question_manage_content,.option_manage_content,.pro_manage_content').delegate("span","click",function () {
        $(this).parent("div").remove();
    });
    //点击配置矩阵单选题模态框中的确定按钮
    $(".config_option_submit").click(function () {
        var que_array = [],option_array = [];
        var id = $(this).parents(".modal").attr('data-id');
        var state = ""
        $(".question_manage_content input").each(function (id,item) {
            var que = $(this).val();
            if(que==""||que==null){
                $(this).focus();
                state= false;
            }else {
                que_array.push(que);state= true;
            }

        });
        $(".option_manage_content input").each(function (id,item) {
            var option = $(this).val();
            if(option==""||option==null){
                $(this).focus();
                state = false;
            }else {
                option_array.push(option);state= true;
            }

        });
        var $table = $(".question_content table:eq("+parseInt(id-1)+")");
        var length = option_array.length;
        if(state==true){

            //矩阵单选配置选项ajax方法
            question_order = $("#modal-config-single").attr("data-id");
            create_matrix_single_ajax(question_order, que_array, option_array);

            $table.find("tbody").empty().append('<tr> <td></td>'+
                '<td class="span_group"></td></tr>');
            $.each(option_array,function (id,item) {
                $table.find("tbody .span_group").append("<span>"+item+"</span>");
            });
            $.each(que_array,function (id,item) {
                $table.find("tbody").append('<tr tr-id="'+(id+1)+'"><td>'+item+'</td> <td class="radio_group"></td><td>' +
                    '<div class="btn btn-group">' +
                    '<div class="btn btn-default btn_delete_answer">删除</div>' +
                    '</div> </td></tr>');

            });
            for (var i= 0;i<length;i++){
                $table.find(".radio_group").append('<input type="radio" disabled>');
            }
            $("#modal-config-single").modal("hide");
        }
    });
    //点击配置量表题
    $(".question_content").delegate(".btn_config_rank","click",function () {
        setDataId();
        var data_id = $(this).parents('table').attr("data-id");
        var table=$(this).parents("table");
        var question=table.find("thead th:eq(1)").find("span:eq(0)").html();
        var choice=table.find("thead th:eq(1)").find("span:eq(1)").html();
        $(".config_rank_box_question").text(question);
        $(".config_rank_box_choice").text(choice);
        $("#modal-config-rank").modal("show") ;
        $("#modal-config-rank").attr("data-id",data_id);
        //初始化模态框，后期有时间加回填
        $(".pro_manage_content").html("");
        $(".ui-spinner-input").val("5")
        addContent("que",".pro_manage_content");

    });
    //点击配置选项中的新建问题
    $(".add_pro_manage").click(function () {
        addContent("que",".pro_manage_content");
    });
    //点击配置矩阵量表题模态框中的确定按钮
    $(".config_rank_submit").click(function () {
        var pro_array = [];
        var type = $(".rank_type option:selected").val();
        var range = $(".rank_range").val();
        var txt = type.substring(0,2);
        var state='';
        var id = $(this).parents(".modal").attr('data-id');
        var $table = $(".question_content table:eq("+parseInt(id-1)+")");
        $(".pro_manage_content input").each(function (id,item) {
            var pro = $(item).val();
            if(pro==""||pro==null){
                $(this).focus();
                state= false;
            }else {
                pro_array.push(pro);
                state = true;
            }
        });
        if(state==true){

            //矩阵量表创建配置选项ajax方法
            question_order = $("#modal-config-rank").attr("data-id");
            create_matrix_scale_ajax(question_order, pro_array, range, txt);

            $table.find("tbody").empty().append('<tr>'+
                '<td> </td>'+
                '<td class="rank_span"><span>非常不'+txt+'</span><span>非常'+txt+'</span> </td>'+
                '<td></td>'+
                '</tr>');
            $.each(pro_array,function (id,item) {
                $table.append('<tr>'+
                    '<td>'+item+'</td>'+
                    '<td class="rank_radio"></td>'+
                    '<td>'+
                    '<div class="btn btn-group">'+
                    '<div class="btn btn-default btn_delete_answer">删除</div>'+
                    '</div>'+
                    '</td>'+
                    '</tr>');
            });
            for(var i=0;i<range;i++){
                $table.find(".rank_radio").append('<input type="radio" disabled>'+(i+1)+'');
            }
            $(".config_rank_box").modal("hide");


        }

    });

    function addContent(con,classname) {
        if (con=="que"){
            var que =  '<div><input placeholder="问题"><span>&times;️</span></div>';
        }else {
            que = '<div><input placeholder="选项"><span>&times;️</span></div>';
        }
        $(classname).append(que);

    }
    //点击取消
    $(".modal .cancel").click(function () {
        $(".close").trigger("click");
    });

    //答案列表序号重排
    function sortAnswer() {
        $(".answer_content table tbody tr").each(function (index) {
            $(".answer_content table tbody tr:eq("+index+")").find("td:first").html(index+1);
        })
    }

    //文字个数动态查询
    $(".input_num_limit,.input_question,.input_sort_num,.input_answer,.input_answer_num").keyup(function () {
        var num= $(this).val().length;
        $(".input_num").text(num);
        if(num>0){
            $(".error_tips").hide();
            $(".sort_tips").hide();
            $(".answer_error_tips").hide();
            $(".sort_error_tips").hide();
        }
    });
    //给每个问题列表加个data-id
    function setDataId() {
        $(".question_content table").each(function (index,element) {
            $(element).attr("data-id",index+1);
        });
    }

    //问题列表序号重排
    function sortQuestion() {
        $(".question_content table").each(function (index) {
            $(".question_content table:eq("+index+")").find("thead").find("th:first").find("span").html(index+1)
        })
    }

    $("#spinner").spinner({
        min:1,
        max:10
    });
    //点击完成创建, 传数据
    $(".finish-creat .finish").click(function () {
        alertShow("保存成功")
    });
});


