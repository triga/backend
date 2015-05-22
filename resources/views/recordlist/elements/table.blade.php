<table class="table table-striped table-hover table-condensed">
    <thead>
        <tr>

            @foreach($columns as $column)
                @include('trigabackend::recordlist.elements.column')
            @endforeach

        </tr>
    </thead>
    <tbody>

        @foreach($results as $result)

            <tr>

                @foreach($columns as $column)
                    @include('trigabackend::recordlist.elements.cell', ['value' => $result->{$column}])
                @endforeach

            </tr>

        @endforeach

    </tbody>
</table>
