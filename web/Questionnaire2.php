<?php

session_start();
require ('utils/database_api.php');
$user = $_SESSION['patient'];
// $user = $_SESSION['patient'];

if ($user == null) {
    header("location: 404.php");
    exit();
}

?>

<style>

*, *::before, *::after {
	box-sizing: border-box;
	-webkit-backface-visibility: hidden;
	-webkit-transform-style: preserve-3d;
}

html,
body {
	width: 100%;
}

body {
	flex-direction: column;
	min-height: 100vh;
	color: #fff;
	background: #00356B;
	background-image: repeating-linear-gradient(90deg, hsla(0, 0%, 100%, .1), hsla(0, 0%, 100%, .1) 20px, transparent 0, transparent 40px);
}

body,
header {
	display: flex;
	justify-content: space-between;
}

p {
	line-height: 1.5;
}

li {
	line-height: 2;
	list-style: none;
}

ul {
	padding-left: 0;
}

#header {
	font-family: 'Open Sans', sans-serif;
}

#header,
#content {
	margin: 0 auto;
	width: 1140px;
	max-width: 90%;
}

#header {
	margin-top: 1.5em;
}

#content,
#footer {
	font-family: 'Merriweather', serif;
	padding: 1.5em 3em;
	margin-top: 3em;
	background: rgba(21, 22 ,23, .6);
}

#content {
	border-radius: 5px;
}

#footer {
	text-align: center;
}
.site-title {
	margin: 0.2em;
	font-size: 3.5em;
}

.score {
	text-align: center;
}

#score-counter {
	font-size: 2.5em;
}

#score-counter,
.points {
	margin: 0;
}

#question-box {
	margin-bottom: 1.5em;
	font-size: 1.5em;
}

#answer-box {
	margin-bottom: 1.5em;
}

.answer span {
	cursor: pointer;
	margin-left: 1em;
	transition: 0.1s;
}

.answer {
	transition: all .25s ease-in-out;
}

.answer:hover {
	opacity: .8;
	transform: translate3d(1em, 0, 0);
}

.correct,
#num-correct {
	color: #00A550;
}

.wrong,
#num-wrong {
	color: #C40233;
}

#num-wrong,
#num-correct,
#num-total {
	text-decoration: underline;
}

.results {
	padding: 3em;
	width: 800px;
	max-width: 90%;
	border-radius: 5px;
	background: rgba(21, 22 ,23, 1);
}

.results-container {
	display: flex;
	justify-content: center;
	align-items: center;
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	transition: all .5s ease-in-out;
	transform: translateY(-100%);
	background: rgba(21, 22 ,23, 0.7);
}

.results-container.display {
	transform: translateY(0);
}




</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <title>Questionnaire</title>

    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>

<header id="header">
	<div class="logo">
		<svg id="circle" xmlns="http://www.w3.org/2000/svg" version="1.1" height="100" width="100">
			<circle cx="50" cy="50" r="50" fill="#c80815" />
			<text x="25" y="70" fill="#ffffff" style="font-size: 60px;">Q</text>

		</svg>
	</div>
	<div class="title">
		<h1 class="site-title">Quiz <span class="small">Master</span></h1>
	</div>
	<div class="score">
		<p id="score-counter"></p>
		<p class="points"></p>
	</div>
</header>

<div id="content">
	<div id="question-box"><p id="the-question"></p></div>
	<div id="answer-box">
		<ul>
			<li class="answer">A: <span id="first-answer"></span></li>
			<li class="answer">B: <span id="second-answer"></span></li>
			<li class="answer">C: <span id="third-answer"></span></li>
			<li class="answer">D: <span id="fourth-answer"></span></li>
		</ul>
	</div>
</div>

<div class="results-container">
	<div class="results">
		<h1>Congratulations!</h1>
		<div class="result-text"><p>You have finished the quiz. Please select your doctor</div>
	</div>
</div>

<footer id="footer">
	<p>.....</p>
</footer>






<script src="vendor/jquery/jquery.min.js"></script>

<!-- <script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script> -->



</body>

</html>

<script>

// Number of questions. Max=52.
const NUMQUESTIONS = 21;

// List of questions.
let questionsMap = new Map();

// The sequence of the quiz.
let quizSequence = [];

// Store the quiz stats.
let quizStats = {
	counter: 0,
	correct: 0,
	wrong: 0,
	currentQuestion: 0,
};	

// The questions.

function quizQuestions(question_array) {



for(var i = 0;i<question_array.length;i++){
	console.log(question_array[i]['question'])
	console.log(i)

	questionsMap.set(i, {
		question: question_array[i]["question"],
		a: question_array[i]['answer1'],
		b: question_array[i]['answer2'],
		c: question_array[i]['answer3'],
		d: question_array[i]['answer4'],
		answer: {
            "a":0,
            "b":1,
            "c":2,
            "d":3
        },
		qId:question_array[i]['questionId'],
	});

}


}


// Get the containers.
let questionContainer = document.getElementById("the-question"),
		answerA = document.getElementById("first-answer"),
		answerB = document.getElementById("second-answer"),
		answerC = document.getElementById("third-answer"),
		answerD = document.getElementById("fourth-answer"),
		scoreCounter = document.getElementById("score-counter");

