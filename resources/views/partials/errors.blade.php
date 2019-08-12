@if( $errors->{$bag ?? 'default'}->any())
    <div>
        @foreach($errors->{$bag ?? 'default'}->all() as $error)
            <div class="alert alert-danger {{ $class }}" role="alert">
                <strong>Oh snap!</strong> {{ $error }}
            </div>
        @endforeach
    </div>
@endif