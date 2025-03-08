<?php

    class UserSkeleton {
        public $fullName;
        public $email;
        public $password;

        public function __contruct($fullName, $email, $password) {
            $this->fullName = $fullName;
            $this->email = $email;
            $this->password = $password;
        }

        public static function createSkeleton($fullName, $email, $password) {
            return new self($fullName, $email, $password);
        }
    }

?>