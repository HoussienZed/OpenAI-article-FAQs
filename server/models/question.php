<?php 

    require '../config/connection/php';
    class Question {
        
        public static function createQuestion ($conn, $question, $answer) {
            
            if(!isset($question) || !isset($answer)) {
                return ['status'=>'error', 'message'=>'All fields are required'];
            }

            $addQuestionQuery = $conn->prepare('INSERT INTO questions (question, answer) VALUE (?, ?)');
            $addQuestionQuery->bind_param('ss', $question, $answer);

            if($addQuestionQuery->execute()) {
                return ['status'=>'success', 'message'=>'question and answer added successfully'];
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
    }

?>