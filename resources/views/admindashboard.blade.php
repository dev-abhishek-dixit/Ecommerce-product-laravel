  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<x-app-layout>
    <x-slot name="header">
      
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Product
        </h2>
    </x-slot>
       

    <div class="py-12">
        <div class="container mt-5">
    
     @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <form action="{{url('/product/store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control-file" id="image" name="image" required>
      </div>
      <div class="form-group">
        <label for="product_name">Product Name:</label>
        <input type="text" class="form-control" id="product_name" name="product_name" required>
      </div>
      <div class="form-group">
        <label for="rate">Rate:</label>
        <input type="number" class="form-control" id="rate" name="rate" required>
      </div>
      <div class="form-group">
        <label for="available_stocks">Available Stocks:</label>
        <input type="number" class="form-control" id="available_stocks" name="available_stocks" required>
      </div>
      <button type="submit" class="btn btn-success" style="color:black !important;">Add</button>
    </form>
  </div>

    </div>
</x-app-layout>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
