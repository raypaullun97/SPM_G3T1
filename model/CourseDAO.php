<?php
    class UserDAO{

        # Add a new user to the database
        public function add($email, $username, $hashed_password,$user_type){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "insert into user (username, hashed_password, email, user_type) 
                    values (:username, :hashed_password, :email, :user_type)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":hashed_password",$hashed_password);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":user_type",$user_type);
            $status = $stmt->execute();
            

            $stmt = null;
            $pdo = null;
            return $status;
        }

        # Retrieve a user with a given username
        # Return null if no such user exists
        public function retrieveUsername($username){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from user where username=:username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username",$username,PDO::PARAM_STR);
            $stmt->execute();
            
            $user = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($row = $stmt->fetch()){
                $user = new User($row["username"],$row["hashed_password"],$row["email"], $row["user_type"],$row["first_name"],$row["last_name"], $row["picture"],$row["description_user"],$row["linkedin"], $row["github"],$row["personal_website"], $row["status_freelancer"] );
            }
            
            $stmt = null;
            $pdo = null;
            return $user;
        }
        public function retrieveAllDetails($username){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from user where username=:username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username",$username,PDO::PARAM_STR);
            $stmt->execute();
            
            $user = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($row = $stmt->fetch()){
                $user = new User($row["username"],$row["hashed_password"],$row["email"], $row["user_type"],$row["first_name"],$row["last_name"], $row["picture"],$row["description_user"],$row["linkedin"], $row["github"],$row["personal_website"], $row["status_freelancer"] );
            }
            
            $stmt = null;
            $pdo = null;
            return $user;
        }
        public function retrieveEmail($email){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from user where email=:email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":email",$email,PDO::PARAM_STR);
            $stmt->execute();
            
            $user = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($row = $stmt->fetch()){
                $user = new User($row["username"],$row["hashed_password"],$row["email"], $row["user_type"],$row["first_name"],$row["last_name"], $row["picture"],$row["description_user"],$row["linkedin"], $row["github"],$row["personal_website"], $row["status_freelancer"] );
            }
            
            $stmt = null;
            $pdo = null;
            return $user;
        }
        
        public function retrieveAllClient($client) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from user where user_type=:client";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":client",$client,PDO::PARAM_STR);
            $stmt->execute();
            
            $list_of_client = [];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $stmt->fetch()){
                array_push($list_of_client, $row['username']);
                // $user = new User($row["username"],$row["hashed_password"],$row["email"] );
            }
            
            $stmt = null;
            $pdo = null;
            return $list_of_client;
        }
        public function updateFreelancerDetails($first_name, $last_name, $description_user, $linkedin, $github, $personal_website, $status_freelancer, $picture, $username) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "UPDATE user SET first_name=:first_name, last_name=:last_name, description_user=:description_user, linkedin=:linkedin, github=:github, personal_website=:personal_website, status_freelancer=:status_freelancer, picture=:picture WHERE username=:username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":first_name",$first_name,PDO::PARAM_STR);
            $stmt->bindParam(":last_name",$last_name,PDO::PARAM_STR);
            $stmt->bindParam(":description_user",$description_user,PDO::PARAM_STR);
            $stmt->bindParam(":linkedin",$linkedin,PDO::PARAM_STR);
            $stmt->bindParam(":github",$github,PDO::PARAM_STR);
            $stmt->bindParam(":personal_website",$personal_website,PDO::PARAM_STR);
            $stmt->bindParam(":status_freelancer",$status_freelancer,PDO::PARAM_STR);
            $stmt->bindParam(":picture",$picture,PDO::PARAM_STR);
            $stmt->bindParam(":username",$username,PDO::PARAM_STR);
            $is_update_ok = $stmt->execute();
            
            $stmt = null;
            $pdo = null;
            return $is_update_ok;
        }
    }
?>