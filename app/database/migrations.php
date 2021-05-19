<?php

namespace App\database;

$database = new Database;

$query = 
' 
    create table if not exists products(
        id int not null primary key auto_increment,
        title varchar(50) not null,
        description text not null,
        price double(10,2) not null
    )         
';

$database->create_table($query);