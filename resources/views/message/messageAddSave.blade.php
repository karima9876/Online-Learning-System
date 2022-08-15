
@extends('layouts.master') 

@section('custom_css')
    <!-- CSS Just for demo purpose, don't include it in your project -->

    <title>Message</title>
    <link rel="stylesheet" href="{{asset('phq/message/font-awesome.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('phq/message/bootstrap.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('phq/message/chat.css')}}">
    <style>
        .online{
            position: relative;
            height: 15px;
            width:15px;
            float: left;
            right: 25px;
            background-color: #4cd137;
            border-radius: 50%;
            border:1.5px solid white;
        }
        .offline{
            position: relative;
            height: 15px;
            width:15px;
            float: left;
            right: 25px;
            background-color: #d13a3c;
            border-radius: 50%;
            border:1.5px solid white;
        }
        .chat_date{
            float: right;
        }
        .chat_list{
            cursor: pointer;
        }
        
		
	
    </style>

@endsection
@section('content')

    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
    <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="{{ URL::to('/') }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="#">Message</a>
                        </li>
                    </ul>
                </div>

    <div class="container">
        {{--<h3 class=" text-center">Messaging</h3>--}}
        <div class="messaging">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
{{--                            <h4>Recent</h4>--}}
                        </div>
                        <div class="srch_bar">
                            <div class="stylish-input-group">
                                <form method="post"  action="{{url('messSL')}}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <input type="text" name="searchMP" class="search-bar"  placeholder="Search" >
{{--                                <span class="input-group-addon">--}}
                                 <button  type="submit"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                                </form>

                                {{--                </span> --}}
                            </div>
                        </div>
                    </div>
                    {{--                <a href="http://example.com">--}}
                    <div class="inbox_chat" >
                        @if(isset($online[0]))
                            @foreach($online as $online_user)
{{--                                @if(\Illuminate\Support\Facades\Auth::id()&&\Illuminate\Support\Facades\Auth::id()!=$online_user->id)--}}

                                    <?php


                                    $id = auth()->id();
                                    $onlmessage = DB::select('
        SELECT t1.*
        FROM message_models AS t1
        INNER JOIN
        (
            SELECT
                LEAST(fuser_id, tuser_id) AS fuser_id,
                GREATEST(fuser_id, tuser_id) AS tuser_id,
                MAX(id) AS max_id
            FROM message_models
            GROUP BY
                LEAST(fuser_id, tuser_id),
                GREATEST(fuser_id, tuser_id)
        ) AS t2
            ON LEAST(t1.fuser_id, t1.tuser_id) = t2.fuser_id AND
               GREATEST(t1.fuser_id, t1.tuser_id) = t2.tuser_id AND
               t1.id = t2.max_id
            WHERE t1.fuser_id = ? AND t1.tuser_id = ?
            OR t1.fuser_id = ? AND t1.tuser_id = ?
        ', [$id, $online_user->id,$online_user->id,$id]);

                                    //$lmessage= json_decode( json_encode($lmessage), true);

                                    //                                    foreach ($lmessage as $messa){
                                    //                                    echo $messa->chat ;
                                    //                                    }
                                    ?>

                                    <div class="chat_list active_chat"  onclick='window.location="{{url('messages').'?id='.$online_user->id}}";' data-id="{{$online_user->id}}">
                                        <div class="chat_people">
                                            <div class="chat_img"> <img  src="{{asset($online_user->photo)}}" alt="picn"> </div>
                                            <div class="chat_ib">
                                                <h5> <span class="online"></span>{{$online_user->username}} <span class="chat_date">Active Now</span></h5>
                                                <p>
                                                @foreach ($onlmessage as $omessa)
                                                    {{--                                            {!! strip_tags($messa->chat, '<a>')!!}--}}
                                                    <!--                                            --><?php //getDataWithURL($messa->chat);?>
                                                {{$omessa->chat}}
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

{{--                                @endif--}}
                            @endforeach
                        @endif

                    {{--                </a>--}}



                    @if(isset($users[0]))
                        @foreach($users as $user)

                            @if($user->id!=\Illuminate\Support\Facades\Auth::id())
                            <?php


                                    $id = auth()->id();
                                    $lmessage = DB::select('
        SELECT t1.*
        FROM message_models AS t1
        INNER JOIN
        (
            SELECT
                LEAST(fuser_id, tuser_id) AS fuser_id,
                GREATEST(fuser_id, tuser_id) AS tuser_id,
                MAX(id) AS max_id
            FROM message_models
            GROUP BY
                LEAST(fuser_id, tuser_id),
                GREATEST(fuser_id, tuser_id)
        ) AS t2
            ON LEAST(t1.fuser_id, t1.tuser_id) = t2.fuser_id AND
               GREATEST(t1.fuser_id, t1.tuser_id) = t2.tuser_id AND
               t1.id = t2.max_id
            WHERE t1.fuser_id = ? AND t1.tuser_id = ?
            OR t1.fuser_id = ? AND t1.tuser_id = ?
        ', [$id, $user->id,$user->id,$id]);

                                    //$lmessage= json_decode( json_encode($lmessage), true);

//                                    foreach ($lmessage as $messa){
//                                    echo $messa->chat ;
//                                    }
                                    ?>






                            <div class="chat_list active_chat" onclick='window.location="{{url('messages').'?id='.$user->id}}";'  data-id="{{$user->id}}">

                                <div class="chat_people">
                                    <div class="chat_img">  <img src="{{asset($user->photo)}}" alt=""> </div>
                                    <div class="chat_ib">
{{--                                        {{$user->updated_at->diffForHumans()}}--}}
                                        <h5><span class="offline"></span>{{$user->username}} <span class="chat_date"> @foreach ($lmessage as $messa)
                                                    {{\Carbon\Carbon::parse($messa->updated_at)->diffForhumans()}}
                                                @endforeach </span></h5>
                                        <p>
                                            @foreach ($lmessage as $messa)
{{--                                            {!! strip_tags($messa->chat, '<a>')!!}--}}
<!--                                            --><?php //getDataWithURL($messa->chat);?>
                                            {{$messa->chat}}
                                        @endforeach
{{--                                            {{$lmessage->chat}} </p>--}}
                                    </div>
                                </div>

                            </div>
                                    @endif

                        @endforeach

                    @endif
                    </div>
                </div>
                <div class="mesgs">

                    <div class="msg_history">

                        @if(!empty($messageShow))
                            @foreach($messageShow as $meSh)
                                @if($meSh->tuser_id==\Illuminate\Support\Facades\Auth::id()&&$meSh->fuser_id==$messageId)
                                    {{--                                                @if($meSh->fuser_id==\Illuminate\Support\Facades\Auth::id())--}}

                                    <div class="incoming_msg">
                                        {{--                                <div class="incoming_msg_img"> <img src="{{asset($meSh->photo)}}" alt="sunil"> </div>--}}
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
{{--                                                <p>{{$meSh->chat}}</p>--}}
                                                <p> <?php getDataWithURL($meSh->chat);?></p>

                                                <span class="time_date">{{\Carbon\Carbon::parse($meSh->updated_at)->diffForhumans()}} </span></div>
                                        </div>
                                    </div>
                                @endif

                                @if($meSh->fuser_id==\Illuminate\Support\Facades\Auth::id()&&$meSh->tuser_id==$messageId)
                                    {{--                                                @if!empty($messageId)&&($meSh->tuser_id==$messageId))--}}
                                    <div class="outgoing_msg">
                                        <div class="sent_msg">
{{--                                            <p>{{$meSh->chat}}</p>--}}
                                            <p> <?php getDataWithURL($meSh->chat);?></p>
                                            <span class="time_date"> {{\Carbon\Carbon::parse($meSh->updated_at)->diffForhumans()}} </span> </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                    </div>

                    <div class="type_msg">
                        <div class="input_msg_write">

                            {{--                                        {{route('mSave',$messageId)}}--}}

                            <form method="post"  action="{{url('mSave',$messageId)}}"  enctype="multipart/form-data">
                                {{ csrf_field() }}
{{--                                <textarea type="text" class="write_msg" name="chat" placeholder="Type a message"  required/>--}}
                                <input type="text" class="write_msg" name="chat" placeholder="Type a message"  required/>
                                <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </form>

                        </div>


                    </div>
                </div>
            </div>


        </div>

    </div>

    @endsection

@section('custom_js') 
    <script src="{{asset('/phq/assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/phq/assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

    <script>




        $(function() {
            $( "#date" ).datepicker({dateFormat: 'yy'});
        });

    </script>

    <script>
        $(document).ready(function () {
            $('.chat_list').on('click', function () {
                var user_id = $(this).data('id');
                // alert(user_id);
            })
        });

    </script>


    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function () {
            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('49f3ba8c9d3adab2613e', {
                cluster: 'ap2',
                forceTLS: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function (data) {
                // alert(JSON.stringify(data));
                if (my_id == data.from) {
                    $('#' + data.to).click();
                } else if (my_id == data.to) {
                    if (receiver_id == data.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.from).click();
                    } else {
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending').html());

                        if (pending) {
                            $('#' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });

            $('.user').click(function () {
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();

                receiver_id = $(this).attr('id');
                $.ajax({
                    type: "get",
                    url: "messages/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    }
                });
            });

            $(document).on('keyup', '.type_msg input', function (e) {
                var message = $(this).val();

                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    $(this).val(''); // while pressed enter text box will be empty

                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "message", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function (data) {

                        },
                        error: function (jqXHR, status, err) {
                        },
                        complete: function () {
                            scrollToBottomFunc();
                        }
                    })
                }
            });
        });

        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.msg_history').animate({
                scrollTop: $('.msg_history').get(0).scrollHeight
            }, 50);
        }
    </script>

@endsection 

<?php
function getDataWithURL($text){
    // The Regular Expression filter
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

    // Check if there is a url in the text
    if(preg_match($reg_exUrl, $text, $url)) {
        // make the urls hyper links
        echo preg_replace($reg_exUrl, "<a href=".$url[0].">".$url[0]."</a> ", $text);

    } else {
        // if no urls in the text just return the text
        echo $text;

    }
}
?>