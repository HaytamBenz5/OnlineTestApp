<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


        <!-- Template Main CSS File -->
        <link href="assets/css/control.css" rel="stylesheet">
    </head>
    <body style="background: url('Background.png'); background-size: cover; background-repeat: no-repeat;">
        <!-- start Quiz button-->
        <div id="wrapper" style="margin-top:100px;">
            <center><img src="log_suptech.png" style="margin-bottom:15px;" class="heading-section" width="300"></center>
            
            <div id="display-container">
                <div class="header">
                    <div class="number-of-count">
                        <span class="number-of-question"></span>
                    </div>
                    <div class="timer-div">
                        <img src="https://svgshare.com/i/iRM.svg"/>
                        <span class="time-left"></span>
                    </div>
                </div>

                <div id="container">
                    <!-- Question and options are displayed here -->
                </div>
                <div class="btn-container">
                    <button  id="next-button" hidden >Next</button>
                </div>


            </div>
        </div>


        <!-- Template Main JS File -->
        <script>
            // References


            const quizdisplay = document.getElementById("display");
            let timeLeft = document.querySelector(".time-left");
            let quizContainer = document.getElementById("container");
            let nextBtn = document.getElementById("next-button");
            let countOfQuestion = document.querySelector(".number-of-question");
            let wrapper = document.getElementById("wrapper");
            let displayContainer = document.getElementById("display-container");
            let scoreContainer = document.querySelector(".score-container");
            let restart = document.getElementById("restart");
            let userScore = document.getElementById("user-score");
            let startScreen = document.querySelector(".start-screen");
            let startButton = document.getElementById("start-button");
            let questionCount;
            let scoreCount = 0;

            let countdown;

            let type_q = "{{ $result[0]['type'] }}";

            let selectedoption;
            let questionid;

            // Initialize the reponses array with two empty objects
            let reponses = [];

            let reponses_temporaire = [];

            const quizArray = [];

            quizArray.push({
                id: "{{ $result[0]['id'] }}",
                question: "{{ $result[0]['question'] }}",
                type: "{{ $result[0]['type'] }}",
                options: @json($result[0]['options'])
            })
           
       
            // Next button
            nextBtn.addEventListener("click", (displayNext = (e) => {
                e.preventDefault();


                if (reponses.length === 0) {

                    reponses.splice(0, 1, {
                        qid: quizArray[0].id,
                        reponse: ["Pas de réponse"]
                    });
                }

                $.ajax({
                    type: "GET",
                    url: "{{ route('getdata') }}?id_exam={{ $result[0]['id_exam'] }}&id_question=" + reponses[0].qid +
                            "&data=" + reponses[0].reponse,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {

                        if (!response.hasOwnProperty('message')) {




                            quizArray.length = 0;
                            type_q = response[0].type;
                            quizArray.push(
                                {id: response[0].id, question: response[0].question, type: response[0].type, options: response[0].options}
                            )
                            reponses_temporaire.length = 0;
                            
                            
                            setTimeout(() => {
                                nextBtn.disabled = false;
                                localStorage.removeItem('count');
                                inital();
                            }, localStorage.getItem('count')*1001);

                        } else {

                            setTimeout(() => {
                          clearInterval(countdown);
                            wrapper
                                .classList
                                .add("hide");

                            var link = document.createElement('a');
                            link.href = "/countdown";
                            link.click();
                            }, localStorage.getItem('count')*1001);
                        
                        }
                        reponses.length = 0;

                    },

                    error: function (response) {}

                });

            }));
            // Timer
            let decrementt;
            const timerDisplay = () => {
                countdown = setInterval(() => {

                    count--;
                    decrementt = count - 1;
                    localStorage.setItem('count', decrementt);

                    timeLeft.innerHTML = `${count}s`;
                    if (localStorage.getItem('count') <= 0) {

                        clearInterval(countdown);

                        if (reponses.length === 0) {

reponses.splice(0, 1, {
    qid: quizArray[0].id,
    reponse: ["Pas de réponse"]
});
}
                        nextBtn.click();
                        localStorage.removeItem('count');

                    }
                }, 1000);
            };
            //display quiz
            const quizDisplay = (questionCount) => {
                let quizCards = document.querySelectorAll(".container_mid");
                //hide other cards
                quizCards.forEach((card) => {
                    card
                        .classList
                        .add("hide");
                });
                //display current question card
                quizCards[questionCount]
                    .classList
                    .remove("hide");
            };
            // Quiz creation
            function quizCreator() {
                //randomly sort questions
                quizArray.sort(() => Math.random() - 0.5);
                //generate quiz
                for (let i of quizArray) {
                    //randomly sort options
                    i
                        .options
                        .sort(() => Math.random() - 0.5);
                    //quiz card creation
                    let div = document.createElement("div");
                    div.setAttribute("id", 'Q' + 10);
                    div
                        .classList
                        .add("container_mid", "hide");
                    //question number
                    countOfQuestion.innerHTML = 1 + " sur  " + quizArray.length + " Questions";
                    //question
                    let question_DIV = document.createElement("img");
                    question_DIV
                        .classList
                        .add("question");
                        question_DIV.src="{{ asset('images/ExamQuestion') }}/"+ i.question;
                        question_DIV.style.width = "100%";
                        question_DIV.style.height = "auto";
                    div.appendChild(question_DIV);
                    //options

                    for (let j = 0; j < i.options.length; j++) {
                        div.innerHTML += `<button class="option-div" id="${j}" onclick="checker(this)">${i.options[j]}</button>`;
                    }

                    quizContainer.appendChild(div);
                }

                // Change the display style of the div element

                let myDiv = document.querySelector('#Q10');

// Get a reference to all the buttons inside the div
            let myButtons = myDiv.querySelectorAll('button');

            myButtons.forEach(function(button) {
  // Do something with the button, such as setting its text or disabling it
  button.disabled = false;
  button.style.opacity = '1';
  button.style.cursor = 'allowed';
});
        
                nextBtn.disabled = false;
                            nextBtn.style.opacity = '1';
// Change the hover effect of the button to a forbidden icon
nextBtn.addEventListener('mouseover', function() {
    nextBtn.style.cursor = 'allowed';

});
            }
            // Check option is correct or not

            function checker(userOption) {

                let question = document.getElementsByClassName("container_mid")[questionCount];

                if (type_q == 'multiple') {

                    let userSolution = userOption.innerText;
                    let options = question.querySelectorAll(".option-div");

                    if (userOption.classList.contains("inCorrect")) {
                        userOption
                            .classList
                            .remove("inCorrect");
                    } else {
                        userOption
                            .classList
                            .add("inCorrect");
                    }

                    if (!reponses_temporaire.includes(userSolution)) {

                        reponses_temporaire.push(userSolution);
                    } else {

                        const index = reponses_temporaire.indexOf(userSolution);
                        if (index !== -1) {
                            reponses_temporaire.splice(index, 1);
                        }

                    }

                    selectedoption = userSolution;
                    questionid = quizArray[questionCount].id;

                    reponses.splice(0, 1, {
                        qid: questionid,
                        reponse: reponses_temporaire
                    });

                } else if (type_q == 'mono') {

                    let userSolution = userOption.innerText;
                    let options = question.querySelectorAll(".option-div");
                    options.forEach((element) => {
                        element
                            .classList
                            .remove("inCorrect");

                    });

                    userOption
                        .classList
                        .add("inCorrect");

                    selectedoption = userSolution;
                    questionid = quizArray[questionCount].id;

                    reponses.splice(0, 1, {
                        qid: questionid,
                        reponse: selectedoption
                    });

                }

            }

            let count;

            //initial setup
            function inital() {

                clearInterval(countdown);
                quizContainer.innerHTML = "";
                questionCount = 0;
                scoreCount = 0;
                if (localStorage.getItem('count') != null) {
                    count = localStorage.getItem('count');

                } else {
                    count = 61;
                }

                
                timerDisplay();
                quizCreator();
                quizDisplay(questionCount);
            }
            // when user click on start button
            inital();
            //hide quiz and display start screen
        </script>
    </body>
</html>