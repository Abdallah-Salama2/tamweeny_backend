<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Cards</title>
</head>
<body>
<h1>Admin Cards</h1>
<ul>
    @foreach ($adminCards as $adminCard)
        <li>Name: {{ $adminCard->name }}</li>
        <li>Email: {{ $adminCard->email }}</li>
        <!-- Display other admin card details as needed -->

        <!-- Link to download the national ID card PDF -->
        <li>National ID Card PDF: <a href="{{ Storage::url($adminCard->national_id_card_and_birth_certificate) }}" target="_blank">Download</a></li>
        <li>
            <iframe src="{{ Storage::url($adminCard->national_id_card_and_birth_certificate) }}" width="600" height="400"></iframe>
            {{ Storage::url($adminCard->national_id_card_and_birth_certificate) }}
        </li>



        <!-- Links to download or view the followers' national ID card PDFs -->
        @if ($adminCard->followers_national_id_cards_and_birth_certificates)
            <li>Followers' National ID Cards PDFs:</li>
            <ul>
                @foreach (json_decode($adminCard->followers_national_id_cards_and_birth_certificates) as $path)
                    <li><a href="{{ Storage::url($path) }}" target="_blank">Download</a></li>
                    <!-- Alternatively, you can use an <iframe> to embed the PDF file -->
                     <li><iframe src="{{ Storage::url($path)  }}" width="600" height="400"></iframe></li>
                @endforeach
            </ul>
        @endif
    @endforeach
</ul>
</body>
</html>
