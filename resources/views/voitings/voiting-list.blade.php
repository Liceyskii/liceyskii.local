<x-main-layout>
    <x-slot name="title">Голосования</x-slot>
    <x-slot name="content">
        <div class="text-block">
            <h1>Голосования</h1>
            <div class="hr"></div>
            <div class="voiting-list">
                <p>На этой странице вы можете посмотреть результаты прошедших голосований или получаствовать в актуальном.
                    Переходите по ссылкам ниже чтобы проголосовать за одного из музыкантов, прошедших модерацию 
                    <a href="{{ route('addmusician') }}" style="text-decoration: underline;">или предложите своего</a>
                </p>
                @foreach ($voitings as $voiting)
                    <a href="{{ route('voiting.view', ['id' => $voiting->id]) }}">Голосование №{{ $voiting->id }} - до {{ substr($voiting->end_date, 8, 2) . '.' . substr($voiting->end_date, 5, 2) }}</a>
                    <label for=""></label>
                @endforeach
            </div>
        </div>
    </x-slot>
</x-main-layout>