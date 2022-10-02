<div class="card-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif
    <div class="form-group">

        <x-form.input type='text' label="Category Name" name='name' class="form-control" data-role="input"
            value="{{ $category->name }}" />
    </div>
    <div class="form-group">
        <x-form.label id='image' />Parent</x-form.label />

        <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
            <option value="">Primary Category</option>
            @forelse ($parents as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}
                </option>
            @empty
            @endforelse
        </select>
        @error('parent_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="" cols="30" rows="5">{{ old('description', $category->description) }}</textarea>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="image" accept="image/*">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
            @if ($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt='image' class="direct-chat-img">
            @endif
        </div>
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <x-form.radio name='status' :checked="$category->status" :options="['active' => 'Active', 'inactive' => 'Inactive']" />
        @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<!-- /.card-body -->
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $btnlbl ?? 'Save' }}</button>
</div>
