<?php

class DBService {
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $conn ;
    private $key = "e&sTC/k+i}^ha;b9%[E'TXm;%a32}dvk}=kH.niwE(R\"q+3T<#";
    function __construct() {
        $this->conn = new mysqli($this->host,$this->username,$this->password);
        $res = $this->conn->multi_query("USE db_pain;");
        if (!$res) {
            $res = $this->conn->multi_query("
                CREATE DATABASE db_pain;
                
                USE db_pain;
                
                create table institution(institution_id int,name varchar(1000) not null);
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
                    read_simple_enavble boolean default false null,
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
                    name varchar(500) null,
                    surename varchar(500) null,
                    course_id int null,
                    constraint user___course
                        foreign key (course_id) references course (course_id)
                            on update cascade
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

                INSERT INTO role_admin (read_simple_enable, name) VALUES (1,'admin');
                INSERT INTO user (password, email, name, surename, course_id) VALUES ('$2y$10\$uWcx72oOw4hWi4iAUgvsNukA6U2TAdt21L3IwVu/CKtyIJ9Wbv/fS' ,'daniel@wierbicki.org', 'admin','',null);
                
            ");
        }
    }

    public function getUserSession() {
        $result =$this->conn->query("
            SELECT user_id as user_id,password as passowrd
            FROM user");
        $users = mysqli_fetch_all($result);
        $session = [];
        foreach ($users as $user) {
            array_push($session,$user[0].$user[1]);
        }

        return $session;
    }

}
