@if(count($errors) > 0)
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    @foreach ($errors->all() as $error)
    <strong>{{ $error }}</strong>

    @endforeach
</div>
@endif
