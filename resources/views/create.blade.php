<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin Card</title>
</head>
<body>
<h1>Create Admin Card</h1>
<form action="{{ route('admin-cards.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <!-- Admin Card Details -->
    <label for="name">Name:</label>
    <input type="text" name="name" id="name">
    <label for="admin_id">Admin Id:</label>
    <input type="text" name="admin_id" id="admin_id">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email">
    <label for="gender">Gender:</label>
    <input type="text" name="gender" id="gender">
    <label for="salary">salary:</label>
    <input type="text" name="salary" id="salary">

    <!-- Add more input fields for other admin card details -->

    <!-- Single PDF Upload -->
    <label for="national_id_card_and_birth_certificate">Upload Single PDF:</label>
    <input type="file" name="national_id_card_and_birth_certificate" id="national_id_card_and_birth_certificate">

    <!-- Multiple PDF Upload -->
    <label for="followers_national_id_cards_and_birth_certificates">Upload Multiple PDFs:</label>
    <input type="file" name="followers_national_id_cards_and_birth_certificates[]" id="followers_national_id_cards_and_birth_certificates" multiple>

    <button type="submit">Submit</button>
</form>
</body>
</html>
