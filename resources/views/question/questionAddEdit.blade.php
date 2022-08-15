@extends('layouts.master') 

@section('custom_css')
<style>
		.widget-body{
			min-height:400px;
		}
	</style>

@endsection

@section('content')
<div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="{{ URL::to('/') }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="#">Add Question</a>
                        </li>
                        
                    </ul>
                </div>
                <div class="page-body">
                   
                    <div style="margin-top: 10px;margin-left: 200px;" class="col-lg-8 col-sm-8 col-xs-12">
                       
                        
                        <div class="widget radius-bordered">
                                <div class="widget-header ">
                                    <span class="widget-caption">Add Question Form</span>
                                    
                                    <div class="widget-buttons">
                                        <a href="#" data-toggle="maximize">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                        <a href="#" data-toggle="collapse">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                        <a href="#" data-toggle="dispose">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            <div class="widget-body">
                                <div class="docs-example">
                                    <!-- <ul class="nav nav-tabs tabs-flat">
                                        <li class="active"><a href="#info-tab" data-toggle="tab">Dashbord</a></li>
                                        <li class=""><a href="#address-tab" data-toggle="tab">Ask Question</a></li>
                                    </ul> -->

                                    <form action="{{url('questions/save')}}" id="accountForm" method="post" class="form-horizontal bv-form" enctype="multipart/form-data"  novalidate="novalidate">
                                    @csrf
                                   

                                        <div class="tab-content tabs-flat">
                                            <div class="tab-pane active" id="address-tab">
                                            @if(!empty($questions))
                                            <input type="hidden" name="id" value="{{$questions->id}}">
                                            @endif
                                                <div class="form-group {{ $errors->has('qtitle') ? ' has-error' : '' }} has-feedback">
                                                    <label class="col-lg-4 control-label">Title<span class="red">*</span>:</label>
                                                    <div class="col-lg-8">
                                                    <input type="text"  name="qtitle"  value="@if(!empty($questions)) {{$questions->qtitle}} @else {{old('qtitle')}} @endif"   placeholder="Enter Title" class="form-control input-inline input-medium" >
                                                    @if ($errors->has('qtitle'))
                                        <span class="help-block">
                                  <strong>{{ $errors->first('qtitle') }}</strong>
                              </span>
                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group has-feedback">
                                                    <label class="col-lg-4 control-label">Category Name<span class="red">*</span>:</label>
                                                    <div class="col-lg-8">
                                                    <select class="form-control input-inline input-medium" type="text" name="qcategoryname">
                                        @if(!empty($questions))
                                            @foreach($categories as $category)
                                                <option @if($category->id==$questions->qcategoryname) selected @endif value="{{$category->id}}">{{$category->categoryname}}</option>
                                            @endforeach
                                        @else
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->categoryname}}</option>
                                            @endforeach
                                        @endif

                                    </select>

                                             </select>
                                            <div class="red">{{ $errors->first('categoryname') }}</div>
                                                    </div>
                                                </div>
 
                                        <div  class="form-group has-feedback">
                                            <label class="col-lg-4 control-label"> Content <span class="red">*</span> : </label>
                                            <div  class="col-lg-8">  
                                                    <div   class="widget-header bordered-bottom bordered-themeprimary">
                                                        
                                                        <div class="widget-buttons">
                                                            <a href="#" data-toggle="maximize">
                                                                <i class="fa fa-expand"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <div  class="widget-main no-padding">
                                                            
                                                            <textarea  id="summernote" name="qcontent">
                                    @if(!empty($questions->qcontent)) {{$questions->qcontent}} @else {{old('qcontent')}} @endif
                                    
                                </textarea>                                                     
                                       </div>         
                                        </div>                                           
                                        </div>       
                                                <div class="form-group has-feedback">
                                                    <label class="col-lg-4 control-label">Upload File<span class="red">*</span>:</label>
                                                    <div class="col-lg-8">
                                                
                                                    <input style="margin-top:0px" type="file"  name="ufile" value="@if(!empty($questions)) {{$questions->ufile}} @endif"     placeholder="Enter Files " class="form-control input-inline input-medium" >
                                <div class="red">{{ $errors->first('ufile') }}</div>
                                @if(!empty($questions->ufile)) {{$questions->ufile}} @endif
                                                    </div>
                                                </div>
                                                <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                                <label for="captcha" class="col-md-4 control-label">Captcha  <span class="red">*</span> :</label>
                                <div class="col-md-6">
                                    <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>
                                   
                                        <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>
                                    </div>
                                    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                @if ($errors->has('captcha'))
                                        <span class="help-block">
                                  <strong>{{ $errors->first('captcha') }}</strong>
                              </span>
                                    @endif
                                </div>
                                 </div>           
                                </div>
                                </div>
                                <div class="form-group has-feedback">  
                                            <div class="col-md-offset-5 col-md-6">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="reset" class="btn btn-danger reset">Cancel</button>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    @endsection

@section('custom_js')
<script src="assets/js/editors/wysiwyg/jquery.hotkeys.js"></script>
<script src="assets/js/editors/wysiwyg/prettify.js"></script>
<script src="assets/js/editors/wysiwyg/bootstrap-wysiwyg.js"></script>
<script>
    $(function () {
        function initToolbarBootstrapBindings() {
            var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                  'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                  'Times New Roman', 'Verdana'],
                  fontTarget = $('[title=Font]').siblings('.dropdown-menu');
            $.each(fonts, function (idx, fontName) {
                fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
            });
            $('a[title]').tooltip({ container: 'body' });
            $('.dropdown-menu input').click(function () { return false; })
                .change(function () { $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle'); })
            .keydown('esc', function () { this.value = ''; $(this).change(); });

            $('[data-role=magic-overlay]').each(function () {
                var overlay = $(this), target = $(overlay.data('target'));
                overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
            });
            if ("onwebkitspeechchange" in document.createElement("input")) {
                var editorOffset = $('#editor').offset();
                $('#voiceBtn').css('position', 'absolute').offset({ top: editorOffset.top, left: editorOffset.left + $('#editor').innerWidth() - 35 });
            } else {
                $('#voiceBtn').hide();
            }
        };
        function showErrorAlert(reason, detail) {
            var msg = '';
            if (reason === 'unsupported-file-type') { msg = "Unsupported format " + detail; }
            else {
                console.log("error uploading file", reason, detail);
            }
            $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
             '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        };
        initToolbarBootstrapBindings();
        $('.wysiwyg-editor').wysiwyg({ fileUploadError: showErrorAlert });
        window.prettyPrint && prettyPrint();
    });
</script>

<!--Summernote Scripts-->
<script src="assets/js/editors/summernote/summernote.js"></script>
<script>
    $('#summernote').summernote({ height: 150 });
</script>

    <script type="text/javascript">
       $(document).ready(function () {
           $(".btn-refresh").click(function(){
               $.ajax({
                   type: "POST",
                   url: "refresh_captcha",
                   dataType: "json",
                   data:{"_token": "{{ csrf_token() }}"},

                   success:function(data){
                       console.log('hello');
                       console.log(data.captcha);
                       $(".captcha span").html(data.captcha);
                       return false;
                   },
                   error: function (data) {
                       console.log("error", data);
                   }
               });
           });
       })
</script>
@endsection



