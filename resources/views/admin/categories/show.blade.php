


@extends('admin.layout.main')

@section('title',$category->name)
@section('breadcrumb')

@parent
<li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

@section('content')
<div class="row">
<x-alert/>
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <h3 class="card-title">Categories Data</h3>

        </div>
          <!-- /.card-header -->

          <div class="card-body">

            <table class="table table-bordered">
                <thead>
                  <tr>
                      <th>Name</th>
                      <th>Store</th>
                      <th>Status</th>
                      <th>Create At</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $products=$category->products()->with('store')->paginate(2);
                    @endphp
                  @forelse ($products as $product )
          <tr>
              <td>
               <img src="{{ asset('images/default-img.png') }}" alt='category image' class="direct-chat-img" onerror="{{ asset('images/default-img.png') }}">
              </td>

              <td>{{ $product->name }}</td>
              <td>{{ $product->store->name }}</td>
              <td>{{ $product->status }}</td>
              <td>{{ $product->created_at }}</td>
             </tr>
          @empty
          <tr class="text-center"><td colspan="4"><span class="badge bg-warning">No products</span></td></tr>

          @endforelse

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">

              {{ $products->links() }}
              Showing {{ $products->firstItem() }} to {{ $products->lastItem() }}  of total {{$products->total()}} entries


          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->

      </div>

</div>

@endsection()

@push('scripts')
<script>

const paginate=document.querySelector('.pagination');
paginate.classList.add('float-right','pagination-sm','m-0');

</script>
@endpush
