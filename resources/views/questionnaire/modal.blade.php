@section('modal')
    <div class="modal fade creat_questionnaire_box" id="modal-questionnaire" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><strong>创建调查问卷</strong></h4>
                </div>
                <div class="modal-body">
                    <p>请输入调查问卷名称</p>
                    <form class="form_title" method="post" action="{{ url('questionnaire') }}">
                        {{ csrf_field() }}
                        <div class="box_title form-group">
                            <input  class="input_title" name="title" type="text" value="{{ old('title') }}">
                        </div>
                        <p class="error_tips" style="display: none">*请输入问卷名</p>
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
@stop