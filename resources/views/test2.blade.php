<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Images</title>
</head>

<body>
<h1>Test Images</h1>

@foreach($categories as $category)
    <div>
        <h2>{{ $category->category_name }}</h2>
        <img src="data:image/jpeg;base64,{{ $category->category_image}}" alt="{{ $category->category_name }} Image">



        {{--        <img src="{{ asset('storage/images/1708192320.jpg') }}" alt="" title="" />--}}

    </div>
@endforeach
</body>

</html>
