<a href="{{url('register')}}">Create a new user</a>

@foreach ($users as $user )
<div>

    <p>
        <div>

            {{$user->name}}
        </div>
         <a href="{{url('users/show/' . $user->id)}}">Show</a>
         <a href="{{url('users/edit/' . $user->id)}}">Edit</a>
     </p> 
     
</div>
@endforeach