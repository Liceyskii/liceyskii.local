<x-main-layout>
    <x-slot name="title">Предложить исполнителя</x-slot>
    <x-slot name="content">
        <div class="auth-form">
            <form name="addmusician" action="{{ route('add.new.musician') }}" method="post">
                @csrf
                @if ($errors->any())
                    <label for=""></label>
                    @foreach ($errors->all() as $error)
                        {{ $error }} 
                    @endforeach
                @endif
                <label for="name">Имя музыканта / название группы</label>
                <input type="text" name="name">
                <label for="genre">Жанр</label>
                <select name="genre">
                    <option value = "null">-выберите жанр-</option>
                    <option value = "Рок / поп-рок">Рок / поп-рок</option>
                    <option value = "Хайперпоп / Электронная музыка">Хайперпоп / Электронная музыка</option>
                    <option value = "Рэп">Рэп</option>
                    <option value = "Другое">Другое</option>
                </select>
                <label for=""></label>
                <div style="display: flex; justify-content: center; align-items: center;">
                    {!! htmlFormSnippet() !!}
                </div>
                <label for=""></label>
                <input type="submit" class="btn">
            </form>
        </div>
    </x-slot>
</x-main-layout>