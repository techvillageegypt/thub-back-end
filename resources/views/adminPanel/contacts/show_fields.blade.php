<!-- Name Field -->
<div class="form-group show">
    {!! Form::label('name', __('models/contacts.fields.name').':') !!}
    <b>{{ $contact->name }}</b>
</div>

<!-- Email Field -->
<div class="form-group show">
    {!! Form::label('email', __('models/contacts.fields.email').':') !!}
    <b>{{ $contact->email }}</b>
</div>

<!-- phone Field -->
<div class="form-group show">
    {!! Form::label('phone', __('models/contacts.fields.phone').':') !!}
    <b>{{ $contact->phone }}</b>
</div>

<!-- Subject Field -->
<div class="form-group show">
    {!! Form::label('subject', __('models/contacts.fields.subject').':') !!}
    <b>{{ $contact->subject }}</b>
</div>

<!-- Message Field -->
<div class="form-group show">
    {!! Form::label('message', __('models/contacts.fields.message').':') !!}
    <b>{{ $contact->message }}</b>
</div>

<!-- Created At Field -->
<div class="form-group show">
    {!! Form::label('created_at', __('models/contacts.fields.created_at').':') !!}
    <b>{{ $contact->created_at }}</b>
</div>
