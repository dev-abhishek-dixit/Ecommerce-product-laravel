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
                    <th>Product Name</th>
                    <th>Product price</th>
                    <th>Product stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $pro)
                    <tr>
                        <td>{{ $pro->product_name }}</td>
                        <td>{{ $pro->rate }}</td>
                        <td>
                          {{ $pro->available_stocks }}
                        </td>
                        <td>
                          
                                <a href="{{ route('product.delete', $pro->id) }}"
                                   class="btn btn-danger btn-sm">Delete</a>
                          
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
