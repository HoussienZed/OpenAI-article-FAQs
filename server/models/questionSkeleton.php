<?php 

    class QuestionSkeleton {
        public $question;
        public $answer;

        public function __construct($question, $answer) {
            $this->question = $question;
            $this->answer = $answer;
        }

        public static function creatQuestionSkeleton($question, $answer) {
            return new self ($question, $answer); //object returned
        }
    }

?>