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
    idProject INTEGER REFERENCES Project ON DELETE CASCADE ON UPDATE CASCADE,
    userRole TEXT,
    PRIMARY KEY(username, idProject)
);

CREATE TABLE Project(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    projTitle TEXT,
    projDescription TEXT,
    usernameCreator TEXT REFERENCES User,
    projDateDue INTEGER,
    UNIQUE(projTitle, usernameCreator)
);

CREATE TABLE TodoList(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    projectID INTEGER REFERENCES Project,
    tdlTitle TEXT,
    tdlDescription TEXT,
    tdlDateDue INTEGER
);

CREATE TABLE Task(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    userResponsable TEXT REFERENCES User,
    todoListID INTEGER REFERENCES TodoList,
    taskTitle TEXT,
    taskDescription TEXT,
    taskDateDue INTEGER,
    percentageCompleted INTEGER
);

CREATE TABLE Dependency(
    taskDependentID INTEGER REFERENCES Task,
    taskRequiredID INTEGER REFERENCES Task,
    PRIMARY KEY(taskDependentID, taskRequiredID)
);


DROP TRIGGER IF EXISTS InserirProjectoAdm;
DROP TRIGGER IF EXISTS EliminarProjectoAdm;

CREATE TRIGGER InserirProjectoAdm
AFTER INSERT ON Project
BEGIN
    INSERT INTO User_Project(username, idProject, userRole) 
    VALUES (New.usernameCreator, New.id, 'Administrator');
END;

CREATE TRIGGER EliminarProjectoAdm
AFTER
DELETE ON Project
BEGIN
    DELETE FROM User_Project
    WHERE User_Project.idProject = Old.id;
END;
