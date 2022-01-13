@if(session()->has('success'))
    <b-message type="is-success" has-icon>
        <p>{{ session('success') }}</p>
    </b-message>
@endif
