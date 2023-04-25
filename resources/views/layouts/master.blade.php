<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Head -->
<head>
    <meta charset="utf-8" />
    <title>Departmental_Issue</title>

    <meta name="description" content="blank page" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="modals and wells" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.png')}}" type="image/x-icon">

    <!--Basic Styles-->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/weather-icons.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('/sharing/footer/css/min.css')}}">
    <!--Fonts-->
    <!-- <link href='../fonts.googleapis.com/css@family=open+sans_3a300italic,400italic,600italic,700italic,400,600,700,300.css'
          rel="stylesheet" type="text/css"> -->
          <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <!--Beyond styles-->

     <!-- <link id="beyond-link" href="{{asset('assets/css/beyond.min.css')}}" rel="stylesheet" />  -->

    <link href="{{ asset('assets/css/beyond.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

    

    <link href="{{asset('assets/css/demo.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/typicons.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="{{asset('phq/footer/css/style.css')}}"> -->

  

    <script src="{{asset('assets/js/skins.min.js')}}"></script>

    @yield('custom_css')
</head>
<body>
    <div class="loading-container">
    <div class="loader"></div>
</div>

    <div class="navbar">
        <div class="navbar-inner">
            <div class="navbar-container">
                <!-- Navbar Barnd -->
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">
                        <small>
                            <img src="{{asset('assets/img/pic.PNG')}}" alt="" />
                        </small>
                    </a>
                </div>
                <!-- /Navbar Barnd -->
                <!-- Sidebar Collapse -->
                @php
                $user = \Illuminate\Support\Facades\Auth::user();
            @endphp
                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="collapse-icon fa fa-bars"></i>
                </div>
                <!-- /Sidebar Collapse -->
                <!-- Account Area and Settings --->
                <div class="navbar-header pull-right">
                    <div class="navbar-account">
                        
                     

                        <ul class="account-area">
                          
                           
                            @if(Auth::user())
                            <li>
                                <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                    <div class="avatar" title="View your public profile">
                                        <img src="{{asset(Auth::user()->photo)}}">
                                    </div>
                                    <section>
                                        <h2><span class="profile"><span>{{Auth::user()->username}} <i class="fa fa-angle-down"></i></span>
                                        </span></h2>
                                    </section>
                                </a>

                               
                                <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                    <!-- <li class="username username-hide-on-mobile"><a>{{Auth::user()->name}}</a></li>
                                     -->
                                     @if (!is_null(Auth::user()) &&  (Auth::user()->can('profileshow') || Auth::user()->can('changepassword')))

                                    <li>
                                        <a href="{{url('/profileshow')}}"><i class="fa fa-user"></i> Profile </a>
                                    </li>
                                    <li>
                                        <a href="{{url('/changepassword')}}"><i class="fa fa-location-arrow"></i> Change Password </a>
                                    </li>
                                    <li>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fa fa-key"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    </li>

                                </ul>
                            </li>

                            @else
                            <li>
                                <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                    
                                    <section>
                                        <h2><span class="profile"><span>No User Logged On <i class="fa fa-angle-down"></i></span>
                                        </span></h2>
                                    </section>
                                </a>

                               
                                <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                  


                                    <li>
                                        <a href="{{url('login')}}"><i class="fa fa-user"></i> Login </a>
                                    </li>
                                    <li>
                                        <a href="{{url('register')}}"><i class="fa fa-location-arrow"></i> Register </a>
                                    </li>
                                

                                </ul>
                            </li>
                            @endif
                        </ul>


                        
                    </div>
                </div>
            </div>
            <!-- /Account Area and Settings -->
        </div>
    </div>

    <div class="main-container container-fluid">
        <div class="page-container">
            <div class="page-sidebar" id="sidebar">
                <!-- Page Sidebar Header-->
                  
              
                <!-- /Page Sidebar Header -->
                <!-- Sidebar Menu -->
                <ul class="nav sidebar-menu ">
                    <!--Dashboard-->
                   
                 <li class="{{ Route::is('displayWelcome') ? 'active' : '' }}">
                        <a href="{{url('/')}}">
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>
                 

                    
                   
                    <!--Databoxes-->
                    <li class="{{ Route::is('addQuestion') ? 'active' : '' }}">
                        <a href="{{url('/questionsAdd')}}">
                            <i class=" menu-icon glyphicon glyphicon-question-sign"></i>

                            <span class="menu-text"> Ask Question </span>
                        </a>
                    </li>
                    
                    @if (!is_null(Auth::user()) &&  (Auth::user()->can('adduser') || Auth::user()->can('userlist')))
                    
                    <li
                    class="{{ Route::is('adduser') || Route::is('userlist') ? 'active open' : '' }}">
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon glyphicon glyphicon-user"></i>
                            <span class="menu-text"> User </span>
                            

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu"> 
                            
                        @if($user->can('adduser'))

                        <li class="{{ Route::is('adduser') ? 'active' : '' }}">
                                <a href="{{url('/adduser')}}">
                                    <span class="menu-text">Add User</span>
                                </a>
                            </li>
                            @endif
                            @if($user->can('userlist'))
                            <li class="{{ Route::is('userlist') ? 'active' : '' }}">
                                <a href="{{url('/userlist')}}">
                                    <span class="menu-text">User List</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                   
                   @endif

                    @if (!is_null(Auth::user()) &&  (Auth::user()->can('add-online-class') || Auth::user()->can('list-online-class')))
                    
                    <li class="{{ Route::is('add-online-class') || Route::is('list-online-class') ? 'active open' : '' }}">
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-book"></i>
                            <span class="menu-text"> Online Class </span>
                            

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu"> 
                            
                         @if($user->can('add-online-class'))

                        <li class="{{ Route::is('add-online-class') ? 'active' : '' }}">
                                <a href="{{url('/add-online-class')}}">
                                    <span class="menu-text">Add Zoom Class</span>
                                </a>
                            </li>
                        @endif
                        @if($user->can('list-online-class'))
                            <li class="{{ Route::is('list-online-class') ? 'active' : '' }}">
                                <a href="{{url('/list-online-class')}}">
                                    <span class="menu-text">Zoom Class List</span>
                                </a>
                            </li>
                        @endif
                        </ul>
                    </li>
                   
                    @endif

                   <li class="{{ Route::is('studentlist') ? 'active open' : '' }}">
                    <a href="" class="menu-dropdown">
                        <i class="menu-icon fa fa-money"></i>
                        <span class="menu-text"> Donate </span>
                        <i class="menu-expand"></i>
                    </a>

                    <ul class="submenu">
                        <li class="{{ Route::is('studentlist') ? 'active' : '' }}">
                            <a href="{{url('/studentlist')}}" active>
                                <span class="menu-text">Student List </span>
                            </a>
                        </li>
                    </ul>
                </li>
                   

                @if (!is_null(Auth::user()) &&  (Auth::user()->can('paymentlist')))
                    <li class="{{ Route::is('paymentlist') ? 'active open' : '' }}">
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-credit-card"></i>
                            <span class="menu-text"> Payment </span>
                            <i class="menu-expand"></i>
                        </a>
                        <ul class="submenu"> 
                            @if($user->can('paymentlist'))
                            <li class="{{ Route::is('paymentlist') ? 'active' : '' }}">
                                <a href="{{url('/paymentlist')}}">
                                    <span class="menu-text">Payment List</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
               @endif
                  
                        <li  class="{{ Route::is('addcategory') || Route::is('categoryList') ? 'active open' : '' }}">
                        <a href="" class="menu-dropdown">
                            <i class="menu-icon glyphicon glyphicon-tasks"></i>
                            <span class="menu-text"> Category </span>
                           

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu">
                        @if (!is_null(Auth::user()) &&  Auth::user()->can('addcategory'))
                        <li class="{{ Route::is('addcategory') ? 'active' : '' }}">
                                <a href="{{url('/addcategory')}}" active>
                                    <span class="menu-text">Add Category</span>
                                </a>
                            </li>
                            @endif
                            <li class="{{ Route::is('categoryList') ? 'active' : '' }}">
                                <a href="{{url('/categoryList')}}">
                                    <span class="menu-text">Category List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                  
                   
                    <li class="{{ Route::is('ratings') ? 'active' : '' }}">
                        <a href="{{url('ratings')}}">
                            <i class=" menu-icon glyphicon glyphicon-star-empty"></i>

                            <span class="menu-text"> Rating </span>
                        </a>
                    </li>
                   
                    @if (!is_null(Auth::user()) &&  Auth::user()->can('messages'))
                    <li class="{{ Route::is('messages') ? 'active' : '' }}">
                        <a href="{{url('messages')}}">
                            <i class="menu-icon fa fa-envelope-o"></i>
                            <span class="menu-text">Message</span>
                        </a>
                    </li>
                    @endif
                   
                    <!-- Roles  -->
                    
                @if (!is_null(Auth::user()) &&  (Auth::user()->can('roles.index') || Auth::user()->can('roles.create')))
                <li class="{{ Route::is('roles.index') || Route::is('roles.create') || Route::is('roles.edit') ? 'active open' : '' }}">
                 <a href="#" class="menu-dropdown">
                     <i class="menu-icon fa fa-tasks"></i>
                     <span class="menu-text"> Roles </span>

                     <i class="menu-expand"></i>
                 </a>
                 <ul class="submenu">
                 @if($user->can('roles.index'))

                     
                         <li class="{{ Route::is('roles.index') ? 'active' : '' }}">
                             <a href="{{ route('roles.index') }}">
                                 <span class="menu-text">Role List</span>
                             </a>
                         </li>
                         @endif

                     @if($user->can('roles.create'))
                    
                         <li class="{{ Route::is('roles.create') ? 'active' : '' }}">
                             <a href="{{ route('roles.create') }}">
                                 <span class="menu-text">New Role</span>
                             </a>
                         </li>
                         @endif
                  
                 </ul>
             </li>
             @endif 
            
                    @if (!is_null(Auth::user()) &&  (Auth::user()->can('answer_reportList') || Auth::user()->can('question_reportList')))
                    
                    <li
                    class="{{ Route::is('answer_reportList') || Route::is('question_reportList') ? 'active open' : '' }}">
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon glyphicon glyphicon-list"></i>
                            <span class="menu-text"> Report </span>
                            

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu"> 
                            
                        @if($user->can('question_reportList'))

                        <li class="{{ Route::is('question_reportList') ? 'active' : '' }}">
                                <a href="{{url('question_reportList')}}">
                                    <span class="menu-text">Question Report</span>
                                </a>
                            </li>
                            @endif
                            @if($user->can('answer_reportList'))
                            <li class="{{ Route::is('answer_reportList') ? 'active' : '' }}">
                                <a href="{{url('answer_reportList')}}">
                                    <span class="menu-text">Answer Report</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                   
                   @endif



            
               @if (!is_null(Auth::user()) &&  Auth::user()->can('ex_import'))
               
               <li class="{{ Route::is('ex_import') ? 'active' : '' }}">
                    <a href="{{url('/ex-import')}}">
                            <i class="menu-icon glyphicon glyphicon-download"></i>
                            <span class="menu-text">Export</span>
                        </a>
                    </li>
                 
                    @endif
                    @if (!is_null(Auth::user()) &&  (Auth::user()->can('addpuser') || Auth::user()->can('puserlist')))
                   
                        <li class="{{ Route::is('addpuser') || Route::is('puserlist') ? 'active open' : '' }}">
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon glyphicon glyphicon-user"></i>
                            <span class="menu-text">Primary Student </span>
                           

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu">
                        @if($user->can('addpuser'))
                        <li class="{{ Route::is('addpuser') ? 'active' : '' }}">
                                <a href="{{url('/addpuser')}}">
                                    <span class="menu-text">Add  Primary Student</span>
                                </a>
                            </li>
                            @endif
                            @if($user->can('puserlist'))
                            <li class="{{ Route::is('puserlist') ? 'active' : '' }}">
                                <a href="{{url('/puserlist')}}">
                                    <span class="menu-text">Student Primary List</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                
                    @endif
                </ul>
            </div>

            <div class="page-content" style="min-height:700px">
              <!-- @if (Session::has('timeout_message'))
                      <div class="alert alert-info timeout_message m-t-sm">{{ Session::get('timeout_message') }}</div>
                    @endif
                    @if (Session::has('message'))
                      <div class="alert alert-info m-t-sm">{{ Session::get('message') }}</div>
                    @endif
                    @if (Session::has('error_message'))
                      <div class="alert alert-danger m-t-sm"><?php echo html_entity_decode(Session::get('error_message')); ?></div>
                    @endif
                    @if (Session::has('warning_message'))
                      <div class="alert alert-warning m-t-sm">{{ Session::get('warning_message') }}</div>
                    @endif
                    @if (Session::has('success_message'))
                      <div class="alert alert-success m-t-sm">{{ Session::get('success_message') }}</div>
                    @endif
              
              
             
              -->
             

            @yield('content')





                
            </div>
         
        </div>
    </div>
    <footer class="footer-area section-gap">
            <div class="footer_top section_gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3  col-md-6 col-sm-6">
                            <div class="single-footer-widget">
                                {{--<h4 class="text-white">About Us</h4>--}}
                                {{--<p >--}}
                                    {{--To share your knowledge easily with your friends, seniors, juniors in your department. To help the getting real answer according to the questions. To get a huge information specific a topics of our departmental courses.--}}
                                {{--</p>--}}
                            </div>
                        </div>
                        <div class="col-lg-4  col-md-6 col-sm-6">
                            <div class="single-footer-widget">
                                {{--<h4 class="text-white">Contact Us</h4>--}}
                                {{--<p>--}}
                                    {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore--}}
                                    {{--magna aliqua.--}}
                                {{--</p>--}}
                                {{--<p class="number">--}}
                                    {{--012-6532-568-9746 <br>--}}
                                    {{--012-6532-569-9748--}}
                                {{--</p>--}}
                            </div>
                        </div>
                        <div class="col-lg-5  col-md-6 col-sm-6">
                            <div class="single-footer-widget">
                                {{--<h4 class="text-white">Newsletter</h4>--}}
                                {{--<p>You can trust us. we only send offers, not a single spam.</p>--}}
                                {{--<div class="d-flex flex-row" id="mc_embed_signup">--}}
                                    {{--<form class="navbar-form" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"--}}
                                          {{--method="get">--}}
                                        {{--<div class="input-group add-on">--}}
                                            {{--<input class="form-control" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'"--}}
                                                   {{--required="" type="email">--}}
                                            {{--<div style="position: absolute; left: -5000px;">--}}
                                                {{--<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">--}}
                                            {{--</div>--}}
                                            {{--<div class="input-group-btn">--}}
                                                {{--<button class="genric-btn text-uppercase">--}}
                                                    {{--get started--}}
                                                {{--</button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="info mt-20"></div>--}}
                                    {{--</form>--}}

                                {{--</div>--}}
                            {{----}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                             <p class="footer-text" style="color:#ffffff;margin-top:1.5%;margin-left:35%;font-size:12px;"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> <!--All rights reserved --> <i class="fa fa-heart-o" aria-hidden="true"></i><!--Developed By -->  <a  style="color:#ffffff; hover:color:red;text-decoration:none;" onmouseover="this.style.color='#0F0'" onmouseout="this.style.color='white'" href="https://www.facebook.com/profile.php?id=100008454481275&ref=bookmarks" target="_blank">Karima Jaman Moon</a>, BSMRSTU_CSE. All rights reserved
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.dribbble.com" target="_blank"><i class="fa fa-dribbble"></i></a>
                            <a href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/slimscroll/jquery.slimscroll.min.js')}}"></script>


<script src="{{asset('assets/js/beyond.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/jquery.datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/zeroclipboard.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables.tabletools.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables-init.js')}}"></script>
    <script>
        InitiateSimpleDataTable.init();
        InitiateEditableDataTable.init();
        InitiateExpandableDataTable.init();
        InitiateSearchableDataTable.init();
    </script>

    <script src="{{asset('phq/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
    <link href="{{asset('phq/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('phq/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('phq/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('phq/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    <script type="text/javascript">
        $(function () {
            $('.datetimepicker').datetimepicker();
        });

        $('#sample_1').DataTable({
            "iDisplayLength": 10,
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "all"]
            ]
        });
    </script>
    <script>
        $("#bootbox-regular").on('click', function () {
            bootbox.prompt("What is your name?", function (result) {
                if (result === null) {
                    //Example.show("Prompt dismissed");
                } else {
                    //Example.show("Hi <b>"+result+"</b>");
                }
            });
        });

        $("#bootbox-confirm").on('click', function () {
            bootbox.confirm("Are you sure?", function (result) {
                if (result) {
                    //
                }
            });
        });

        $("#bootbox-options").on('click', function () {
            bootbox.dialog({
                message: $("#myModal").html(),
                title: "New E-Mail",
                className: "modal-darkorange",
                buttons: {
                    success: {
                        label: "Send",
                        className: "btn-blue",
                        callback: function () { }
                    },
                    "Save as Draft": {
                        className: "btn-danger",
                        callback: function () { }
                    }
                }
            });
        });

        $("#bootbox-success").on('click', function () {
            bootbox.dialog({
                message: $("#modal-success").html(),
                title: "Success",
                className: "",
            });
        });
    </script>
    


@yield('custom_js')

</body>

</html>
