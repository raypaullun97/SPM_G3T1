<?php 
    class User{
        private $username;
        private $hashedPassword;
        private $email;
        private $user_type;
        
        public function __construct($username,$hashed_password, $email, $user_type,$first_name, $last_name, $picture, $description_user, $linkedin, $github, $personal_website, $status_freelancer){
            $this->username = $username;
            $this->hashedPassword = $hashed_password;
            $this->email = $email;
            $this->user_type = $user_type;
            $this->status_freelancer = $status_freelancer;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->picture = $picture;
            $this->description_user = $description_user;
            $this->linkedin = $linkedin;
            $this->github = $github;
            $this->personal_website = $personal_website;

        }
        public function getUsername(){
            return $this->username;
        }
        public function getHashedPassword(){
            return $this->hashedPassword;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getUserType(){
            return $this->user_type;
        }
        public function getStatus_freelancer(){
            return $this->status_freelancer;
        }
        public function getFirst_name(){
            return $this->first_name;
        }
        public function getLast_name(){
            return $this->last_name;
        }
        public function getPicture(){
            return $this->picture;
        }
        public function getDescription_user(){
            return $this->description_user;
        }
        public function getLinkedin(){
            return $this->linkedin;
        }
        public function getGithub(){
            return $this->github;
        }
        public function getPersonal_website(){
            return $this->personal_website;
        }
        
    }
?>