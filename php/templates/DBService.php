<?php

class DBService {
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $conn = null;
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
                
                create table role_admin
                (
                    role_id int,
                    read_simple_enable boolean default false not null
                );
                create unique index role_admin_role_id_uindex
                    on role_admin (role_id);
                alter table role_admin
                    add constraint role_admin_pk
                        primary key (role_id);
                alter table role_admin modify role_id int auto_increment;
                
                create table user
                (
                    user_id long,
                    password varchar(5000) null,
                    name varchar(300) null,
                    surename varchar(300) null,
                    email varchar(300) null,
                    course_id int not null,
                    constraint user__course
                        foreign key (course_id) references course (course_id)
                            on update cascade on delete set null
                );
                create unique index user_user_id_uindex
                    on user (user_id);
                alter table user
                    add constraint user_pk
                        primary key (user_id);
                alter table user modify user_id long auto_increment;


            ");
        }

    }

}