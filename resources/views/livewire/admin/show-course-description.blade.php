<div>
    <h3 class="text-4xl text-center mb-4 font-bold">
        <span class="underline">{{ $course->title }}</span> <a href="{{ route('admin.course.edit', $course->id) }}" class="mx-4"> <i class="fa fa-arrow-left"></i> </a>
    </h3>

    {!! $courseDescription !!}
</div>

@push('css')
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
@endpush