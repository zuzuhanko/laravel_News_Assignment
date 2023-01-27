@extends('Layout.app')
@section('content')

@if (Session::has('create'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
   {{Session::get('create')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if(Session::has('update'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
   {{Session::get('update')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  @if(Session::has('delete'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
   {{Session::get('delete')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">

                <div class="btn-group" role="group" aria-label="Basic example">
                   <a href="{{route('important')}}"> <button type="button" class="btn btn-dark">Important</button></a>
                   <a href="{{route('normal')}}"><button type="button" class="btn btn-primary">Normal</button></a>

                  </div>

                <div class="card-tools">

        <a href="{{route('create')}}"><button class=" bg-primary form-control float-right"  style="width: 150px;">
            ADD
              </button></a>


              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Photo</th>
                      <th>Title</th>
                      <th>Created date</th>
                      <th>Action</th>

                    </tr>
                  </thead>


                     @foreach ($data as $item)
                         <tbody>
                            <tr>
                                <td>{{$item->no}}</td>
                                <td><img width="100px;" src="{{$item->photo}}"></td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->created_at}}</td>
<td>
    <a href="{{route('edit',$item->no)}}"><button class="btn btn-sm bg-primary text-white"><i class="fas fa-edit"></i></button></a>
    <a href="{{route('delete',$item->no)}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
</td>

                            </tr>
                         </tbody>
                     @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    @endsection
