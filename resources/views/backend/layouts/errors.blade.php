@if($errors->any())
    @error('permission')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror
@endif
