/**
 * Created by yuejd on 2017/8/1.
 */


//-----------点击选择题目---------------
$(".choose_que").change(function () {

    var que_id = $(this).find("option:selected").attr("data-id");
    var que_order = $(this).find("option:selected").attr("data-order");
    var que_type = $(this).find("option:selected").attr("data-type");
    var $this = $(this);
    var questionnaire_id = $(".activity_info_id").text();

    var ans = $this.parents(".que_content").siblings(".anw_content");
    var chi = $this.parents(".que_content").siblings(".child_content");

    if (que_type == 4 || que_type == 5) {
        $.ajax({
            url:"/api/report/get_sub_questions",
            data:{
                question_order:que_order,
                questionnaire_id:questionnaire_id
            },
            type:"post",
            dataType:"json",
            success:function (data) {
                if (data.code == 200) {
                    childs = data.sub_questions;
                    chi.show();
                    chi.find(".choose_child").empty();
                    chi.find(".choose_child").append('<option disabled selected style="display:none;" value="0">请选择子题目</option>')
                    ans.find(".choose_anw").empty();
                    $.each(childs,function (item,value) {
                        chi.find(".choose_child").append("<option data-id='" + value['id'] + "'>"+value['order'] + "." + value['name'] +"</option>")
                    });
                } else {
                    alert(data.messages)
                }
            }
        });
    } else {
        $.ajax({
            url:"/api/report/get_choices",
            data:{
                question_id:que_id
            },
            type:"post",
            dataType:"json",
            success:function (data) {
                if (data.code == 200) {
                    choices = data.datas;
                    ans.find(".choose_anw").empty();
                    $.each(choices,function (item,value) {
                        ans.find(".choose_anw").append("<option data-id='" + value['id'] + "'>"+value['order'] + "." + value['content'] +"</option>")
                    });
                } else {
                    alert(data.messages);
                }

            }
        });
    }
});

//点击选择子题目
$(".choose_child").change(function () {
    var que_id = $(this).find("option:selected").attr("data-id");

    var ans = $(this).parents(".child_content").siblings(".anw_content");

    $.ajax({
        url:"/api/report/get_choices",
        data:{
            question_id:que_id
        },
        type:"post",
        dataType:"json",
        success:function (data) {
            if (data.code == 200) {
                choices = data.datas;
                ans.find(".choose_anw").empty();
                $.each(choices,function (item,value) {
                    ans.find(".choose_anw").append("<option data-id='" + value['id'] + "'>"+value['order'] + "." + value['content'] +"</option>")
                });
            } else {
                alert(data.messages);
            }

        }
    });
});


$(".search_result").click(function () {
    // 第一部分的获取的值
      var first_yes = $(".first_que input[type=radio]:checked").val();  //yes是1 ，no是0，没选是undifined
      var first_q = $(".first_que .choose_que option:selected").text();    //没选 是 请选择题目
      if($(".first_que .child_content").is(":visible")){
          var first_child = $(".first_que .choose_child option:selected").text();
      }
      var first_id = $(".first_que .choose_anw option:selected").attr("data-id");
      if (!first_id) {
          alert("请您选择第一个查询条件条件");
          return false;
      }

    // 第一个与或非
     var first_logic = $(".first_logic input[type=radio]:checked").val(); //yes是与 ，no是或，没选是undifined

    //第二部分的获取的值
    var second_yes = $(".second_que input[type=radio]:checked").val();  //yes是1 ，no是0，没选是undifined
    var second_q = $(".second_que .choose_que option:selected").text();    //没选 是 请选择题目
    if($(".second_que .child_content").is(":visible")){
        var second_child = $(".second_que .choose_child option:selected").text();
    }
    var second_id = $(".second_que .choose_anw option:selected").attr("data-id");

    // 第二个与或非
    var second_logic = $(".second_logic input[type=radio]:checked").val();

    //第三部分的获取的值
    var third_yes = $(".third_que input[type=radio]:checked").val();  //yes是1 ，no是0，没选是undifined
    var third_q = $(".third_que .choose_que option:selected").text();    //没选 是 请选择题目
    if($(".third_que .child_content").is(":visible")){
        var third_child = $(".third_que .choose_child option:selected").text();
    }
    var third_id = $(".third_que .choose_anw option:selected").attr("data-id");
    if (third_id && !second_id) {
        alert("请您选择第二个查询条件条件");
        return false;
    }
    //组织数据格式
    if (third_id) {
        datas = [
            {'is_non': 1-first_yes, 'choice_id': first_id},
            {'is_non': 1-second_yes, 'choice_id': second_id},
            {'is_non': 1-third_yes, 'choice_id': third_id}

        ];
        conditions = [first_logic, second_logic]
    } else if (!third_id && second_id) {
        datas = [
            {'is_non': 1-first_yes, 'choice_id': first_id},
            {'is_non': 1-second_yes, 'choice_id': second_id},

        ];
        conditions = [first_logic]
    } else {
        datas = [
            {'is_non': 1-first_yes, 'choice_id': first_id}
        ];
        conditions = []
    }
    $.ajax({
        url:"/api/report/simple_query",
        data:{
            'questionnaire_id':$(".activity_info_id").text(),
            'datas': datas,
            'conditions':conditions
        },
        type:"post",
        dataType:"json",
        success:function (data) {
           $(".result").text(data.number + '人')
        }
    });

});

//重置查询条件
$(".search_reset").click(function () {
    $(".choose_que").append('<option disabled selected style="display:none;" value="0">请选择题目</option>')


    $(".choose_child").empty();
    $(".child_content").hide();
    $(".choose_child").append('<option disabled selected style="display:none;" value="0">请选择子题目</option>')

    $(".choose_anw").empty();
    $(".choose_anw").append('<option disabled selected style="display:none;" value="0">请选择选项</option>')

    $(".yes_radio").trigger("click");
});
