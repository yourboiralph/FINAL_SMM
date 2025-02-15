@foreach($users as $user)
<p>

    {{$user->name}} - {{$user->role->position}}
</p>
@endforeach
