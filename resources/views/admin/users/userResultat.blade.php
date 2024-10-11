<!doctype html>
<html lang="fr">
    <head>
        @include('layouts.head')
        <style>
            .head{
                height: 150px;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            }

            .head{
                display: flex;
                align-items: center;
                padding-left:25px;
            }

            .main{
                width:100%;
                height: auto;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            }

            .main #dateExam{
                width:60%;
            }

            .main .custom-input {
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 10px;
                font-size: 16px;
                width: 100%;
            }

            .main .custom-input:focus {
                outline: none;
                border-color: #007bff;
            }

            .main label {
                display: block;
                margin-bottom: 10px;
            }

            .main .custom-select {
                appearance: none;
                background-color: #f2f2f2;
                border: none;
                border-radius: 5px;
                padding: 10px;
                font-size: 16px;
                width: 200px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .main .custom-select:focus {
                outline: none;
                box-shadow: 0 0 0 2px #007bff;
            }

            .main .custom-select option {
                background-color: white;
                color: black;
            }

            .main .custom-button {
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
            }

            .main .custom-button:hover {
                background-color: #0056b3;
            }

            .main .custom-button:focus {
                outline: none;
                box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
            }

            .main .custom-button:active {
                background-color: #004999;
            }
        </style>
    </head>
    <body>
        @include('layouts.sidebar')
        <!-- Page Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <header class="head mb-5">
                <h2>Les Résultats de {{ $user->name }}</h2>
            </header>

            <main class="main mb-5 p-4">
                <h4 class="mb-4">Filiere: {{ $filiere->Name }}</h4>
                @php
                    $note = 0;
                    $questionsCount = 0;
                @endphp

                @foreach ($exams as $exam)
                    @php
                        $questionsCount = count($exam->questions);
                    @endphp
                    @foreach ($exam->questions as $question)
                        @foreach ($question->answers as $answer)
                            @foreach ($chosenAnswers as $chosen)
                                @if ($chosen->question_id == $question->id  && $chosen->exam_id == $question->exam_id && $answer->answer_value == $chosen->answer_value)
                                    @if($answer->correction == 1)
                                        @php
                                            $note += 1;
                                        @endphp
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach

                <p class="text-right">La Note: {{ $note }} / {{ $questionsCount }}</p>

                <table>
                    @foreach ($exams as $exam)
                        <tr>
                            <th colspan="2">Exam: {{ $exam->Name }}</th>
                        </tr>

                        @foreach ($exam->questions as $question)
                            <tr>
                                <th>Question: 
                                    <img src="{{ asset('images/ExamQuestion/'.$question->question_img_path) }}" width="500" height="300"></th>
                                <td>
                                    <ul>
                                        @foreach ($question->answers as $answer)
                                            <li>
                                                {{ $answer->answer_value }}

                                                @foreach ($chosenAnswers as $chosen)
                                                    @if ($chosen->question_id == $question->id  && $chosen->exam_id == $question->exam_id && $answer->answer_value == $chosen->answer_value)
                                                        @if($answer->correction == 1)
                                                            <i class="bi bi-check2-all" style="color:green"></i>(Choix d'étudiant)
                                                        @else
                                                            <i class="bi bi-x-lg" style="color:red"></i> (Choix d'étudiant)
                                                        @endif
                                                    @endif

                                                    @if ($chosen->question_id == $question->id  && $chosen->exam_id == $question->exam_id && $answer->answer_value != $chosen->answer_value)
                                                        @if($answer->correction == 1)
                                                            <i class="bi bi-check2-all" style="color:green"></i>(Correction)
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            </main>

            @include('layouts.footer')
        </div>
    </div>

    @include('layouts.foot')
</body>
</html>