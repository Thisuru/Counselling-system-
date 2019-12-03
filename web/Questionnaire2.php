<?php

session_start();
require ('utils/database_api.php');
$user = $_SESSION['Patient'];
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

    <title>User Registration</title>

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
		<p id="score-counter">0</p>
		<p class="points">Points</p>
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
		<div class="result-text"><p>You've finished the quiz and the results are outstanding! Out of a total of <span id="num-total">0</span> questions, you've managed to answer <span id="num-correct">0</span> questions correctly, and you've only answered <span id="num-wrong">0</span> questions wrong!</div>
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
const NUMQUESTIONS = 2;

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
            "a":1,
            "b":2,
            "c":3,
            "d":4
        },
		qId:question_array[i]['questionId'],
	});

}

	// questionsMap.set(70, {
	// 	question: "Which Spanish Island is known as 'The Island of Eternal Spring'?",
	// 	a: "Tenerife.",
	// 	b: "Majorca.",
	// 	c: "Gran Canaria.",
	// 	d: "La Gomera.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(71, {
	// 	question: "What is the largest planet in our solar system?",
	// 	a: "Mercury.",
	// 	b: "Neptune.",
	// 	c: "Saturn.",
	// 	d: "Jupiter.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(3, {
	// 	question: "What was the name of the first manmade satellite that was launched into space in 1957?",
	// 	a: "Apollo.",
	// 	b: "Sputnik.",
	// 	c: "Enterprise.",
	// 	d: "Soyuz.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(4, {
	// 	question: "What is the name of the world's highest uninterrupted waterfall and in what country is it located?",
	// 	a: "Angel Falls, Venezuela.",
	// 	b: "Tugula Falls, South Africa.",
	// 	c: "Niagara Falls, Canada and United Stats.",
	// 	d: "Vinnufossen, Norway.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(5, {
	// 	question: "What is the chemical symbol for iron?",
	// 	a: "Ir.",
	// 	b: "Fe.",
	// 	c: "On.",
	// 	d: "IJzer.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(6, {
	// 	question: "Who wrote the novel 'To Kill a Mockingbird', published in 1960?",
	// 	a: "Bruce Lee.",
	// 	b: "Harper Lee.",
	// 	c: "Lee Towers.",
	// 	d: "Tommy Lee.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(7, {
	// 	question: "What painter is famous for cutting off part of his ear?",
	// 	a: "Rembrandt Van Rijn.",
	// 	b: "Piet Mondriaan.",
	// 	c: "Vincent Van Gogh.",
	// 	d: "Johannes Vermeer.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(8, {
	// 	question: "The Communist Manifesto was written by which two German philosophers?",
	// 	a: "Martin Heidegger and Friedrich Nietzsche.",
	// 	b: "Adolf Hitler and Herman Goring.",
	// 	c: "Ludwig Feuerbach and Albert Schweitzer.",
	// 	d: "Karl Marx and Friedrich Engels.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(9, {
	// 	question: "Who directed the 1977 movie Star Wars?",
	// 	a: "George Lucas.",
	// 	b: "Luke Skywalker.",
	// 	c: "Stephen Spielberg.",
	// 	d: "Martin Scorsese.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(10, {
	// 	question: "What was the name of the passenger train service created in 1883 that connected Paris and Constantinople?",
	// 	a: "The Constantinople Express.",
	// 	b: "The Orient Express.",
	// 	c: "The Trans-Siberian Express.",
	// 	d: "The Trans-Europe Express.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(11, {
	// 	question: "How many stripes are on the flag of the United States?",
	// 	a: "50 Stripes.",
	// 	b: "17 Stripes.",
	// 	c: "13 Stripes.",
	// 	d: "20 Stripes.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(12, {
	// 	question: "Lemurs, a type of primate, are native to what island nation?",
	// 	a: "Indonesia.",
	// 	b: "Sri Lanka.",
	// 	c: "Phillipines..",
	// 	d: "Madagascar.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(13, {
	// 	question: "The largest volcano ever discovered in our solar system is located on which planet?",
	// 	a: "Jupiter.",
	// 	b: "Earth.",
	// 	c: "Venus.",
	// 	d: "Mars.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(14, {
	// 	question: "What is name of the world’s largest and most powerful particle accelerator?",
	// 	a: "Large Hadron Collider.",
	// 	b: "Relativistic Heavy Ion Collider.",
	// 	c: "Antiproton Decelerator.",
	// 	d: "Super Proton Synchrotron.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(15, {
	// 	question: "Joseph Smith was the founder of what religion?",
	// 	a: "Scientology.",
	// 	b: "Jehova's Witnesses.",
	// 	c: "Latter Day Saints.",
	// 	d: "Josephism.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(16, {
	// 	question: "What character is murdered by George in the John Steinbeck novella 'Of Mice and Men'?",
	// 	a: "His brother: Lennie.",
	// 	b: "His mother: Annie.",
	// 	c: "His friend: Bennie.",
	// 	d: "His wife: Jennie.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(17, {
	// 	question: "Which 1979 film included a spaceship called Nostromo?",
	// 	a: "Star Trek.",
	// 	b: "Alien.",
	// 	c: "Star Wars.",
	// 	d: "The Black Hole.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(18, {
	// 	question: "One kilobyte is equal to how many bytes?",
	// 	a: "1000 bytes.",
	// 	b: "1048 bytes.",
	// 	c: "1001 bytes.",
	// 	d: "1024 bytes.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(19, {
	// 	question: "Who is credited to be the first person to circumnavigate the globe?",
	// 	a: "Christopher Columbus.",
	// 	b: "Abel Tasman.",
	// 	c: "Ferdinand Magellan.",
	// 	d: "Vasco da Gama.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(20, {
	// 	question: "How many fingers do the Simpsons cartoon characters have?",
	// 	a: "Five.",
	// 	b: "Three.",
	// 	c: "Four.",
	// 	d: "Seven.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(21, {
	// 	question: "What is the only sea on Earth with no coastline?",
	// 	a: "The Sargasso Sea.",
	// 	b: "The North Sea.",
	// 	c: "The Scotia Sea.",
	// 	d: "The Black Sea.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(22, {
	// 	question: "What city connects two continents?",
	// 	a: "Montreal.",
	// 	b: "Brussels.",
	// 	c: "Istanbul.",
	// 	d: "Damascus.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(23, {
	// 	question: "In what year did Cuba formally gain it's independence from Spain?",
	// 	a: "1779.",
	// 	b: "1902.",
	// 	c: "1812.",
	// 	d: "1492.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(24, {
	// 	question: "In what month is the Earth closest to the sun?",
	// 	a: "June.",
	// 	b: "Januari.",
	// 	c: "March.",
	// 	d: "September.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(25, {
	// 	question: "Which country and it's territories cover the most time zones?",
	// 	a: "Russia.",
	// 	b: "England.",
	// 	c: "United States.",
	// 	d: "France.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(26, {
	// 	question: "How many people have walked on the moon?",
	// 	a: "12.",
	// 	b: "17.",
	// 	c: "5.",
	// 	d: "32155.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(27, {
	// 	question: "Marie Curie was the first person to win two of what award?",
	// 	a: "The Oscars.",
	// 	b: "The Nobel Prize.",
	// 	c: "Olympic Golden Medals.",
	// 	d: "The Golden Globe Awards.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(28, {
	// 	question: "Who is the author of The Hobbit and the Lord of the Rings trilogy?",
	// 	a: "George R.R. Martin.",
	// 	b: "Ernest Hemmingway.",
	// 	c: "J.R.R. Tolkien.",
	// 	d: "Lewis Carroll.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(29, {
	// 	question: "How old must a person be to run for President of the United States?",
	// 	a: "18.",
	// 	b: "23.",
	// 	c: "35.",
	// 	d: "42.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(30, {
	// 	question: "In 1893, which country became the first to give women the right to vote?",
	// 	a: "The Netherlands.",
	// 	b: "Denmark.",
	// 	c: "Canada.",
	// 	d: "New Zealand.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(31, {
	// 	question: "New York City was originally known by which Dutch name?",
	// 	a: "Nieuw Rotterdam.",
	// 	b: "Haarlem.",
	// 	c: "Breukelen.",
	// 	d: "Nieuw Amsterdam.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(32, {
	// 	question: "Sulayman Reis was a notorious Ottoman pirate, but what was his real name?",
	// 	a: "Sinan Pasha.",
	// 	b: "Edward Teach.",
	// 	c: "Thomas Cavendish.",
	// 	d: "Ivan Dirkie De Veenboer.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(33, {
	// 	question: "What does the Japanese phrase, 'domo arigato' mean in English?",
	// 	a: "Thank you very much.",
	// 	b: "Have a nice day.",
	// 	c: "Goodbye.",
	// 	d: "Nice to meet you.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(34, {
	// 	question: "What vitamin is produced when a person is exposed to sunlight?",
	// 	a: "Vitamin A.",
	// 	b: "Vitamin B.",
	// 	c: "Vitamin C.",
	// 	d: "Vitamin D.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(35, {
	// 	question: "The European Organization for Nuclear Research is known by what four letter acronym?",
	// 	a: "KNMI.",
	// 	b: "CERN.",
	// 	c: "NASA.",
	// 	d: "EONR.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(36, {
	// 	question: "What layer of the atmosphere lies between the troposphere and mesosphere?",
	// 	a: "Heliosphere.",
	// 	b: "Thermosphere.",
	// 	c: "Stratosphere.",
	// 	d: "Innersphere.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(37, {
	// 	question: "What is the capital of North Korea?",
	// 	a: "Seoul.",
	// 	b: "Pyonyang.",
	// 	c: "Taipei.",
	// 	d: "Jakarta.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(38, {
	// 	question: "Yerevan, one of the world's oldest continuously inhabited cities, is the capital of what country?",
	// 	a: "The Islamic Republic of Iran.",
	// 	b: "The Republic of Armenia.",
	// 	c: "The Republic of Macedonia.",
	// 	d: "The Republic of Azerbaijan.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(39, {
	// 	question: "What is the capital city of Australia?",
	// 	a: "Adelaide.",
	// 	b: "Sydney.",
	// 	c: "Canberra.",
	// 	d: "Melbourne.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(40, {
	// 	question: "In what country would you find Mount Kilimanjaro?",
	// 	a: "Kenia.",
	// 	b: "Angola.",
	// 	c: "Tanzania.",
	// 	d: "Zimbabwe.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(41, {
	// 	question: "The Southern Ocean surrounds which continent?",
	// 	a: "Australia.",
	// 	b: "South-America.",
	// 	c: "Europe.",
	// 	d: "Antarctica.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(42, {
	// 	question: "The US military installation Area 51 is located in which state?",
	// 	a: "California.",
	// 	b: "New Mexico.",
	// 	c: "Nevada.",
	// 	d: "Colorado.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(43, {
	// 	question: "What language do they speak in Brazil?",
	// 	a: "Spanish.",
	// 	b: "Portuguese.",
	// 	c: "English.",
	// 	d: "They don't speak any language.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(44, {
	// 	question: "Which city has the largest population in the world?",
	// 	a: "New York, United States.",
	// 	b: "Beijing, China.",
	// 	c: "Mexico City, Mexico.",
	// 	d: "Tokyo, Japan.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(45, {
	// 	question: "Valletta is the capital of what Mediterranean country?",
	// 	a: "Malta.",
	// 	b: "Italy.",
	// 	c: "France.",
	// 	d: "Albania.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(46, {
	// 	question: "According to physics, what are the four fundamental forces in nature?",
	// 	a: "Strong Force, Electromagnetic Force, Weak Force, Gravitational Force.",
	// 	b: "Space, time, Gravity, Electricity.",
	// 	c: "Nuclear Force, Gravitational Force, Electromagnatic Force, Thermodynamical Force.",
	// 	d: "Light Side of the Force, Dark Side of the Force, Force Push, Force Lightning.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(47, {
	// 	question: "Schrödinger's cat is a thought experiment dealing with which type of mechanics?",
	// 	a: "Quantum Mechanics.",
	// 	b: "Elektro Mechanics.",
	// 	c: "Spacetime Mechanics.",
	// 	d: "Animal Welfare Mechanics.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(48, {
	// 	question: "Who is the author of the book 'A Brief History of Time'?",
	// 	a: "Stephen King.",
	// 	b: "Stephen Hawking.",
	// 	c: "King Stephen I.",
	// 	d: "Albert Einstein.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(49, {
	// 	question: "In what year was the first Apple computer released?",
	// 	a: "1981.",
	// 	b: "1972.",
	// 	c: "1976.",
	// 	d: "1989.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(50, {
	// 	question: "The companies HP, Microsoft and Apple were all started in a what?",
	// 	a: "Bedroom.",
	// 	b: "Garage.",
	// 	c: "Attic.",
	// 	d: "Bathroom.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(51, {
	// 	question: "What is the address of Sherlock Holmes?",
	// 	a: "10 Downing Street.",
	// 	b: "46A Harley Street.",
	// 	c: "1600 Pennsylvania Avenue.",
	// 	d: "221B Baker Street.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
	// questionsMap.set(52, {
	// 	question: "What falling object is said to have inspired Isaac Newton's theories about gravity?",
	// 	a: "Pineapple.",
	// 	b: "Coconut.",
	// 	c: "Pear.",
	// 	d: "Apple.",
	// 	answer: {
    //         "a":1,
    //         "b":2,
    //         "c":3,
    //         "d":4
    //     },
	// });
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
	questionContainer.textContent = question;
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
	numCorrect.textContent = correct;
	numWrong.textContent = wrong;
	numTotal.textContent = total;
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
						quizQuestions(res);
						determineSequence();
						getNextQuestion();
						addEventListeners();
						addDataAttributes();
                       
                    }
                });

}


</script>
