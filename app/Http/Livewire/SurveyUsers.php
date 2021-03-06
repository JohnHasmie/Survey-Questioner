<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Survey;
use App\Models\User;

class SurveyUsers extends Component
{
    use WithPagination;

    public function render()
    {
        $surveys = Survey::with(['responses' => function ($q) {
            $q->orderBy('user_id');
            $q->groupBy('survey_id');
            $q->groupBy('user_id');
        }])->get();

        // dd($surveys->toArray());

        $users = User::get();

        return view('livewire.survey-users', [
            'surveys' => $surveys,
            'users' => $users,
        ]);
    }
}
