<x-main-layout>
    <x-slot name="title">Голосование №{{ $voiting->id }}</x-slot>
    <x-slot name="content">
        <div class="text-block">
            <h1>Голосование №{{ $voiting->id }} - до {{ substr($voiting->end_date, 8, 2) . '.' . substr($voiting->end_date, 5, 2) }}</h1>
            <div class="hr"></div>
            <div class="voiting-list">
                <form action="#" name="addvote" method="get">
                    @foreach ($musicians as $musician)
                        @if (!isset($vote) || $vote != $musician->id)
                            <a href="#" style="pointer-events: none; cursor: default;">{{ $musician->name }} - Голосов: {{ $musician->votes }}</a>
                            <label for=""></label>
                        @else
                            <a href="#" style="pointer-events: none; cursor: default;" class="voted">{{ $musician->name }} - Голосов: {{ $musician->votes }}</a>
                            <label for=""></label>
                        @endif
                    @endforeach
                    @if (!$voiting->is_published)
                        <a href="#" style="pointer-events: none; cursor: default;">Liceyskii - голосов: множество</a>
                        <label for=""></label>
                    @endif
                </form>
            </div>
        </div>
    </x-slot>
</x-main-layout>