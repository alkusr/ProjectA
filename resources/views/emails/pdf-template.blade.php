<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    {{-- <link rel="stylesheet" href="assets/css/bootstrap.css"> --}}
</head>
<style>
    /* border table */
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #000;
    }

    table th,
    td {
        border: 1px solid #000;
        padding: 5px;
    }

</style>

<body>
    <table class="table table-responsive">
        <thead>
            <tr class="text-center text-white">
                <th class="bg-primary" style="background-color: blue;color:#fff;width:50%;">Kategori</th>
                <th class="bg-primary" style="background-color: blue;color:#fff;width:50%;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participant_test->participantTestResult->participantTestResultDetails as $item)
                <tr class="text-center">
                    <td>{{ $item->testResultCategory->name }}</td>
                    <td>{{ round($item->percent) }} %</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <script src="assets/js/bootstrap.bundle.min.js"></script> --}}
</body>

</html>
