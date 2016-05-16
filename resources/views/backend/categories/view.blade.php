@extends('layouts.backend')
@section('title','View Categories')
@section('content') 
<div class='success-message'>
    @if(isset($message))
      <div class='message'>{{$message}}</div>
    @endif
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Status</th>                            
                <th><a href="{{ url('/backend/categories/form') }}"><i class="fa fa-plus"></i>&nbsp;Add User</a></th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($categories))
            {{--*/ @$i = 1  /*--}}
            @foreach($categories as $category)
            <tr class="delete-{{$category['id']}}">
                <td>{{ $i++ }}</td>
                <td>{{$category['name']}}</td>
                <td>{{$category['status']}}</td>                       
                <td>
                    <a href="{{url('/backend/categories/edit-categories',[$category['id']])}}"><span class="fa fa-lock"></span></a>                                 
                    <a href="#"><span class="fa fa-remove delete_categories" category_id="{{$category['id'] }}"></span></a>                                
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
<script type='text/javascript'>
    $('.delete_categories').click(function() {      
        if(confirm("Are you sure you want to delete this?")){            
            $('.se-pre-con').show();
            var self = $(this);
            $.ajax({
              type: "post",
              url: '{{url('backend/categories/delete-categories')}}',
            data: {id: $(this).attr('category_id'), _token: '{{csrf_token()}}'},
            success: function(results) {
                $('.se-pre-con').hide();
                $('.msg').delay(2000).fadeOut();
                $('.delete-' + self.attr('category_id')).remove();
            }
        });
       }
    });
</script>
@endsection