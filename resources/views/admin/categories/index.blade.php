


@extends('admin.layout.main')

@section('title','Categories')
@section('breadcrumb')

@parent
<li class="breadcrumb-item active">Starter</li>
@endsection

@section('content')
<div class="row">
<x-alert/>
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <div class="d-flex justify-content-between gap-10">
                <h3 class="card-title">Categories Table</h3>
                <a href="{{ route('admin.categories.create') }}" style="width: 100px" class=" btn btn-block btn-outline-primary">Create</a>
                <div class="card-tools ml-auto">
                    <form action="{{ URL::current() }}" method="get">
                    <div class="input-group input-group-sm d-flex justify-content-between" style="width: 300px;position: relative;">

                            <input type="text" name="name" class="form-control float-right" placeholder="Search" value="{{ request('name') }}">

                            <select name="status" style="position: absolute;margin-left:-110px;width:100px" class="form-control">
                                <option value="">Status</option>
                                <option value="active" @selected(request('status')=='active')>active</option>
                                <option value="inactive" @selected(request('status')=='inactive')>inactive</option>
                            </select>

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
          <!-- /.card-header -->

          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Product</th>
                    <th>description</th>
                    <th>Status</th>
                    <th>Create At</th>
                    <th colspan="2"></th>
                </tr>
              </thead>
              <tbody>
                @forelse ($categories as $category )
        <tr>
            <td>
             {{-- <img src="{{ asset('storage/'.$category->image) }}" alt='category image' class="direct-chat-img"> --}}
            </td>
            <td><a href="{{ route('admin.categories.show',$category->id) }}">{{ $category->name }}</a></td>
            <td>{{ $category->parent_name }}</td>
            <td>{{ $category->products_count }}</td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->status }}</td>
            <td>{{ $category->created_at }}</td>
            <td>
                <a href="{{ route('admin.categories.edit',$category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{ route('admin.categories.destroy',$category->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr class="text-center"><td colspan="7"><span class="badge bg-warning">No Categories</span></td></tr>

        @endforelse

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            {{-- <ul class="pagination pagination-sm m-0 float-right">
              <li class="page-item"><a class="page-link" href="#">«</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul> --}}
            {{ $categories->withQueryString()->appends(['search'=>'1'])->links() }}
            Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }}
            of total {{$categories->total()}} entries
        </div>
        </div>
        <!-- /.card -->

      </div>

</div>

@endsection()


@push('scripts')
<script>

const paginate=document.querySelector('.pagination');
// paginate.classList.add('float-right','pagination-sm','m-0');

</script>
@endpush
