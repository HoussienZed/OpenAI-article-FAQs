<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    /* $conn = require '../config/connection.php'; */
    $conn = require 'C:/xampp/htdocs/article_FAQs/server/config/connection.php';
    require '../../models/question.php';
    require '../../models/questionSkeleton.php';
    require '../../database/migrations/createQuestionsTable.php';
    require '../../database/seeds/seed.php';

    $question = $_POST['question'];
    $answer = $_POST['answer'];

    $questionsTable = QuestionsTable::createQuestionsTable($conn);
    $questionSkeleton = QuestionSkeleton::creatQuestionSkeleton($question, $answer);

    $addedQuestion = Question::createQuestion($conn, $question, $answer);

    if ($addedQuestion['status'] === 'success') {    
        $response = Insert::insertQuestion($conn, $question, $answer);
    } else {
        return $addedQuestion['message'];
    }

    echo json_encode($response);

?>