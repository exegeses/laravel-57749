
@if( $errors->any() )
<div class="alert alert-danger col-8 mx-auto">
    <ul>
        @foreach( $errors->all() as $error )
        <li>
            <i class="bi bi-exclamation-triangle"></i>
            {{ $error }}
        </li>
        @endforeach
    </ul>
</div>
@endif
