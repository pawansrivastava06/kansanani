@extends('layouts.frontend')
@section('title', 'Dashboard')
@section('content')

<div class="container content-main">
    @include('partials.frontendsidebar')
    <main class="main-container-document">
        <div class="row">
            <div class="col-md-8 col-sm-8 center-content-8">
                <div class="post-write ">
                    <div class="hide-once-post">
                        <div class=" pull-left post-profile-custm1 ">
                            <img style="height: 81px; width: 81px;" src="{{ url('/') . '/' . Auth::User()->user_image }}" alt=""/>
                        </div>
                        <div class="post-profile-custm2">
                            <div class="post-input ">
                                <a class="opinion" href="#">What is your opinion?</a> 
                            </div>
                        </div> 
                    </div>
                    <!--option--->
                    <form id="category-tag" method="POST" action="" name="category_tag">    
                        {!! csrf_field() !!}
                        <div id="tag-details">
                            <div class="first-phase col-sm-12 box-shadow-design">
                                <div class="col-sm-12 pull-left post-profile-custm1 ">
                                    <img style="height: 81px; width: 81px;" src="{{ url('/') . '/' . Auth::User()->user_image }}" alt=""/>
                                    <span>Mr. {{ Auth::User()->first_name }}</span>
                                </div>
                                <div class="col-sm-12">
                                    <p>Your opinion (that others can agree or disagree with)</p>
                                    <input type="text" name="opinion_quote" placeholder="What is your opinion?"/>
                                </div>
                                <div class="col-sm-12">
                                    <p>Additional information (context, quotes, or links)</p>
                                    <textarea name="opinion_description" placeholder="Why should others agree with you?"/></textarea>
                                </div>
                                <div class="col-sm-12">
                                    <p>Add a tag</p>
                                    <input id="automplete-1" class="auto-tags" type="text" name="tag_name" placeholder="#tags"/>
                                    <input type="hidden" name="tags_id" id="tags_id" value=""/>
                                    <div class="col-sm-12" id="auto-complete-text"> </div>
                                    
                                </div>
                                <div class="col-sm-12 button-firstphase">
                                    <button id="tag-1" type="button" >Next</button>
                                </div>
                            </div>  
                        </div> 
                        <div id="category" class="col-sm-12 box-shadow-design">
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-6 images-first-content">
                        <img src="{{ theme('images/women-image-1.png') }}" alt=""/>
                        <div class="content-center-images">
                            <p>I-95 Primarics</p>
                            <button type="button">Take 15 Positions</button>
                        </div>
                    </div>
                    <div class="col-md-6 images-first-content">
                        <img src="{{ theme('images/car-image.png') }}" alt=""/>
                        <div class="content-center-images">
                            <p>Self-Driving Cars</p>
                            <button type="button">Take 6 Positions</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center trending-topic box-shadow-design">
                    <h1>See All Trending Topics</h1>
                </div>
                <?php foreach ($opinions as $opinion) { ?>
                    <div class="col-md-12 box-shadow-design">
                        <h5>Trending in {{ $opinion['category']['name'] }}</h5>
                        <div class="profile-description">
                            <div class="pull-left img-profile-desc"><img style="height: 81px; width: 81px;" src="{{ url('/') . '/' . $opinion['usermeta']['user_image'] }}" alt=""/></div>
                            <div class="pull-left profile-header-cust">
                                <h2>{{ $opinion['user']['name'] }}</h2>
                                <p>Posted in -<span> {{ $opinion['category']['name'] }}</span></p>
                            </div>
                        </div>
                        <h1>{{$opinion['opinion_quote']}}</h1>
                        <div>
                            {{$opinion['opinion_description']}}
                        </div>
                        <div class="comment">
                            <p> 1 comment</p>
                        </div>
                        <div class="agree-and-disagree">
                            @if($opinion['acceptance']['is_agree'])
                            @if($opinion['acceptance']['is_agree'] == 1)
                            <a href="#" class="agreed" data-userid="{{ Auth::user()->id}}" data-opinion="{{ $opinion['id'] }}" data-val="1"><span class="agree">Agree</span></a>
                            @elseif($opinion['acceptance']['is_agree'] == 2)
                            <a href="#" class="disagreed" data-userid="{{ Auth::user()->id}}" data-opinion="{{ $opinion['id'] }}" data-val="2"><span class="disagree">Disagree</span></a>
                            @endif
                            @else
                            <a href="#" data-userid="{{ Auth::user()->id}}" data-opinion="{{ $opinion['id'] }}" data-val="1"><span class="agree">Agree</span></a>
                            <a href="#" data-userid="{{ Auth::user()->id}}" data-opinion="{{ $opinion['id'] }}" data-val="2"><span class="disagree">Disagree</span></a>
                            @endif
                            <div class="share">
                                <span class="share-images">Share</span><span class="bottom-bottom"><a href="#"></a></span>
                            </div>
                        </div>
                        @if($opinion['acceptance']['is_agree'])
                        <div class="percentage">
                            @if($opinion['acceptance']['is_agree']==1)
                            <div id="agree-percentage" >
                                <div class="left-agree"><span>{{$opinion['acceptance_calculation']['agree'].'% '}}</span>Agree</div>
                                <div class="percentages" style="display: inline-block;"> <div class="agree-percentage" style="width:{{$opinion['acceptance_calculation']['agree']}}%;">                         
                                    </div></div>
                                <div class="right-disagree">{{100-($opinion['acceptance_calculation']['agree']).'% Disagree'}}</div>
                            </div>
                            @endif
                            @if($opinion['acceptance']['is_agree']==2)
                            <div id="disagree-percentage">
                                <div class="left-agree"><span>{{100-($opinion['acceptance_calculation']['disagree']).'% '}}</span>Agree</div>
                                <div class="percentages" style="display: inline-block;"><div class="dis-agree-percentage agree-percentage" style="width:{{$opinion['acceptance_calculation']['disagree']}}%;">                         
                                    </div></div>
                                <div class="right-disagree"> {{$opinion['acceptance_calculation']['disagree'].'% Disagree'}}</div>
                            </div>                              
                            @endif
                        </div>
                        @endif
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-offset-1 col-sm-4 col-md-3 right-content-3">
                <div class=" panel panel-default box-shadow-design">
                    <div class="panel-heading">Actions</div>
                    <div class="panel-body">
                        <p>INVITE TO KANSANAANI</p>
                        <p>SUPPORT FRIENDS</p>
                    </div>
                </div>
                <div class="panel panel-default box-shadow-design">
                    <div class="panel-heading">Become a Verified Member</div>
                    <div class="panel-body">
                        GET VERIFIED
                    </div>
                </div>
                <div class="panel panel-default box-shadow-design">
                    <div class="panel-heading">People you may know</div>
                    <div class="panel-body"> 
                    </div>
                </div>
                <div class="panel panel-default box-shadow-design top-issue">
                    <div class="panel-heading">
                        Top Issues
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li>
                                Defence
                            </li>
                            <li>
                                Guns
                            </li>
                            <li>
                                Immigration
                            </li>
                        </ul>
                    </div>
                    <div class="panel-footer see-all">
                        SEE ALL
                    </div>
                </div>
                <div class="panel panel-default box-shadow-design contact-support">
                    <div class="panel-body">
                        <ul>
                            <li>
                                Contact Support
                            </li>
                            <li>
                                Help
                            </li>
                            <li>
                                Privacy Policy
                            </li>
                            <li>
                                Terms of Service
                            </li>
                            <li>
                                Team
                            </li>
                            <li>
                                Partners
                            </li>
                            <li>
                                Jobs
                            </li>
                            <li>
                                Facebook
                            </li>
                            <li>
                                Twitter
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    $(document).ready(function(){
       $('.mobile-menu-icon').click(function(){
           $('.sidebar-container ').slideToggle();
       });
    });
</script>




<script>
    $(document).ready(function() {
    $('#category').hide();
            $('#tags_id').val(0);
            $('.opinion').click(function() {
    $('.first-phase').slideDown();
            $('.hide-once-post').hide();
    });
            $('.agree-and-disagree').on('click', 'a', function(e) {
    e.preventDefault();
            $(this).parents('.agree-and-disagree').addClass('current');
            var userid = $(this).data('userid');
            var oid = $(this).data('opinion');
            var val = $(this).data('val');
            opinion_decision(userid, oid, val);
    });
            function opinion_decision(userid, oid, val) {
            $.post('{{ route('frontend.dashboard.ajax') }}', {
            userid: userid,
                    oid: oid,
                    val: val,
            }).done(function() {
            if (val == 1) {
            $('.agree-and-disagree.current .disagree').parents('a').remove();
                    $('.agree-and-disagree.current .agree').parents('a').addClass('agreed');
                    $('.agree-and-disagree').removeClass('current');
            } else {
            $('.agree-and-disagree.current .agree').parents('a').remove();
                    $('.agree-and-disagree.current .disagree').parents('a').addClass('disagreed');
                    $('.agree-and-disagree').removeClass('current');
            }
            }).fail(function() {
            $('.agree-and-disagree').removeClass('current');
            });
            }           
           
    });
            $('.auto-tags').click(function(e) {
                e.preventDefault();
                $('#tags_id').val(0);
                var arr = [];
                $.ajax({
                    type: "post",
                    url: '{{url('frontend/dashboard/tag')}}',
                    data: {_token: '{{csrf_token()}}'},
                    success: function(results) {
                    var results = JSON.parse(results);
                            var source = [ ];
                            var mapping = { };
                            for (var i = 0; i < results.length; ++i) {
                    source.push(results[i].name);
                            mapping[results[i].name] = results[i].id;
                    }
                    $('#automplete-1').autocomplete({
                    source: source,appendTo: '#auto-complete-text',autoFocus:true,
                            select: function(event, ui) {
                            $('#tags_id').val(mapping[ui.item.value]);
                            }
                    });
                    }
                });
            });

            $('.main-container-document').on('click', '#tag-1', function(){
                var x = document.forms["category_tag"]["opinion_quote"].value;
                var y = document.forms["category_tag"]["opinion_description"].value;
                var z = document.forms["category_tag"]["tag_name"].value;
                        if (x == null || x == "") {
                                alert("Opinion must be filled out");
                                return false;
                        }
                        if (y == null || y == "") {
                                alert("Description must be filled out");
                                return false;
                        }
                        if (z == null || z == "") {
                                alert("Tag must be filled out");
                                return false;
                        }
                $('#tag-details').hide();
                allCategories();
            });
            
                    
            function allCategories(){
            var html = '<select name=category_id>'; ;
                    $.ajax({
                    type:"POST",
                            url:'{{url('frontend/dashboard/categories')}}',
                            data:{_token: '{{csrf_token()}}'},
                            success: function(results) {
                            var results = JSON.parse(results);
                                    $('#category').show();
                                    $.each(results, function(key, value){
                                    html = html + '<option value=' + value.id + '>' + value.name + '</option>'
                                    })
                                    html = html + '</select>';
                                    html = html + '<div><button class=category-tag-form-submission type="button" >POST</button></div>';
                                    $('#category').html(html);
                            }
                    });
            }

    $('.main-container-document').on('click', '.category-tag-form-submission', function(){
            var formData = $('#category-tag').serialize();
            $.ajax({
            type:"POST",
                    url:'{{url('frontend/dashboard/opinion')}}',
                    data:formData,
                    success: function(results) {
                    window.location.href = '{{url('/frontend/dashboard')}}';
                    }
            });
    });
    
    

</script>
@endsection
