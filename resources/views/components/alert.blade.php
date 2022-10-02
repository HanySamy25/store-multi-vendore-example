{{-- @if(session()->has($type))
<div class="alert alert-{{ $type }}">
    {{ session($type) }}
</div>
@endif --}}


{{-- @if (session()->has($type))
<div class="col-lg-12">
    <div class="card bg-{{ $type }}">
      <div class="card-header">
        <h3 class="card-title">{{ $type }}</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
          </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        {{ session($type) }}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endif --}}







@if (session()->has('success'))
<div class="col-lg-12">
    <div class="card bg-success">
      <div class="card-header">
        <h3 class="card-title">Success</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
          </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        {{ session('success') }}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endif

@if (session()->has('failed'))
<div class="col-lg-12">
    <div class="card bg-danger">
      <div class="card-header">
        <h3 class="card-title">Error</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
          </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        {{ session('faild') }}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endif

@if (session()->has('info'))
<div class="col-lg-12">
    <div class="card bg-info">
      <div class="card-header">
        <h3 class="card-title">Info</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
          </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        {{ session('info') }}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endif
