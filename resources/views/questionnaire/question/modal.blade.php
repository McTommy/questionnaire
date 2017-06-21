@section('modal')
    <!--模态框开始-->
    <!--模态框-->
    <!--创建问题模态框-->
    <div class="modal fade creat_question_box" id="modal-question" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><strong>创建问题</strong></h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="box_question form-group">
                            <p>请输入问题</p>
                            <input  class="input_question"  type="text" >
                            <p class="error_tips" style="display: none">*请输入问题</p>
                            <p>请输入问题位置序号</p>
                            <input  class="input_sort_num" type="text" >
                            <p class="error_tips" style="display: none">*请输入问题位置</p>
                            <p class="sort_tips" style="display:none;">当前共有<span>3</span>条问题，请输入小于等于<span>4</span>且大于0的正整数</p>
                            <div class="must_radio">
                                <label>
                                    <input type="checkbox" name="must" class="must" checked>
                                    必填
                                </label>
                            </div>
                            <p>请选择问题勾选方式</p>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="单选" class="single_radio" checked>
                                    单选
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" class="multiple_radio" value="多选">
                                    多选
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios3" class="fill_radio" value="填空">
                                    填空
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios4" class="array_radio" value="矩阵单选题">
                                    矩阵单选题
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios5" class="rank_radio" value="矩阵量表题">
                                    矩阵量表题
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios6" class="explain_radio" value="段落说明">
                                    段落说明
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="question_submit btn btn-primary">确认</button>
                    <button  type="button" class="cancel btn btn-black">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!--编辑问题模态框-->
    <div class="modal fade edit_question_box" id="modal-edit-question" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><strong>编辑问题</strong></h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="box_edit_question form-group">
                            <p>请输入问题</p>
                            <input  class="input_question"  type="text" >
                            <p class="error_tips" style="display: none">*请输入问题</p>
                            <p>请输入问题位置序号</p>
                            <input  class="input_sort_num" type="text" >
                            <p class="error_tips" style="display: none">*请输入问题序号</p>
                            <p class="sort_tips" style="display:none;">当前共有<span>3</span>条问题，请输入小于等于<span>4</span>且大于0的正整数</p>
                            <!--<p>请选择问题勾选方式</p>-->
                            <!--<div class="radio">-->
                            <!--<label>-->
                            <!--<input type="radio" name="optionsRadios" id="optionsRadios3" class="single_radio" value="单选" autocomplete="off">-->
                            <!--单选-->
                            <!--</label>-->
                            <!--</div>-->
                            <!--<div class="radio">-->
                            <!--<label>-->
                            <!--<input type="radio" name="optionsRadios" id="optionsRadios4" class="multiple_radio" value="多选" autocomplete="off">-->
                            <!--多选-->
                            <!--</label>-->
                            <!--</div>-->
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="edit_question_submit btn btn-primary">确认</button>
                    <button  type="button" class="cancel btn btn-black">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!--创建答案模态框-->
    <div class="modal fade creat_answer_box" id="modal-creat-answer" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">创建答案</h4>
                </div>
                <div class="modal-body">
                    <h5><strong>问题：</strong></h5>
                    <div class="creat_answer_box_question"></div>
                    <div class="creat_answer_box_choice"><strong>勾选形式：</strong><span>多选</span></div>
                    <p>请输入问题答案选项及排列序号</p>
                    <div class="form-group">
                        <input class="input_answer" type="text" placeholder="请输入答案选项" AUTOCOMPLETE="off">
                        <input class="input_answer_num" type="text" placeholder="位置序号" AUTOCOMPLETE="off">
                        <button type="button" class="confirm_add btn btn-primary">确认添加</button>
                    </div>
                    <div>
                        <div class="answer_error_tips" style="display:none;">*请输入答案内容</div>
                        <div class="sort_error_tips" style="display:none;">*当前有<span>2</span>个答案，请输入小于<span>3</span>的正整数</div>
                    </div>
                    <div class="add_other">添加「其他」项</div>
                    <div class="max_choose_box" style="display: none">
                        <label>最多可选</label>
                        <select class="max_choose">
                            <!--<option>不限</option>-->
                            <!--<option>1</option>-->
                            <!--<option>2</option>-->
                        </select>
                    </div>
                    <div class="answer_content">
                        <table class="table table-bordered" style="word-break:break-all;">
                            <thead>
                            <tr>
                                <th>序号</th>
                                <th>答案选项</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--<tr>-->
                            <!--<td>1</td>-->
                            <!--<td>ssssssss</td>-->
                            <!--<td>-->
                            <!--<div class="btn btn-default btn_box_delete_answer">删除</div>-->
                            <!--</td>-->
                            <!--</tr>-->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="creat_answer_submit btn btn-primary">确认</button>
                    <button  type="button" class="cancel btn btn-black">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!--配置矩阵单选模态框-->
    <div class="modal fade config_single_box" id="modal-config-single" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><strong>配置选项</strong></h4>
                </div>
                <div class="modal-body">
                    <h5><strong>问题：</strong></h5>
                    <div class="config_single_box_question"></div>
                    <h5><strong>形式：</strong></h5>
                    <div class="config_single_box_choice"></div>
                    <div class="question_manage">
                        <p>问题管理</p>
                        <div class="question_manage_content">
                            <div>
                                <input placeholder="问题"><span>&times;️</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary add_question_manage">新建问题</button>
                    </div>
                    <div class="option_manage">
                        <p>选项管理</p>
                        <div class="option_manage_content">
                            <div>
                                <input placeholder="选项"><span>&times;️</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary add_option_manage">新建选项</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="config_option_submit btn btn-primary">确认</button>
                    <button  type="button" class="cancel btn btn-black">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!--配置矩阵量表模态框-->
    <div class="modal fade config_rank_box" id="modal-config-rank" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><strong>配置选项</strong></h4>
                </div>
                <div class="modal-body">
                    <h5><strong>问题：</strong></h5>
                    <div class="config_rank_box_question"></div>
                    <h5><strong>形式：</strong></h5>
                    <div class="config_rank_box_choice"></div>
                    <div class="pro_manage">
                        <p>问题管理</p>
                        <div class="pro_manage_content">
                            <div>
                                <input placeholder="问题"><span>&times;️</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary add_pro_manage">新建问题</button>
                    </div>
                    <div class="rank_manage">
                        <p>量表管理</p>
                        <div class="rank_manage_content">
                            <label>量表类型</label>
                            <select class="form-control rank_type">
                                <option>满意度</option>
                                <option>认同度</option>
                                <option>重要度</option>
                                <option>愿意度</option>
                                <option>符合度</option>
                            </select>
                            <label>量表范围</label>
                            <input type="text" id="spinner" class="rank_range"/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="config_rank_submit btn btn-primary">确认</button>
                    <button  type="button" class="cancel btn btn-black">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!--编辑答案模态框-->
    <div class="modal fade edit_answer_box" id="modal-edit-answer" aria-hidden='true' data-backdrop='static'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><strong>编辑答案</strong></h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="box_edit_answer form-group">
                            <p>请输入问题</p>
                            <input  class="input_answer"  type="text" >
                            <p class="error_tips" style="display: none">*请输入答案</p>
                            <p>请输入答案位置序号</p>
                            <input  class="input_sort_num" type="text" >
                            <p class="error_tips" style="display: none">*请输入答案序号</p>
                            <p class="sort_tips" style="display:none;">当前共有<span>3</span>条答案，请输入小于等于<span>4</span>且大于0的正整数</p>
                        </div>
                        <input type="checkbox" class="jump_que"> 跳题
                        <div class="jump" style="display: none">
                            <label>请选择要跳转到的题目</label>
                            <input type="text">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="edit_answer_submit btn btn-primary">确认</button>
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
                <div class="modal-body">
                    <p>确认删除当前问题？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="delete_submit btn btn-primary">确认</button>
                    <button  type="button" class="cancel btn btn-black">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!--模态框结束-->
@endsection