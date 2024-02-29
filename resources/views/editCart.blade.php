<!-- resources/views/cart/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cart Item</title>
</head>
<body>
<h1>Edit Cart Item</h1>

<form id="updateCartForm" action="{{ route('cart.update', ['cart' => $cartItem->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="quantity">Quantity:</label>
    <div>
        <button type="button" id="decrementQuantity">-</button>
        <input type="number" id="quantity" name="quantity" value="{{ $cartItem->quantity }}" required>
        <button type="button" id="incrementQuantity">+</button>
    </div>
    <button type="submit">Update Cart</button>
</form>

<!-- Display the current quantity -->
<p>Current Quantity: <span id="quantity-display">{{ $cartItem->quantity }}</span></p>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to increment the quantity
        $('#incrementQuantity').click(function() {
            var quantityInput = $('#quantity');
            var currentQuantity = parseInt(quantityInput.val(), 10);
            quantityInput.val(currentQuantity + 1);
        });

        // Function to decrement the quantity
        $('#decrementQuantity').click(function() {
            var quantityInput = $('#quantity');
            var currentQuantity = parseInt(quantityInput.val(), 10);
            if (currentQuantity > 1) {
                quantityInput.val(currentQuantity - 1);
            }
        });

        // Update quantity on input change
        $('#quantity').on('input', function() {
            var quantityInput = $(this);
            var currentQuantity = parseInt(quantityInput.val(), 10);
            if (isNaN(currentQuantity) || currentQuantity < 1) {
                quantityInput.val(1); // Set minimum quantity to 1
            }
        });

        $('#updateCartForm').submit(function(event) {
            event.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                type: method,
                url: url,
                data: data,
                success: function(response) {
                    alert(response.message);

                    // Update the quantity displayed on the page
                    var quantityInput = form.find('#quantity');
                    var newQuantity = quantityInput.val();
                    $('#quantity-display').text(newQuantity);

                    // Handle success as needed
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.error || "An error occurred";
                    alert(errorMessage);
                    // Handle error as needed
                }
            });
        });
    });
</script>
</body>
</html>
