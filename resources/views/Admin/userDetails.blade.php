  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<x-app-layout>
    <x-slot name="header">
      
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User List
        </h2>
    </x-slot>
       

    <div class="py-12">
        <div class="container mt-5">
    
     @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <div class="container">
      

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->status == 'active')
                                <span class="badge badge-success">{{ $user->status }}</span>
                            @else
                                <span class="badge badge-danger">{{ $user->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->status == 'Active')
                                <a href="{{ route('users.deactivate', $user->id) }}"
                                   class="btn btn-danger btn-sm">Deactivate</a>
                            @else
                                <a href="{{ route('users.activate', $user->id) }}"
                                   class="btn btn-success btn-sm">Activate</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  
  </div>

    </div>
</x-app-layout>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
