<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use App\Models\Voiting;
use App\Models\Musician;
use App\Models\UserVote;

class VoitingController extends Controller
{

    private function resultCheker()
    {
        $voitings = Voiting::orderByDesc('end_date')->get();
        foreach ($voitings as $voiting) {
            // Проверка - если дата голосования подошла к концу, то фиксируем победителей
            if (Carbon::parse($voiting->end_date)->isPast() && $voiting->first_musician_id == null && $voiting->second_musician_id == null) {
                $first_winner = Musician::where('is_published', 1)->orderByDesc('votes')->first();
                $voiting->update(['first_musician_id' => $first_winner->id]);
                $first_winner->update(['is_published' => 0]);
                $second_winner = Musician::where('is_published', 1)->orderByDesc('votes')->first();
                $voiting->update(['second_musician_id' => $second_winner->id]);
                $second_winner->update(['is_published' => 0]);
                $voiting->update(['is_published' => 0]);
            }
        }
    }

    public function voitingList() {
        // Вывод страницы с голосованиями
        $voitings = Voiting::orderByDesc('end_date')->get();
        return view('voitings.voiting-list', ['voitings' => $voitings]);
    }

    public function voitingView(Request $request) {
        // Проверка актуальности голосования
        $this->resultCheker();
        $voiting = Voiting::where('id', $request['id'])->first();
        $votes = UserVote::where('voiting_id', $voiting->id)->get();
        // Если голосование завершено, вывести результаты
        if ($voiting->is_published == 0) {
            $musicians = Musician::where('id', $voiting->first_musician_id)->orWhere('id', $voiting->second_musician_id)->orderByDesc('votes')->get();
            return view('voitings.voiting-result', ['voiting' => $voiting, 'musicians' => $musicians]);
        } elseif (!session('user')) { // если пользователь не авторизован, вывести страницу с неактивными кнопками
            $musicians = Musician::where('is_published', true)->orderByDesc('votes')->get();
            return view('voitings.voiting-result', ['voiting' => $voiting, 'musicians' => $musicians]);
        }
        // Если пользователь уже голосовал вывести страницу с неактивными кнопками и отметить его голос
        foreach ($votes as $vote) {
            if ($vote->user_id == unserialize(session('user'))->id && $voiting->is_published) {
                $musicians = Musician::where('is_published', true)->orderByDesc('votes')->get();
                return view('voitings.voiting-result', ['voiting' => $voiting, 'musicians' => $musicians, 'vote' => $vote->musician_id]);
            }
        }
        // Если голосование актуально, вывести всех актуальных исполнителей
        $musicians = Musician::where('is_published', true)->orderByDesc('votes')->get();
        $totalVotes = 0;
        foreach ($musicians as $musician) {
            $totalVotes += $musician->votes;
        }
        return view('voitings.voiting', ['voiting' => $voiting, 'musicians' => $musicians, 'totalVotes' => $totalVotes]);
    }

    public function voiteAdd(Request $request) {
        $votes = UserVote::where('voiting_id', $request['voiting_id'])->get();
        // Если пользователь уже голосовал вывести страницу с неактивными кнопками и отметить его голос
        $voiting = Voiting::where('id', $request['voiting_id'])->first();
        $musicians = Musician::where('id', $request['musician_id'])->first();
        if (!session('user') || !$voiting || !$musicians) abort(404);
        foreach ($votes as $vote) {
            if ($vote->user_id == unserialize(session('user'))->id || !$voiting->is_published) {
                return redirect()->route('voiting.view', ['id' => $voiting->id]);
            }
        }
        $this->resultCheker();
        $musicians->votes++;
        $musicians->save();
        $vote = new UserVote;
        $vote->user_id = unserialize(session('user'))->id;
        $vote->voiting_id = $voiting->id;
        $vote->musician_id = $request['musician_id'];
        $vote->save();
        return redirect()->back();
    }

    public function voitingResult(Request $request) {
        return 'Ваш голос засчитан!';
    }
}