// Add question keys to the quiz sequence array.
function determineSequence() {
	// Populate quizSequence.
	for (let [key, value] of questionsMap) {
		quizSequence.push(key);
	}
	
	// Shuffle an array.
	function shuffle(array) {
		let currentIndex = array.length,
				temporaryValue,
				randomIndex;

		// While there remain elements to shuffle...
		while (0 !== currentIndex) {

			// Pick a remaining element...
			randomIndex = Math.floor(Math.random() * currentIndex);
			currentIndex -= 1;

			// And swap it with the current element.
			temporaryValue = array[currentIndex];
			array[currentIndex] = array[randomIndex];
			array[randomIndex] = temporaryValue;
		}
		return array;
		// See: http://stackoverflow.com/a/2450976/4429450
	}
	
	// Randomize quizSequence.
	quizSequence = shuffle(quizSequence);
}

// Get the next question.
function getNextQuestion() {
	// Up the counter.
	quizStats.counter++;
	
	// Get the question number.
	let qn = quizSequence.shift();
	
	// Set up the question and answers.
	let a = questionsMap.get(qn).a,
			b = questionsMap.get(qn).b,
			c = questionsMap.get(qn).c,
			d = questionsMap.get(qn).d,
			question = questionsMap.get(qn).question;
	
	// Print the questions.
	questionContainer.textContent = "Question " + quizStats.counter;
	// questionContainer.textContent = question;
	answerA.textContent = a;
	answerB.textContent = b;
	answerC.textContent = c;
	answerD.textContent = d;
	
	// Track the current question.
	quizStats.currentQuestion = qn;
}

// Add event listeners.
function addEventListeners() {
	answerA.addEventListener("click", checkTheAnswer);
	answerB.addEventListener("click", checkTheAnswer);
	answerC.addEventListener("click", checkTheAnswer);
	answerD.addEventListener("click", checkTheAnswer);
}

// Add data attributes.
function addDataAttributes() {
	answerA.setAttribute("data-answer", ( "a" ));
	answerB.setAttribute("data-answer", ( "b" ));
	answerC.setAttribute("data-answer", ( "c" ));
	answerD.setAttribute("data-answer", ( "d" ));
}

// Check the answer.
totalScore = 0;
var answer_to_db = {}
function checkTheAnswer() {
	// Get the answers.
	let givenAnswer = this.dataset.answer,
	correctAnswer = questionsMap.get(quizStats.currentQuestion).answer;

		questionId = questionsMap.get(quizStats.currentQuestion).qId,
        score = correctAnswer[givenAnswer]
        totalScore += score
        scoreCounter.textContent = quizStats.correct;
        this.classList.add("correct");

		answer_to_db[questionId] = {"answer":givenAnswer}


    //     setTimeout(clearClasses, 1000);
	// 	setTimeout(getNextQuestion, 1000);

	// // Check given and correct answers.
	// if (givenAnswer !== correctAnswer) {
	// 	quizStats.correct++;
	// 	this.classList.add("correct");
	// }
	// else {
	// 	quizStats.wrong++;
	// 	this.classList.add("wrong");
	// }
	
	// // // Update the counter.
	// scoreCounter.textContent = quizStats.correct;
	
	// Check if max num of questions has been reached.
	if ( quizStats.counter < NUMQUESTIONS) {
		setTimeout(clearClasses, 2000);
		setTimeout(getNextQuestion, 2000);
	}
	// If so, stop the quiz.
	else {

        console.log(totalScore)
		showTheResults();
	}
}

// Clear classes.
function clearClasses() {
	answerA.classList.remove("correct", "wrong");
	answerB.classList.remove("correct", "wrong");
	answerC.classList.remove("correct", "wrong");
	answerD.classList.remove("correct", "wrong");
}

// The results.
function showTheResults() {
	// Get the containers.
	let numCorrect = document.getElementById("num-correct"),
			numWrong = document.getElementById("num-wrong"),
			numTotal = document.getElementById("num-total");
	
	// Get the results.
	let correct = quizStats.correct,
			wrong = quizStats.wrong,
			total = NUMQUESTIONS;
	
	// Print the results.
	// numCorrect.textContent = correct;
	// numWrong.textContent = wrong;
	// numTotal.textContent = total;
	var userData = JSON.parse(localStorage.getItem('testObject'));
	localStorage.setItem('totalMarks',totalScore)
	patientId = userData['patientId']
	 date = new Date();
	 date = date.toUTCString();
	 data_to_db = {}
	 data_to_db["answers"] = answer_to_db
	 data_to_db["date"] = date
	 data_to_db["patient"] = patientId
	 
	
			$.ajax({
                    type: "POST",
                    url: 'utils/questions_api.php',
                    data: {
                        "questionMarkstoDb" : "1",
                        "patientId" : patientId,
						"score" : totalScore,
						"date" : date,
						"questionData" : data_to_db
                    },
                    success: function(res){
                        if(res === true){
							location.href = "Patient.php";
						}
    
                    }
                });



	
	// Display the results.
	document.getElementsByClassName("results-container")[0].classList.add("display");
}

// //Let's start!
// (function startQuiz() {
// 	// Init.

// })();

$( document ).ready(function() {

get_questionnaire();



	
});


function get_questionnaire(){

	$.ajax({
                    type: "POST",
                    url: 'utils/questions_api.php',
                    data: {
                        "get_questions" : "1",
                    },
                    success: function(res){
						console.log(res)
						quizQuestions(res);
						determineSequence();
						getNextQuestion();
						addEventListeners();
						addDataAttributes();
                       
                    }
                });

}


</script>
