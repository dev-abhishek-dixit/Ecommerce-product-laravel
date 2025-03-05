<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        @php $count = 0; @endphp
        @foreach($products as $product)
            @if($count % 3 === 0)
                <div class="row">
            @endif
            <div class="col-md-4">
                <div class="card">
                    <img class="card-image img-fluid product-image" src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->product_name }}" style="max-height: 300px; object-fit: contain;">
                    <div class="card-content">
                        <h3 class="card-title">{{ $product->product_name }}</h3>
                        <p class="card-info">Rate: {{ $product->rate }}</p>
                        <p class="card-info">Available Stocks: {{ $product->available_stocks }}</p>
                    </div>
                    <button class="btn btn-primary">
                        <a class="card-button" href="{{ route('cart.add', ['id' => $product->id]) }}">Add to Cart</a>
                    </button>
                </div>
            </div>
            @php $count++; @endphp
            @if($count % 3 === 0 || $loop->last)
                </div>
            @endif
        @endforeach
    </div>
</div>

        </div>
    </div>
</x-app-layout>
