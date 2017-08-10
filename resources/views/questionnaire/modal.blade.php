@section('modal')
    <div class="modal fade creat_questionnaire_box" id="modal-questionnaire" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><strong>创建调查问卷</strong></h4>
                </div>
                <div class="modal-body">

                    <form class="form_title" method="post" action="{{ url('questionnaire') }}">
                        {{ csrf_field() }}
                        <p>请输入调查问卷名称</p>
                        <div class="box_title form-group">
                            <input  class="input_title" name="title" type="text">
                        </div>
                        <p class="error_tips" style="display: none">*请输入问卷名</p>
                        <p>请输入调查问卷英文名称(可通过questionnaire/show/此英文名 访问问卷填写端, 可为空)</p>
                        <div class="box_title form-group">
                            <input  class="input_title questionnaire_en_name" name="en_name" type="text">
                        </div>
                        <p class="en_name_error" style="display: none">*此英文名已存在</p>
                        <p class="en_name_type_error" style="display: none">*请保证输入全为英文</p>
                        <div class="questionnaire_author">
                            <p>请输入问卷作者（可为空）</p>
                            <input class="input_author" type="text" name="author">
                        </div>
                        <div class="sub_title">
                            <p>请输入问卷副标题（可为空）</p>
                            <input class="input_sub_title" type="text" name="sub_title">
                        </div>
                        <p>请输入调查问卷备注</p>
                        <div class="box_title form-group">
                            <input  class="input_title" name="comment" type="text">
                        </div>
                        <div class="frm_box">
                            <label>请选择调查问卷活动时间范围</label>
                            <div class="time_range">
                                <input type="text" name="start_time" class="start_time" id="from" >
                                <span>至</span>
                                <input type="text" name="end_time" class="end_time" id="to" >
                            </div>
                        </div>
                        <p class="time_error_tips" style="display: none; color: #ff0000;">*请输入开始结束时间</p>
                        <div class="select_template">
                            <label for="template">请选择采用的模板（可为空）</label>
                            <select id="template" name="template">
                                <option value="" selected>空</option>
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}">{{ $template->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button id="submit" type="submit" style="display: none"></button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="questionnaire_submit btn btn-primary">确认</button>
                    <button  type="button" class="cancel btn btn-black">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!--确认删除模态框-->
    <div class="modal fade confirm_delete_box" id="modal-delete" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">提示</h4>
                </div>
                <form class="delete_questionnaire" action="" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="delete_questionnaire_button" type="submit" style="display: none">删除</button>
                </form>
                <div class="modal-body">
                    <p>确认删除当前问卷？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="delete_submit btn btn-primary">确认</button>
                    <button  type="button" class="cancel btn btn-black">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!--模态框结束-->
    <!--激活按钮模态框-->
    <div class="modal fade confirm_active_box" id="modal-active" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">激活问卷</h4>
                </div>
                <div class="modal-body">
                    <div class="frm_box">
                        <label>请选择新的问卷截止日期</label>
                        <div class="time_range">
                            <input type="text" name="end_time" class="new_end_time" id="new_to" >
                            {{--<input type="text" name="now" class="now_time" id="now" style="display: none">--}}
                        </div>
                    </div>
                    <p class="new_time_error_tips" style="display: none; color: #ff0000;">*请输入新的问卷结束时间</p>
                    <p class="time_range_error_tips" style="display: none; color: #ff0000;">*新的问卷结束时间必须大于当前时间</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="active_submit btn btn-primary">确认</button>
                    <button  type="button" class="cancel btn btn-black">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!--模态框结束-->
    <!--更改英文名模态框-->
    <div class="modal fade confirm_update_name_box" id="modal-update-name" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">更改英文名</h4>
                </div>
                <div class="modal-body">
                    <div class="box_title form-group">
                        <input  class="input_title update_en_name" name="en_name" type="text">
                    </div>
                    <p class="en_name_error" style="display: none">*此英文名已存在</p>
                    <p class="en_name_type_error" style="display: none">*请保证输入全为英文</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="update_name_submit btn btn-primary">确认</button>
                    <button  type="button" class="cancel btn btn-black">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!--模态框结束-->
    <!--获取url模态框-->
    <div class="modal fade get_c_url_box" id="modal-get-c-url" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">调查问卷地址</h4>
                </div>
                <div class="modal-body">
                    <div class="c_url">
                        <span class="url_detail"></span>
                    </div>
                    <div class="qrcode_png">
                    </div>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="cancel btn btn-black">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <!--模态框结束-->
@stop