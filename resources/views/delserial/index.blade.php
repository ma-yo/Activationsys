@extends('layout.common')
@section('title', 'アクティベーションシステム - シリアル削除')
@section('css')
<link href="css/delserial-index.css" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/delserial-index.js"></script>
@endsection

@section('content')

<p class="text-danger h2">シリアル削除を行います。</p>
<p class="text-danger h2">ユーザーはアプリケーションを利用できなくなりますのでご注意ください。</p>

<form id="delserial-form" class="form" action="{{ url('/delserial') }}" method="post">
    @csrf

    <div class="form border border-info p-3 rounded">
        <div class="form-group form-inline">
            <input type="text" id="searchword" name="searchword" class="form-control" value="" style="width:400px;"
                placeholder="名称やE-mailを入力してください。"/>
            <input type="submit" id="searchserial" name="searchserial" class="btn btn-primary btn-md ml-1" value="検索">
        </div>
        <hr>
        <input type="hidden" id="content" name="content" value="delserial" />
        @if(!$activeUsers->isEmpty())
            <input type="hidden" id="delserialid" name="delserialid" value="{{ $activeUsers[0]->serialid }}" />
        @else
            <input type="hidden" id="delserialid" name="delserialid" value="" />
        @endif
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>SELECT</th>
                    <th>SERIAL</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>BIOSID</th>
                </tr>
            </thead>
            @if(!$activeUsers->isEmpty())
                <tbody>
                    @foreach($activeUsers as $user)
                        <tr>
                            <td>
                                @if($loop->index === 0)
                                    <input type="radio" id="delselect-{{ $user->serialid }}" name="delselect"
                                        value="{{ $user->serialid }}" checked>
                                @else
                                    <input type="radio" id="delselect-{{ $user->serialid }}" name="delselect"
                                        value="{{ $user->serialid }}">
                                @endif
                            </td>
                            <td><small>{{ $user->serialid }}</small></td>
                            <td><small>{{ $user->name }}</small></td>
                            <td><small>{{ $user->email }}</small></td>
                            <td><small>{{ $user->biosid }}</small></td>
                    @endforeach
                    </tr>
                </tbody>
            @endif
        </table>
        <div class="form-group">
            @if(!$activeUsers->isEmpty())
                <input type="submit" id="delserial" name="delserial" class="btn btn-danger btn-md" value="シリアル削除">
            @endif
            <input type="submit" id="menu" name="menu" class="btn btn-secondary btn-md" value="戻る">
        </div>
    </div>

</form>

@endsection
