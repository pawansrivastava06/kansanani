@extends('layouts.backend')
@section('title','Categories')
@section('content')   
<div>
    <div>
        <form class="form-horizontal" role="form" method="POST" action="{{url('/backend/categories/add-categories')}}">
                            {!! csrf_field() !!}
                            <input type="hidden" class="form-control" name="id" value="{{(isset($categories['id']))?$categories['id']:''}}">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Name</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" value="{{(isset($categories['name']))?$categories['name']:''}}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="sel1">Status</label>
                                <div class="col-md-8">
                                    <select name="status" class="form-control" id="status">
                                        <option value="">Select</option>
                                        <option value="1" {{(isset($categories['status']) && $categories['status']==1)?'selected':''}}>Active</option>
                                        <option value="2" {{(isset($categories['status']) && $categories['status']==2)?'selected':''}}>Deactive</option>
                                    </select>
                                @if ($errors->has('process'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>                        
                            <div class="form-group col-md-6">
                                <div class="col-md-4 col-md-offset-9">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        {{(isset($categories['id']))?'Update Project':'Add Project'}}                                    </button>
                                </div>
                            </div>                           
                            <div class="form-group col-md-6">
                                <div class="col-md-4 col-md-offset-4">
                                    <button class="btn btn-block btn-primary cancelbtn">
                                        Cancel
                                    </button>
                                    <!--<a href="{{url('/home')}}">Cancel</a>-->
                                </div>
                            </div>                           
                  </form>
            <div>    
</div>
        <script type='text/javascript'>
            $('.cancelbtn').click(function(e){
                e.preventDefault();                
               window.location.href='{{url('backend/categories/index')}}' 
            });
        </script>
@endsection
