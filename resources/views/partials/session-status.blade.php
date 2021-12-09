@if (session('status')=="")
    
@else
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{session('status')}}</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif