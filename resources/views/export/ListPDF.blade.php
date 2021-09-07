<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Develop By Softwarezon - Hasan Rahman</title>
    <style>
        body {
            font-family: 'solaimanlipi', sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid slategray;
            margin: 5px;
            height: 25px;
            padding: 5px;
        }
        .text-center {
            text-align: center
        }
    </style>
</head>
<body>
<img src="{{ public_path('img/pad.png') }}" alt="">
<table id="example1" class="table table-bordered table-striped" style="font-size: 14px;">
    <thead>
    <tr>
        @foreach($tableHead as $key=> $thead)
            <th>{{$thead}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($tableRows as $index => $rows)
        <tr>
            @foreach($rows as $k=> $row)
                <td>{{$row}}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
