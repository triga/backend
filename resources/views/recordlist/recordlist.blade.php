finally...
{{--{{ filter }}--}}

<br/>

{{--{{ pagination }}--}}

<br/>

@foreach ($columns as $column)
    <p>{{ $column }}</p>
@endforeach

<br/>

@foreach ($results as $result)
    <p>{{ var_dump($result) }}</p>
@endforeach

{{--{{ pagination }}--}}
