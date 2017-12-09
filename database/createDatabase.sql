PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS Dependency;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS TodoList;
DROP TABLE IF EXISTS User_Project;
DROP TABLE IF EXISTS Project;
DROP TABLE IF EXISTS User;


CREATE TABLE User(
    username TEXT PRIMARY KEY,
    encryptedPassword TEXT,
    fullName TEXT,
    shortDescription TEXT
);

CREATE TABLE User_Project(
    username INTEGER REFERENCES User,
    idProject INTEGER REFERENCES Project,
    userRole TEXT,
    PRIMARY KEY(username, idProject)
);

CREATE TABLE Project(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    projTitle TEXT,
    projDescription TEXT,
    usernameCreator INTEGER REFERENCES User,
    projDateDue DATE,
    UNIQUE(projTitle, usernameCreator)
);

CREATE TABLE TodoList(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    projectID INTEGER REFERENCES Project,
    tdlTitle TEXT,
    tdlDescription TEXT,
    tdlDateDue DATE
);

CREATE TABLE Task(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    userResponsable TEXT REFERENCES User,
    todoListID INTEGER REFERENCES TodoList,
    taskTitle TEXT,
    taskDescription TEXT,
    taskDateDue DATE,
    percentageCompleted INTEGER
);

CREATE TABLE Dependency(
    taskDependentID INTEGER REFERENCES Task,
    taskRequiredID INTEGER REFERENCES Task,
    PRIMARY KEY(taskDependentID, taskRequiredID)
);

