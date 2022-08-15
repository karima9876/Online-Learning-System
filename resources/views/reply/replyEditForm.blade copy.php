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
                            <a href="#">Add Reply</a>
                        </li>
                        
                    </ul>
                </div>
               
               
                
                <div class="page-body">
                   
                    <div style="margin-top: 10px;margin-left: 295px;" class="col-lg-6 col-sm-6 col-xs-12">
                       
                        
                        <div class="widget radius-bordered">
                                <div class="widget-header ">
                                    <span class="widget-caption">Update an Reply</span>
                                    
                                    
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
                                    

                                    <form action="{{url('replies/save').'?aaid='.$replies->id}}" id="accountForm" method="post" class="form-horizontal bv-form" enctype="multipart/form-data"  novalidate="novalidate">
                                    @csrf

                                        <div class="tab-content tabs-flat">
                                            <div class="tab-pane active" id="address-tab">
                                            @if(!empty($replies))
                            <input type="hidden" name="id" value="{{$replies->id}}">
                        @endif

                                            <div class="form-group has-feedback">
                                                    <label class="col-lg-4 control-label">Featured Image<span class="red">*</span>:</label>
                                                    <div class="col-lg-8">
                                                
                                                    <input style="margin-top:0px" type="file"  name="rfile" value="@if(!empty($replies->rfile)) {{$replies->rfile}} @endif" placeholder="Enter Files " class="form-control input-inline input-medium" >
                                <div class="red">{{ $errors->first('rfile') }}</div>
                                
                            
                                                    </div>
                                                   
                                                </div>
                                                
                                                
 
                                        <div  class="form-group has-feedback">
                                            <label class="col-lg-4 control-label"> Reply <span class="red">*</span> : </label>
                                            <div  class="col-lg-8">  
                                                    <div   class="widget-header bordered-bottom bordered-themeprimary">
                                                        
                                                        <div class="widget-buttons">
                                                            <a href="#" data-toggle="maximize">
                                                                <i class="fa fa-expand"></i>
                                                            </a>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                        <div  class="widget-main no-padding">
                                                            
                                                        <textarea  id="summernote" name="rcontent">
                                                        @if(!empty($replies->rcontent)) {{$replies->rcontent}} @endif
                                                        </textarea>
                                                          
                                                     
                                                     <div class="red">{{ $errors->first('rcontent') }}</div>
                                                            
                                                        </div>
 
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
                                            <button type="submit" class="btn btn-primary">Reply</button>
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



