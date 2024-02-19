<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Images</title>
</head>

<body>
<h1>Test Images</h1>

@foreach($products as $product)
    <div>
        <h2>{{ $product->productName }}</h2>
        <p>Price: {{ $product->selling_price }}</p>
        <img src="data:image/jpeg;base64,{{ $product->productImage }}" alt="{{ $product->productName }} Image">
    </div>
@endforeach
</body>

</html>
