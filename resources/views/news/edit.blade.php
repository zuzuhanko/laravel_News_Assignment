@extends('Layout.app')

@section('content')
<div class="container">
    <div class="card">

            <form action="{{route('update',$data->no)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-5 d-flex justify-content-center">
                <div class="col-2">
<img src="https://static.thenounproject.com/png/1560838-200.png" width="100%">

<input type="file" class="col-sm-9 " name="photo">
               </div>

   <div class="col-8 mb-5">

                  <label for="" class="form-label">Title of news</label>
                  <input type="text" class="form-control"  name="title" value="{{old('title',$data->title)}}"><br>

                  <label for="" class="form-label">Type of news</label>
                  <select name="type" class="form-control">
                    <option value="">Choose Option</option>
                    @if ($data->type == 1)
                    <option value="1" selected>Important</option>
                    <option value="0">Normal</option>

                    @else
                    <option value="1">Important</option>
                    <option value="0" selected>Normal</option>
                    @endif
                </select>
    </div>

    <textarea id="summernote" name="detail" >{{$data->detail}}</textarea>
    <script>
       $(document).ready(function() {
        $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 100
      }).html('');
    });
      </script>



<div class="col-sm-10"><button type="submit" class="btn btn-primary mt-5 mb-4">Submit</button></div>

</div>
    </form>

    </div>
</div>
@endsection
