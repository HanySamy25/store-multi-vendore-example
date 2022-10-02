@extends('admin.layout.main')

@section('title', 'Edit Product')

@section('breadcrumb')
@parent
<li class="breadcrumb-item">Products</li>
<li class="breadcrumb-item active">Edit Product</li>
@endsection

@section('content')

<form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    @include('admin.products._form', [
        'button_label' => 'Update'
    ])
</form>

@endsection
