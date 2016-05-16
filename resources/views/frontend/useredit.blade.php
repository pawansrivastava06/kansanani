@extends('layouts.frontend')
@section('title', 'Edit User')
@section('heading', 'Edit User')
@section('content')

<div class="container-fluid register-page">
    <div>
        @if (count($errors) > 0)                        
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>    
    <form class="form-horizontal  text-center register-form-page " role="form" method="POST" action="{{ url('/auth/register') }}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input type="hidden" class="form-control" name="id" value="{{isset($userArray['user_id'])?$userArray['user_id']:''}}">
        <input type="hidden" class="" id="current_db_user_image" name="current_db_user_image" value="{{isset($userArray['user_image'])?$userArray['user_image']:''}}">
        <input type="hidden" class="" id="current_user_image" name="current_user_image" value="{{isset($userArray['user_image'])?url('/').'/'.$userArray['user_image']:''}}">
        <div class="profile-image-upload-field__background-no-image">
            <input id="user-image" class="profile-image-upload-field__file-input" type="file" name="user_image">
            <div id="image-holder" style="height: 230px; width: 452px;" ></div>
        </div>
        <div class="form-group">
            <div class="col-md-12 text-left"><label>Your Name</label></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="first_name" value="{{isset($userArray['first_name'])?$userArray['first_name']:''}}" placeholder="First Name">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="last_name" value="{{isset($userArray['last_name'])?$userArray['last_name']:''}}" placeholder="Last Name">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 text-left"><label class="control-label">E-Mail Address</label></div>
            <div class="col-md-12">
                @if(isset($userArray['email']) && $userArray['email'])
                <input readonly type="email" class="form-control" name="email" value="{{isset($userArray['email'])?$userArray['email']:''}}"/>
                @else
                <input type="email" class="form-control" name="email"/>
                @endif
            </div>
        </div>
        <div class="form-group Birthday">
            <div class="col-md-12 text-left"><label class=" control-label">Birthday</label></div>
            <div class="col-md-6">                                                            
                <select name="month" id="months" data-month="{{isset($userArray['month'])?$userArray['month']:''}}">
                    <option value="">Months</option>               
                </select>
            </div>
            <div class="col-md-3">                                                            
                <select name="day" id="days" data-day="{{isset($userArray['day'])?$userArray['day']:''}}">
                    <option value="">Days</option>                
                </select>
            </div>
            <div class="col-md-3">                                                            
                <select name="years" id="years" data-year="{{isset($userArray['years'])?$userArray['years']:''}}">
                    <option value="">Years</option>                
                </select>
            </div>
        </div>
        <div class="form-group Pronoun" id="gender" data-gender="{{isset($userArray['gender'])?$userArray['gender']:''}}">
            <div class="col-md-12 text-left"><label class=" control-label">Pronoun</label></div>
            <div class="col-md-3 her text-left">
                <label for="her">Her</label>
                <input type="radio" class="form-control" name="gender" value="f" id="her"/>
            </div>
            <div class="col-md-3 his text-left">
                <lable for="his">His</lable>
                <input type="radio" class="form-control" name="gender" value="m" id="his"/>
            </div>
            <div class="col-md-3 their text-left">
                <label for="their">Their</label>
                <input type="radio" class="form-control" name="gender" value="n" id="their"/>
            </div>
        </div>
        @if(!isset($userArray['user_id']))
        <div class="form-group">
            <div class="col-md-12 text-left"><label class="control-label text-left">Password</label></div>
            <div class="col-md-12">
                <input type="password" class="form-control" name="password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12 text-left"><label class="text-left control-label">Confirm Password</label></div>
            <div class="col-md-12">
                <input type="password" class="form-control" name="password_confirmation">
            </div>
        </div>
        @endif
        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-custm">
                    Sign Up
                </button>
            </div>
        </div> 
        <p class="term-condition">
            By creating an account you agree to our Terms of Service and Privacy Policy. If youâ€™re a Causes user, weâ€™ll let your Causes friends know about your activity on Brigade (you can turn this off in settings).
        </p>
    </form>    
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var month = $('#months').attr('data-month');
        var days = $('#days').attr('data-day');
        var years = $('#years').attr('data-year');
        var gender = $('#gender').attr('data-gender');
        if (month) {
            setTimeout(function() {
                $("#months").val(month);
            }, 500);
        }
        if (days) {
            setTimeout(function() {
                $("#days").val(days);
            }, 500);
        }
        if (years) {
            setTimeout(function() {
                $("#years").val(years);
            }, 500);
        }
        if (gender) {
            $("input[name=gender][value=" + gender + "]").attr('checked', true);
        }
        
        var imageSrcVal = $('#current_db_user_image').val();
        if(imageSrcVal){
            setTimeout(function() {
                var imageSrc = $('#current_user_image').val();
                $('#image-holder').css('background-image', 'url(' + imageSrc + ')');
                $('#image-holder').css('background-repeat', 'no-repeat');
                $('#image-holder').css('background-size', '452px 230px');
            }, 100);
        }
        
    });

    $(function() {
        //populate our years select box
        for (i = new Date().getFullYear(); i > 1900; i--) {
            $('#years').append($('<option />').val(i).html(i));
        }
        //populate our months select box
        for (i = 1; i < 13; i++) {
            $('#months').append($('<option />').val(i).html(i));
        }
        for (i = 1; i < 32; i++) {
            $('#days').append($('<option />').val(i).html(i));
        }
    });


    $("input[name=user_image]").on('change', function() {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder");
        image_holder.empty();
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {
                    
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("<img />", {
                            "src": e.target.result,
                            "style": "height: 230px; width: 452px;",
                            "class": "thumb-image"
                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);

                }
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });
</script>
@endsection
