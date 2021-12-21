<?php

class DBService {
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $conn ;

    /**
     * this function connects to the database automatically and looks whether the Database db_pain exists
     * if not then it creates the whole table structure automatically
    */
    function __construct() {
        $this->conn = new mysqli($this->host,$this->username,$this->password);
        $res = $this->conn->multi_query("USE db_pain;");
        if (!$res) {
            $res = $this->conn->multi_query("
                CREATE DATABASE db_pain;
                
                USE db_pain;
                
                create table institution(institution_id int,name varchar(1000) not null);
                create table invites(ID int,Group_ID int, User_ID int);
                create unique index institution_institution_id_uindex on institution (institution_id);
                alter table institution	add constraint institution_pk primary key (institution_id);
                alter table institution modify institution_id int auto_increment;
                       
                create table course
                    (
                        course_id int,
                        institution int null,
                        name varchar(500) null,
                        constraint course_institution
                            foreign key (institution) references institution (institution_id)
                                on update cascade on delete cascade
                    );
                create unique index course_course_id_uindex
                    on course (course_id);
                alter table course
                    add constraint course_pk
                        primary key (course_id);
                alter table course modify course_id int auto_increment;
                
                create table role
                (
                    role_id int,
                    read_simple_enable boolean default false null,
                    name varchar(400) not null
                );
                create unique index role_role_id_index
                    on role(role_id);
                alter table role
                    add constraint role_pk
                        primary key (role_id);
                alter table role modify role_id int auto_increment;
                
                create table user
                (
                    user_id int,
                    password varchar(60) not null,
                    email varchar(500) null,
                    login varchar(500) null,
                    name varchar(500) null,
                    surename varchar(500) null
                );
                create unique index user_user_id_uindex
                    on user (user_id);
                alter table user
                    add constraint user_pk
                        primary key (user_id);
                alter table user modify user_id int auto_increment;

                create table project
                (
                    project_id int,
                    points_reachable int not null,
                    path_to_matrix varchar(1000) null,
                    submission_date DATETIME not null,
                    open_to_invite boolean default false null,
                    max_of_students int not null,
                    name varchar(1000) null
                );
                create unique index project_project_id_uindex
                    on project (project_id);
                alter table project
                    add constraint project_pk
                        primary key (project_id);
                alter table project modify project_id int auto_increment;

                create table groupings
                (
                    group_id int,
                    name varchar(5000) null,
                    submitted boolean default false null,
                    submitted_time DATETIME null,
                    project_id int null,
                    constraint group__project
                        foreign key (project_id) references project (project_id)
                            on update cascade on delete set null
                ); 
                create unique index groupings_group_id_uindex
                    on groupings (group_id);
                alter table groupings
                    add constraint groupings_pk
                        primary key (group_id);
                alter table groupings modify group_id int auto_increment;

                create table rating
                (
                    rating_id int,
                    user_id int null,
                    group_id int null,
                    points float null,
                    is_admin boolean default false null,
                    constraint rating___groupings
                        foreign key (group_id) references groupings (group_id),
                    constraint rating___user
                        foreign key (user_id) references user (user_id)
                );
                create unique index rating_rating_id_uindex
                    on rating (rating_id);
                alter table rating
                    add constraint rating_pk
                        primary key (rating_id);
                alter table rating modify rating_id int auto_increment;

                create table project_class
                (
                    id int,
                    project_id int null,
                    course_id int null,
                    constraint project_class___course
                        foreign key (course_id) references course (course_id),
                    constraint project_class___project
                        foreign key (project_id) references project (project_id)
                );
                create unique index project_class_id_uindex
                    on project_class (id);
                alter table project_class
                    add constraint project_class_pk
                        primary key (id);
                alter table project_class modify id int auto_increment;
                
                create table user_role
                (
                    user_role_id int,
                    role_id int null,
                    user_id int null,
                    constraint role_role_id___fk
                        foreign key (role_id) references role (role_id),
                    constraint user_user_id___fk
                        foreign key (user_id) references user (user_id)
                );
                create unique index user_role_user_role_id_uindex
                    on user_role (user_role_id);              
                alter table user_role
                    add constraint user_role_pk
                        primary key (user_role_id);  
                alter table user_role modify user_role_id int auto_increment;
                
                create table user_mapping
                (
                    mapping_id int,
                    user_id int null,
                    course_id int null,
                    institution_id int null,
                    constraint maping_user
                        foreign key (user_id) references user (user_id)
                            on delete cascade,
                    constraint mapping_course
                        foreign key (course_id) references course (course_id)
                            on update cascade on delete cascade,
                    constraint mapping_institution
                        foreign key (institution_id) references institution (institution_id)
                            on delete cascade
                );
                create unique index user_mapping_mapping_id_uindex
                    on user_mapping (mapping_id);
                
                alter table user_mapping
                    add constraint user_mapping_pk
                        primary key (mapping_id);
                
                alter table user_mapping modify mapping_id int auto_increment;
                
                create unique index user_login_uindex
                	on user (login);
                
                INSERT INTO role (name) VALUES ('admin');
                INSERT INTO role (name) VALUES ('student');
                INSERT INTO role (name) VALUES ('secretary');
                INSERT INTO user (password, email, name, surename, login) VALUES ('$2y$10\$uWcx72oOw4hWi4iAUgvsNukA6U2TAdt21L3IwVu/CKtyIJ9Wbv/fS' ,'daniel@wierbicki.org', null,null,'admin');
                INSERT INTO user_role (role_id, user_id) VALUES (1, 1);
                INSERT INTO db_pain.institution (name) VALUES ('DHBW Mosbach');
                INSERT INTO db_pain.course (institution, name) VALUES (1, 'INF20B');
                INSERT INTO db_pain.user (password, email, login, name, surename) VALUES ('$2y$10\$PD/tR.8orNEKkLcyEYooFOO44HDgd9K1l2/d8z3Dn8b.tGRbNcpYu', null, 'user', null, null);
                INSERT INTO user_role (role_id, user_id) VALUES (2, 2);
                INSERT INTO db_pain.user (password, email, login, name, surename) VALUES ('$2y$10\$eob34iDut5D6M2XvvaiYbuWGx0VBwl0PWdMsXJj26x38jnIGigDFm', null, 'secretary', null, null);
                INSERT INTO user_role (role_id, user_id) VALUES (3, 3);
                INSERT INTO db_pain.user_mapping (user_id, course_id, institution_id) VALUES (2, 1, 1);
                INSERT INTO db_pain.user_mapping (user_id, course_id, institution_id) VALUES (3, null, 1);
            ");
        }
    }

    public function getUserSession() {
        $result =$this->conn->query("
            SELECT user_id,password
            FROM user");
        $users = mysqli_fetch_all($result);
        $session = [];
        foreach ($users as $user) {
            array_push($session,$user[0].$user[1]);
        }

        return $session;
    }
    public function getRole($user_id) {
        $role = $this->conn->query("SELECT role_id FROM user_role
        WHERE user_id=".$user_id);
        return mysqli_fetch_all($role);
    }
    /**
     * this function gets login and clear password
     * It gets the login from the user and the user id
     * it verifies whether  it is the same login and if not it returns false
     * else it sets the cookie so the user is logged in and it treturns true
    */
    public function verifyLogin($login,$password) {
        $login = str_replace([";"," "],"",$login);
        $query = $this->conn->query("
            SELECT password,user_id FROM user
            WHERE login ='".$login."'
        ");
        $result = mysqli_fetch_all($query);
        if (count($result)!=1) {
            return false;
        }

        if (password_verify($password,$result[0][0])) {
            if (!isset($_COOKIE["GradlappainCook"])) {
                setcookie("GradlappainCook" ,$result[0][1].$result[0][0]);
            } else {
                $_COOKIE["GradlappainCook"]=$result[0][1].$result[0][0];
            }
            return true;
        }
        return false;
    }
    /**
     * admin table for the home.php adm,in table
    */
    public function getAdminHomeTable() {
        $query = $this->conn->query("
            SELECT proj.project_id,proj.name,proj.path_to_matrix as path,
                (SELECT COUNT(*)
                FROM groupings grup
                WHERE grup.project_id=proj.project_id)
            as count, 
                (SELECT COUNT(*)
                FROM groupings grup
                WHERE grup.project_id=proj.project_id AND grup.submitted=true)
            as completed,
            submission_date as date
            FROM project as proj
            WHERE submission_date>=CURRENT_DATE()-1;
        ");
        $result = mysqli_fetch_all($query);
        for($i=0;$i<count($result);$i++) {
            $date = $result[$i][5];
            $datetime = new DateTime($date);
            $result[$i][5] = date_format($datetime,"d.m.Y H:i")." Uhr";
        }
        return $result;
    }

    /**
     * user home table is set
    */
    public function getUserHomeTable($userId) {
        $query = $this->conn->query("
            SELECT groop.group_id, groop.name,p.submission_date,p.name FROM groupings as groop
            INNER JOIN rating rat on groop.group_id = rat.group_id
            INNER JOIN user u on rat.user_id = u.user_id
            INNER JOIN project p on groop.project_id = p.project_id
            WHERE u.user_id =".$userId);
        $result = mysqli_fetch_all($query);
        for($i=0;$i<count($result);$i++) {
            $date = $result[$i][2];
            try {
                $datetime = new DateTime($date);
                $result[$i][2] = date_format($datetime,"d.m.Y H:i")." Uhr";
            } catch (Exception $e) {
                $result[$i][2] =$date;
            }
        }
        return $result;
    }

    /**
     * gets the Data for the secretary table in home.php
    */
    public function getSecretareHomeTable($secretaryId) {
        $query = $this->conn->query("
            SELECT u.surename,u.name,c.name,rating.points,p.submission_date,p.points_reachable
            FROM rating
            INNER JOIN groupings g on rating.group_id = g.group_id
            RIGHT JOIN project p on p.project_id = g.project_id
            INNER JOIN user u on rating.user_id = u.user_id
            LEFT JOIN project_class pc on p.project_id = pc.project_id
            LEFT JOIN course c on pc.course_id = c.course_id
            INNER JOIN institution i on c.institution = i.institution_id
            WHERE i.institution_id = (SELECT inst.institution_id FROM institution inst
                INNER JOIN user_mapping um on inst.institution_id = um.institution_id
                WHERE um.user_id=".$secretaryId.");");
        $result = mysqli_fetch_all($query);
        for($i=0;$i<count($result);$i++) {
            $date = $result[$i][4];
            if($result[$i][3]==null) {
                $result[$i][3] ="-----";
            }
            try {
                $datetime = new DateTime($date);
                $result[$i][4] = date_format($datetime,"d.m.Y");
            } catch (Exception $e) {
                $result[$i][4] =$date;
            }
        }
        return $result;
    }

    public function setProjekt($points_reachable, $path_to_matrix,  $submission_date, $open_to_invite, $max_of_students, $name) {

        $date = new DateTime($submission_date);

        $query = $this->conn->query("
        INSERT INTO db_pain.project (points_reachable, path_to_matrix, submission_date, open_to_invite, max_of_students, name)
        VALUES (".$points_reachable.", '".$path_to_matrix."', '".$date->format('Y-m-d H:i:s:u')."', ".$open_to_invite.", ".$max_of_students.",'".$name."') ");

    }
    public function getStammdaten($userId) {
        $query = $this->conn->query("
            SELECT login, email, password, name, surename FROM user u
            WHERE u.user_id =".$userId);
        return mysqli_fetch_all($query);
    }
    public function stammdatenUpdate($stammdaten, $userId, $auswahl)
    {
        if ($auswahl == 1) {
            $query = $this->conn->query("
            UPDATE user u
            SET login=".$stammdaten."
            WHERE u.user_id =" . $userId);
            return $query;
        }
        if ($auswahl == 2) {
            $this->conn->query("
            UPDATE user u
            SET email=".$stammdaten."
            WHERE u.user_id =" . $userId);
        }
        if ($auswahl == 3) {
            $this->conn->query("
            UPDATE user u
            SET password=".$stammdaten."
            WHERE u.user_id =" . $userId);
        }
        if ($auswahl == 4) {
            $this->conn->query("
            UPDATE user u
            SET name=".$stammdaten."
            WHERE u.user_id =" . $userId);
        }
        if ($auswahl == 5) {
            $this->conn->query("
            UPDATE user u
            SET surename=".$stammdaten."
            WHERE u.user_id =" . $userId);
        }
    }
    public function setUser($user_id, $login, $email, $password, $surename, $name){
        if($user_id > 0) {
            $query = $this->conn->query("
                UPDATE db_pain.user
                SET password = '".$password."', email = '".$email."', login = '".$login."', name = '".$name."', surename = '".$surename."'
                WHERE user_id = ".$user_id
            );
            return false;
        } else {
            $query = $this->conn->query("
                INSERT INTO db_pain.user(password, email, login, name, surename)
                VALUES ('".$password."', '".$email."', '".$login."', '".$name."' ,'".$surename."')"
            );
            $tempID = $this->conn->query("
            SELECT LAST_INSERT_ID() FROM db_pain.user LIMIT 1
            ");
            return mysqli_fetch_all($tempID)[0][0];
        }
    }

    public function setUserCIR($user_id, $institute, $course_input, $role_input, $userStatus) {
        $query = $this->conn->query("
            SELECT institution_id FROM institution WHERE name = '".$institute."' limit 1
            
        ");
        $instValue = mysqli_fetch_all($query);


        if(count($instValue) == 0 ) {
            $this->conn->query("
            INSERT INTO db_pain.institution (name) VALUES ('".$institute."')
            ");

            $query = $this->conn->query("
            SELECT LAST_INSERT_ID() FROM db_pain.institution LIMIT 1
            ");
            $instValue = mysqli_fetch_all($query)[0][0];
        } else {
            $instValue = $instValue[0][0];
        }


        $query = $this->conn->query("
            SELECT course_id FROM course WHERE name = '".$course_input."' limit 1
            
        ");
        $courseValue = mysqli_fetch_all($query);

        if(count($courseValue) == 0 ) {
            $this->conn->query("
            INSERT INTO db_pain.course (institution, name) VALUES (".$instValue.", '".$course_input."')
            ");

            $query = $this->conn->query("
            SELECT LAST_INSERT_ID() FROM db_pain.course LIMIT 1
            ");
            $courseValue = mysqli_fetch_all($query)[0][0];
        } else {
            $courseValue = $courseValue[0][0];
        }

        if(!$userStatus) {
            $this->conn->query("
                UPDATE db_pain.user_mapping
                SET course_id = ".$course_input.", institution_id = ".$institute."
                WHERE user_id = ".$user_id
            );

            $this->conn->query("
                UPDATE db_pain.user_role
                SET role_id = ".$role_input."
                WHERE user_id = ".$user_id
            );
        } else {
            $this->conn->query("
            INSERT INTO db_pain.user_mapping (user_id, course_id, institution_id) VALUES (".$userStatus.",".$courseValue." , ".$instValue.")
        ");

            $this->conn->query("
            INSERT INTO db_pain.user_role (role_id, user_id) VALUES (".$role_input.", ".$userStatus.")
        ");
        }



    }

    public function getUser($user_id) {
        $query = $this->conn->query("
            SELECT u.user_id, r.role_id, u.password, u.email, u.login, u.name, u.surename, c.name, i.name
            FROM user u
            INNER JOIN user_role r ON r.user_id = u.user_id
            RIGHT JOIN user_mapping m ON m.user_id = u.user_id
            INNER JOIN course c ON c.course_id = m.course_id
            INNER JOIN institution i ON i.institution_id = m.institution_id
            WHERE u.user_id = " .$user_id);
        return mysqli_fetch_all($query);
    }


    /**
     * gets the number of people and then the course
     * checks whether course is set if not it returns false else
     * it creates for each a new login and user
    */
    public function createNewUsers($number,$course) {
        $password =password_hash('123456',PASSWORD_BCRYPT);
        $possibilities = "1234567890abcdefghijklmnopqrstuvwxyz_-.ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $users  = [];
        for($i=0;$i<$number;++$i) {
            $randomLogin = '';
            for ($j=0;$j<6;++$j) {
                $randomLogin = $randomLogin.$possibilities[rand(0,strlen($possibilities)-1)];
            }
            //select ocurse and institution id
            $query = $this->conn->query("
                SELECT course.course_id,i.institution_id
                FROM course
                INNER JOIN institution i on course.institution = i.institution_id
                WHERE course.name='".$course."'


            ");
            $course_institution_id = mysqli_fetch_all($query);
            if ($course_institution_id == false or count($course_institution_id)!=1) { //if it isnt found the course the course is returned
                return -1;
            }
            $this->conn->multi_query("
                INSERT INTO user (password, email, name, surename, login) VALUES ('".$password."' ,null, null,null,'".$randomLogin."');
            ");
            $query = $this->conn->query("
                SELECT LAST_INSERT_ID() FROM user LIMIT 1
            ");
            $user_id = mysqli_fetch_all($query)[0][0];
            array_push($users,$user_id);

            $this->conn->multi_query("
                INSERT INTO db_pain.user_mapping (user_id, course_id, institution_id) VALUES (".$user_id.",".$course_institution_id[0][0].", ".$course_institution_id[0][1].")
            ");
            $this->conn->query("
                INSERT INTO db_pain.user_role (role_id, user_id) VALUES (2, '".$user_id."');
            ");
        }
        $table_query =$this->conn->query("
            SELECT DISTINCT us.user_id as id, us.login as name, c.name as Kurs, '123456' as password
            FROM user us
            INNER JOIN user_mapping um on us.user_id = um.user_id
            INNER JOIn course c on um.course_id = c.course_id
            WHERE us.user_id>=".$users[0]." and us.user_id<=".$users[count($users)-1]."+1
        ");
        return mysqli_fetch_all($table_query,MYSQLI_ASSOC);
    }

    /**
     * Gets cours name and institution name
     * IF the institution already exists it is used else it is new created
     * Then the course is created
     */
    public function createNewCourse($courseName,$institutionName) {
        $query = $this->conn->query("
            SELECT institution_id as id
            FROM institution
            WHERE name='".$institutionName."'
        ");
        $id_inst = mysqli_fetch_all($query,MYSQLI_ASSOC);
        if (count($id_inst)==0) {
            $this->conn->query("
                INSERT INTO db_pain.institution (name) VALUES ('".$institutionName."')
            ");
            $inst_query = $this->conn->query("
                SELECT LAST_INSERT_ID() as last FROM institution LIMIT 1
            ");
            $id_inst = mysqli_fetch_all($inst_query,MYSQLI_ASSOC)[0]["last"];
        } else {
            $id_inst= $id_inst[0]["id"];
        }
        $get_course = $this->conn->query("
            SELECT name FROM course WHERE name='".$courseName."'
        ");
        if (count(mysqli_fetch_all($get_course))>0) {
            return $courseName;
        }

        //insert stuff
        $this->conn->query("
            INSERT INTO db_pain.course (institution, name) VALUES ($id_inst, '".$courseName."')
        ");
        $course = $this->conn->query("
            SELECT course.name as courseName 
            FROM course
            WHERE course.course_id=LAST_INSERT_ID()
        ");
        return mysqli_fetch_all($course)[0][0];
    }
    /**
     * get all users after creating multiple users
    */
    public function getAllUsersByID($start,$end) {
        $query = $this->conn->query("
            SELECT DISTINCT us.user_id as id, us.login as name, c.name as Kurs, '123456' as password
            FROM user us
                     INNER JOIN user_mapping um on us.user_id = um.user_id
                     INNER JOIn course c on um.course_id = c.course_id
            WHERE us.user_id>='".$start."' and us.user_id<=".$end."
        ");
        return mysqli_fetch_all($query,MYSQLI_ASSOC);
    }

    /**
     * updates the user and the passsword.
     * If the login is set and email is set and name and surename is set then it is updated
    */
    public function updateUser($id,$password,$login=null,$email=null,$name=null,$surename=null) {
        $update = "
            UPDATE db_pain.user us
            SET us.password = '".$password."' ";
        if($login!=null) {
            $update = $update."AND us.login = '".$login."'";
        }
        if($email!= null) {
            $update = $update."AND user.email='".$email."' ";
        }
        if ($name!=null) {
            $update = $update."AND user.name='".$name."' ";
        }
        if ($surename!=null) {
            $surename = $update."AND user.name='".$name."' ";
        }
        $update = $update."WHERE user.user_id=".$id;
        $this->conn->query($update);
    }

    /**
     * this locks the group inventation of the current project so there can nobody invite others
     */
    public function lockGroupInventation($id) {
        $this->conn->query("
            UPDATE project SET open_to_invite = FALSE 
            WHERE project_id=".$id);
    }

    public function getAllProjects($current_id=null) {
        if ($current_id==null) {
            $query = $this->conn->query("
            SELECT p.name,p.project_id,p.max_of_students as max
            FROM project as p
            WHERE submission_date>=CURRENT_DATE()

        ");
            return mysqli_fetch_all($query,MYSQLI_ASSOC);
        } else {
            $query = $this->conn->query("
                SELECT p.name,p.project_id,p.max_of_students as max
                FROM project as p
                LEFT JOIN project_class pc on p.project_id = pc.project_id
                LEFT JOIN user_mapping um on pc.course_id = um.course_id
                WHERE submission_date>=CURRENT_DATE() and um.user_id=".$current_id." and p.open_to_invite=True
            ");
            return mysqli_fetch_all($query,MYSQLI_ASSOC);
        }

    }

    /**
     * gets user id and gives back all the projects it is in
    */
    public function getProjectsToUSer($user_id) {
        $query = $this->conn->query("
            SELECT p.project_id FROM project as p
            INNER join project_class pc on p.project_id = pc.project_id
            INNER join user_mapping um on pc.course_id = um.course_id
            WHERE user_id=".$user_id."
        ");
        $projects = mysqli_fetch_all($query,1);
        $project_new = [];
        foreach ($projects as $project) {
            array_push($project_new,$project);
        }
        return json_encode($project_new);
    }
    /**
     * gets all user to one user which he is allowed to invite
    */
    public function getAllSuitableUser($role,$userId) {
        if ($role==1) {
            $query = $this->conn->query("
                SELECT DISTINCT us.surename,us.name,us.login,us.user_id as id
                FROM user as us
                 INNER JOIN user_mapping um on us.user_id = um.user_id
                 RIGHT JOIN project_class pc on um.course_id = pc.course_id
                 INNER JOIN user_role ur on us.user_id = ur.user_id
                 INNER JOIN role r on ur.role_id = r.role_id
                WHERE r.role_id=2   

            ");
            return mysqli_fetch_all($query,1);
        } else {
            $query = $this->conn->query("
                 SELECT DISTINCT us.user_id as id,us.surename,us.name,us.login
                 FROM user as us
                 LEFT JOIN user_mapping um on us.user_id = um.user_id
                 INNER JOIN project_class pc on um.course_id = pc.course_id
                 INNER JOIN course c on pc.course_id = c.course_id
                 INNER JOIN user_role ur on us.user_id = ur.user_id
                 INNER JOIN role r on ur.role_id = r.role_id
                 INNER JOIN project p on pc.project_id = p.project_id
                 WHERE c.course_id=(
                    SELECT cour.course_id
                    FROM course as cour
                    INNER JOIN user_mapping u on cour.course_id = u.course_id
                    WHERE u.user_id=".$userId." LIMIT 1
                 )  AND r.role_id=2 AND us.user_id!=".$userId."
            ");
            return mysqli_fetch_all($query,MYSQLI_ASSOC);
        }
    }


    /**
     * creates gorup and getzs the id of this project
     * then it creates the connection in rating for each user id
    */
    public function createGroup($course_id,$name,$member,$currentId=null,$isAdmin=true) {
        $this->conn->query("
            INSERT INTO db_pain.groupings (name, submitted, submitted_time, project_id) VALUES ('".$name."', DEFAULT, null, ".$course_id.")
        ");
        $query = $this->conn->query("
            SELECT LAST_INSERT_ID() FROM project LIMIT 1
        ");
        $group_id = mysqli_fetch_all($query)[0][0];
        if ($isAdmin) {
            foreach ($member as $user_id) {
                $this->conn->query("
                    INSERT INTO db_pain.rating (user_id, group_id, points, is_admin) VALUES (".$user_id.", ".$group_id.", null, DEFAULT)
                ");
            }
        } else {
            $this->conn->query("
                    INSERT INTO db_pain.rating (user_id, group_id, points, is_admin) VALUES (".$currentId.", ".$group_id.", null, 1)
                ");
            foreach ($member as $user_id) {

                $this->createInvite($group_id,$user_id);
            }
        }
    }
    /**
     * gets all the projects to have a project overview
    */
    public function getAllProjectsDetails($project_id) {
        $query =$this->conn->query("
           SELECT g.group_id as id, p.name as project,g.name as groupname,g.submitted,g.submitted_time,g.group_id,g.name,
               (SELECT COUNT(r.user_id)
                   FROM rating as r
                   WHERE r.group_id=g.group_id) as number
            FROM groupings as g
            LEFT JOIN project p on p.project_id = g.project_id
            WHERE p.project_id=".$project_id."
        ");
        $projects = mysqli_fetch_all($query,1);
        if (count($projects)==0) {
            return [];
        }
        for ($i=0;$i<count($projects);++$i) {
            if ($projects[$i]["submitted"]==false) {
                $projects[$i]["submitted"] = "keine Abgabe";
                $projects[$i]["submitted_time"] = "keine Zeit";

            } else {
                $projects[$i]["submitted"] = "Abgegeben";
                $datetime = new DateTime($projects[$i]["submitted_time"]);
                $projects[$i]["submitted_time"] = date_format($datetime,"d.m.Y H:i")." Uhr";
            }
        }
        return $projects;

    }
    public function getGrades() {
        $query = $this->conn->query("
        SELECT r.points,p.points_reachable,u.name,u.surename,p.name as project
        FROM rating as r
        INNER JOIN groupings g on r.group_id = g.group_id
        INNER JOIN user u on r.user_id = u.user_id
        INNER JOIN project p on g.project_id = p.project_id
        ");
        $grades = mysqli_fetch_all($query,1);
        for ($i=0;$i<count($grades);++$i) {
            if ($grades[$i]["points"]==null) {
                $grades[$i]["points"] = "k.A.";
            }
            $grades[$i]["points"] =$grades[$i]["points"]."/".$grades[$i]["points_reachable"];
            unset($grades[$i]["points_reachable"]);
        }
        return $grades;
    }

    public function getUserBewertungTable($userID) {
        $query = $this->conn->query("
        SELECT r.points, g.name, p.name, p.points_reachable
        FROM rating r
            INNER JOIN groupings g on r.group_id = g.group_id
            INNER JOIN project p on g.project_id = p.project_id
        WHERE r.user_id =" . $userID);
        return mysqli_fetch_all($query);
    }
    public function getGroupRatingStuff($groupID) {
        $query = $this->conn->query("
        SELECT r.user_id, u.surename, r.points
        FROM rating r
            INNER JOIN user u on r.user_id = u.user_id
        WHERE r.group_id=".$groupID);
        return mysqli_fetch_all($query);
    }
    public function updatePoints($points, $user) {
        $this->conn->query("
            UPDATE rating SET points = '".$points."' 
            WHERE user_id=".$user);
    }
    public function getPwAlt($user) {
        $query = $this->conn->query("
        SELECT password
        FROM user
        WHERE user_id=".$user);
        return mysqli_fetch_all($query);
    }

    public function getUserInvites($userId) {
        $query = $this->conn->query("
        SELECT inv.Group_ID,p.name,p2.submission_date FROM invites as inv
      INNER JOIN user u on inv.User_ID = u.user_id
      INNER JOIN groupings p on inv.Group_ID= p.group_id
        INNER JOIN project p2 on p.project_id = p2.project_id
        WHERE u.user_id =".$userId);
        $result = mysqli_fetch_all($query);
        return $result;
    }

    public function isInvitational($projectID)
    {
        $query = $this->conn->query("
            SELECT p.open_to_invite FROM project as p
            WHERE p.project_id =".$projectID);
        $result = mysqli_fetch_all($query);
        return $result;
    }

    public function getAllUsersInCourse($userId, $projectId) {
        $query = $this->conn->query("
            SELECT u.user_id , u.name FROM user as u
            INNER JOIN user_mapping um on um.user_id = u.user_id
            INNER JOIN course c on c.course_id = um.course_id
            WHERE u.user_id !=".$userId);
        $result = mysqli_fetch_all($query);
        return $result;
    }

    public function createInvite($groupId, $userId)
    {
        $this->conn-> query("INSERT INTO invites (ID,Group_ID,User_ID) VALUES (null, $groupId,$userId)");
    }

    public function AddToGroup($userId, $groupId)
    {
        $this->conn-> query("INSERT INTO rating (user_id,group_id, points, is_admin) VALUES ( $userId,$groupId,null ,0)");
        $this->RemoveInvite($userId,$groupId);
    }

    public function RemoveInvite($userId, $groupId)
    {
        //remove the specified invite from the database
        $this->conn->query("
            Delete FROM invites
            WHERE User_ID =".$userId);//."AND Group_ID=".$groupId);
    }

    public function SubmitGroupProject($userId,$projektId, $timeStamp)
    {
        $query = $this->conn->query("
            SELECT g.group_id FROM groupings as g
            INNER JOIN project p on p.project_id = g.project_id
            Inner JOIN rating r on r.group_id = g.group_id 
            WHERE r.user_id =".$userId);
        $result = mysqli_fetch_all($query,MYSQLI_NUM );
        //update submitted und subtime in der Gruppe
        $this->conn->query("
        UPDATE groupings SET `submitted`=1,`submitted_time`=".$timeStamp."
        WHERE  groupings.group_id=".$result[0][0]);
    }
    public function createClass_Project($project_id,$course_name) {
        $query =$this->conn->query("SELECT course_id FROM course WHERe name='".$course_name."' LIMIT 1");
        $course_id =mysqli_fetch_all($query) ;
        if (count($course_id)==0) {
            return false;
        }
        $this->conn->query("
            INSERT INTO db_pain.project_class (project_id, course_id) VALUES (".$project_id.", ".$course_id[0][0].")
        ");
        return true;
    }


}
