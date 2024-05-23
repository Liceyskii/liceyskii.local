<x-main-layout>
    <x-slot name="title">Голосование №{{ $voiting->id }}</x-slot>
    <x-slot name="content">
        <div class="text-block">
            <h1>Голосование №{{ $voiting->id }} - до {{ substr($voiting->end_date, 8, 2) . '.' . substr($voiting->end_date, 5, 2) }}</h1>
            <div class="hr"></div>
            <div class="voiting-list">
                <form action="#" name="addvote" method="get">
                    @foreach ($musicians as $musician)
                        <a href="{{ route('voite.add', ['musician_id' => $musician->id, 'voiting_id' => $voiting->id]) }}">{{ $musician->name }} - {{ $musician->votes / $totalVotes * 100 | round(0) }}%</a>
                        <label for=""></label>
                    @endforeach
                </form>
            </div>
        </div>
    </x-slot>
</x-main-layout>