<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Responsive Image</title>

    <style>
        .responsive {
            max-width: 100%;
            max-height: 100%;
        }

        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

    </style>

</head>

<body>

    <div>
        <img class="responsive center" src="{{ asset('files/' . $img) }}" alt="Not Found">
    </div>

</body>

</html>
