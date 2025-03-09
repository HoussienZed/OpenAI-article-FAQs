<?php 

    /*  $conn = require '../config/connection.php'; */
    $conn = require 'C:/xampp/htdocs/article_FAQs/server/config/connection.php';
    class Question {
        
        public static function createQuestion ($conn, $question, $answer) {
            
            if(!isset($question) || !isset($answer)) {
                return ['status'=>'error', 'message'=>'All fields are required'];
            }

            $addQuestionQuery = $conn->prepare('INSERT INTO questions (question, answer) VALUE (?, ?)');
            $addQuestionQuery->bind_param('ss', $question, $answer);

            if($addQuestionQuery->execute()) {
                return ['status'=>'success', 'message'=>'question and answer added successfully'];
            } else {
                return ['status'=>'error', 'message'=>'Question was not added'];
            }
        }

        public static function deleteQuestion($conn, $question) {

            $deleteQuestionQuery = $conn->prepare('DELETE FROM questions WHERE question = ?');
            $deleteQuestionQuery->bind_param('s', $question);

            if($deleteQuestionQuery->execute()) {
                return ['status'=>'success', 'message'=>'Question deleted successfully'];
            } else {
                return['status'=>'error', 'message'=>'Question cannot be deleted'];
            }
        }

        public static function getQuestion($conn, $searchedQuestion) {

            $getQuestionQuery = $conn->prepare('SELECT * FROM questions WHERE question LIKE ?');
            $searchedPhrase = '%' . $searchedQuestion . '%';
            $getQuestionQuery->bind_param('s', $searchedPhrase);
            $getQuestionQuery->execute();

            $result = $getQuestionQuery->get_result();

            $response = [];

            if($result->num_rows > 0) {
                while($question = $result->fetch_assoc()) {
                    $response = [$question];
                }
                return $response;
            } else {
                return ['result'=>'No related question found'];
            }
        }
    }

?>