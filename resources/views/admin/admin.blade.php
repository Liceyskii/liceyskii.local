<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
</head>
<body style="text-align: center;">
    <p><a href="{{ route('admin.newvoiting') }}">Создать новое голосование</a> | <a href="{{ route('index') }}">На главную</a></p>
    <hr>
    <h4>Предложенные исполнители:</h4><br>
    @if (!$voitings->isEmpty())
        {{ $i[] = '' }}
        @foreach ($musicians as $musician)
            @foreach ($voitings as $voiting)
                @if ($musician->id != $voiting->first_musician_id && $musician->id != $voiting->second_musician_id && !in_array($musician->id, $i))
                    <p><b>{{ $musician->name }}</b> : <a href="{{ route('admin.musicianaccept', ['id' => $musician->id]) }}">принять</a> | <a href="{{ route('admin.musiciandelete', ['id' => $musician->id]) }}">отклонить</a></p>
                    <small>id исполнителя: {{ $i[] = $musician->id }}</small>
                @endif
                <br>
            @endforeach
        @endforeach
    @else
        @foreach ($musicians as $musician)
            <p><b>{{ $musician->name }}</b> : <a href="{{ route('admin.musicianaccept', ['id' => $musician->id]) }}">принять</a> | <a href="{{ route('admin.musiciandelete', ['id' => $musician->id]) }}">отклонить</a></p>
            <small>id исполнителя: {{ $i[] = $musician->id }}</small>
            <br>
        @endforeach
    @endif
</body>
</html>