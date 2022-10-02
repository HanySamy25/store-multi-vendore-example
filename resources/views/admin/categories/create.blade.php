@extends('admin.layout.main')

@section('title', 'Categories')
@section('breadcrumb')

    @parent
    <li class="breadcrumb-item active">Starter</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">New Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.categories._partial')
                </form>
            </div>
        </div>
    </div>

@endsection()
