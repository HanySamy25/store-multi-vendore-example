@extends('admin.layout.main')

@section('title', 'Products')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Products</li>
@endsection

@section('content')

<form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    @include('admin.products._form')
</form>

@endsection
