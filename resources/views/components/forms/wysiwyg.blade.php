<div class="mb-2">
    @push('header-add')
    @endpush
    <div class="col-form-label">{{ $label }}</div>
    <textarea name="{{ $name }}" id="summernote" class="summernote" placeholder="{{$placeholder}}"cols="30" rows="10">{!! $value !!}</textarea>
    @if(!isset($manual))
    @push('footer-add')
    <script>
        $(document).ready(()=> {
            $('#summernote').summernote({
              placeholder: 'Please write here..',
              tabsize: 2,
              height: 100
            });
        })
      </script>
    @endpush
    @endif
</div>
