<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ライセンス証明書</title>
    <style>
        .serial-table {
            border-collapse: collapse;
            width: 100%;
        }

        .serial-tr {
            page-break-inside: avoid;
        }

        .serial-th,
        .serial-td {
            border: 1px solid black;
            text-align: center;
            font-size: 30px;
            margin: 10px;
            height: 40px;
        }

        h1 {
            font-style: italic;
        }

        h2 {
            margin: 0;
        }

        .license-table {
            width: 100%;
        }

        .license-th {
            width: 25%;
            text-align: left;
            padding-left: 10px;
        }

        .license-td {
            width: 75%;
            text-align: right;
            padding-right: 10px;
        }

        hr {
            margin: 0;
            height: 1px;
            border-width: 0;
            color: black;
            background-color: black;
        }

        .license-hr {
            background-color: gray;
        }

        .license-to-serial-hr {
            border: none;
            border-top: 2px dotted dimgray;
            color: white;
            background-color: white;
            height: 2px;
        }

    </style>
</head>

<body>
    <h1>ソフトウェアライセンス証明書</h1>
    <hr>
    <h3>下記の通り、アプリケーションライセンスを発行致しました。</h3>
    <h3>本証明書は大切に保管してください。</h3>
    <hr>
    <table class="license-table">
        <tr>
            <th class="license-th">
                <h1>製品名 :</h1>
            </th>
            <td class="license-td">
                <h1>{{$productname}}</h1>
                <hr class='license-hr'>
            </td>
        </tr>
        <tr>
            <th class="license-th">
                <h2>ライセンス番号 : </h2>
            </th>
            <td class="license-td">
                <h2>{{$licenseid}}</h2>
                <hr class='license-hr'>
            </td>
        </tr>
        <tr>
            <th class="license-th">
                <h2>ライセンス数 : </h2>
            </th>
            <td class="license-td">
                <h2>{{count($serialids)}}</h2>
                <hr class='license-hr'>
            </td>
        </tr>
        <tr>
            <th class="license-th">
                <h2>メールアドレス : </h2>
            </th>
            <td class="license-td">
                <h2>{{$email}}</h2>
                <hr class='license-hr'>
            </td>
        </tr>
        <tr>
            <th class="license-th">
                <h2>登録者 : </h2>
            </th>
            <td class="license-td">
                <h2>{{$username}} 様</h2>
                <hr class='license-hr'>
            </td>
        </tr>
        <tr>
            <th class="license-th">
                <h2>発行日 : </h2>
            </th>
            <td class="license-td">
                <h2>{{$created_at}}</h2>
                <hr class='license-hr'>
            </td>
        </tr>
    </table>

    <hr class='license-to-serial-hr' style='margin-top:30px;margin-bottom:30px;dashed;'>

    <table class="serial-table">
        <tr class="serial-tr">
            <th class="serial-th" style='background-color:dimgray;color:white'>SERIAL ID</th>
            @foreach ($serialids as $serial)
        <tr class="serial-tr">
            <td class="serial-td">{{ $serial }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>
