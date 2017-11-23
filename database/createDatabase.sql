DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS User_Project;
DROP TABLE IF EXISTS Project;
DROP TABLE IF EXISTS TodoList;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS Dependency;

PRAGMA foreign_keys = ON;


CREATE TABLE User(  
    id INTEGER PRIMARY KEY,
    username TEXT UNIQUE,
    encryptedPassword TEXT,
    fullName TEXT,
    shortDescription TEXT,
    imagePath TEXT
);

CREATE TABLE User_Project(
    idUser INTEGER REFERENCES User,
    idProject INTEGER REFERENCES Project,
    userRole TEXT,
    PRIMARY KEY(idUser, idProject)
);

CREATE TABLE Project(
    id INTEGER PRIMARY KEY,
    userCreatorID INTEGER REFERENCES User
);

CREATE TABLE TodoList(
    id INTEGER PRIMARY KEY,
    projectID INTEGER REFERENCES Project,
    tdlTitle TEXT,
    tdlDescription TEXT,
    tdlCategory TEXT
);

CREATE TABLE Task(
    id INTEGER PRIMARY KEY,
    userResponsableID INTEGER REFERENCES User,
    taskTitle TEXT,
    taskDescription TEXT,
    taskDateDue DATE
);

CREATE TABLE Dependency(
    taskDependentID INTEGER REFERENCES Task,
    taskRequiredID INTEGER REFERENCES Task,
    PRIMARY KEY(taskDependentID, taskRequiredID)
);

