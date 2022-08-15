@if (Session::has('sticky_error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span> </button>
        <h3 class="text-danger"><i class="fa fa-times-circle"></i> Error</h3>
        {!! Session::get('sticky_error') !!}
    </div>
@endif

@if (Session::has('sticky_success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span> </button>
        <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3>
        {!! Session::get('sticky_success') !!}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success">
        <h3 class="sunset"> {!! Session::get('success') !!} </h3>
    </div>
@endif

<div style="display:none" class="alert alert-danger m-t-sm error_message"></div>
<div style="display:none;" class="alert alert-success m-t-sm success_message"></div>
@if (Session::has('error_message'))
    <div class="alert alert-danger m-t-sm"><?php echo html_entity_decode(Session::get('error_message')); ?></div>
@endif
@if (Session::has('warning_message'))
    <div class="alert alert-warning m-t-sm">{{ Session::get('warning_message') }}</div>
@endif
@if (Session::has('success_message'))
    <div class="alert alert-success m-t-sm">{{ Session::get('success_message') }}</div>
@endif
@if (Session::has('delete'))
    <div class="alert alert-danger m-t-sm">{{ Session::get('delete') }}</div>
@endif

@if (Session::has('success'))
    <script>
        new Noty({
            type: 'success',
            theme: 'sunset',
            text: "{!! Session::get('success') !!}",
            timeout: 2000
        }).show();
    </script>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span> </button>
    <h3 class="text-danger"><i class="fa fa-times-circle"></i> Error</h3>
    <div>
        @foreach ($errors->all() as $error)
          <p>{!! $error !!}</p>
        @endforeach
    </div>
</div>
@endif

<script>

    // setTimeout(function(){
    //     $(".alert").delay(5000).slideUp(300);
    // });

    // setTimeout (function (){
    //     $('.alert').delay(5000).slideUp(300);
    // });
</script>
