<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    /* $conn = require '../config/connection.php'; */
    $conn = require 'C:/xampp/htdocs/article_FAQs/server/config/connection.php';
    require '../../models/question.php';
    require '../../models/questionSkeleton.php';

    $searchedQuestion = $_GET['searchedQuestion'];

    $result = Question::getQuestion($conn, $searchedQuestion);
    //$questionSkeleton = QuestionSkeleton::creatQuestionSkeleton($question, $answer);

    echo json_encode($result);
?>