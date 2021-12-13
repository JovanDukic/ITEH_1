drop database if exists ITEH_1;

create database if not exists ITEH_1;

use ITEH_1;

create table if not exists User(
    ID int not null auto_increment,
    username varchar(100) not null,
    password varchar(100) not null,
    firstname varchar(100) not null,
    lastname varchar(100) not null,
    age varchar(100) not null,
    gender enum('male', 'female') not null,
    primary key(ID)
);

create table if not exists CovidTest(
    ID int not null auto_increment,
    type enum('pcr', 'quick') not null,
    primary key(ID)
);

create table if not exists UserTest(
    ID int not null auto_increment,
    userID int not null,
    testID int not null,
    date date not null,
    ambulance enum (
        'A-ambulance',
        'B-ambulance',
        'C-ambulance',
        'D-ambulance',
        'E-ambulance'
    ) not null,
    result enum('positive', 'negative') not null,
    primary key(ID, userID, testID),
    foreign key(userID) references User(ID),
    foreign key(testID) references CovidTest(ID)
);

insert into
    CovidTest (type)
values
    ('quick'),
    ('pcr');