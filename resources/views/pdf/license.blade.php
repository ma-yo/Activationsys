<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ライセンス証明書</title>
  <style>
    table {
      border-collapse: collapse;
      width:100%;
    }

    tr {
      page-break-inside: avoid;
    }

    th,
    td {
      border: 2px solid black;
      text-align: center;
      font-size: 30px;
      margin:10px;
      height:40px;
    }
    h1{
        font-style: italic;
    }
  </style>
</head>

<body>
    <h1>ソフトウェアライセンス証明書</h1>
    <hr>
    <h3>下記の通り、アプリケーションライセンスを発行致しました。</h3>
    <h3>本証明書は大切に保管してください。</h3>
    <hr>
    <h1>製品名 : {{$productname}}</h1>
    <h2>ライセンス番号 : {{$licenseid}}</h2>
    <h2>ライセンス数 : {{count($serialids)}}</h2>
    <h2>登録時メールアドレス : {{$email}}</h2>
    <h2 style='width:100%;text-align:right'>登録者 : {{$username}} 様</h2>
    <h2 style='width:100%;text-align:right'>登録日 : {{$created_at}}</h2>
    <hr>
  <table>
    <tr>
      <th style='background-color:dimgray;color:white'>SERIAL ID</th>
      @foreach ($serialids as $serial)
        <tr>
            <td>{{ $serial }}</td>
        </tr>
    @endforeach
  </table>
</body>

</html>