@foreach($teachers as $teacher)
    @isset($teacher['name'])
        <h4>{{ $teacher['name'][0] }}</h4>
    @endisset
@endforeach
