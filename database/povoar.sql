/*
Projects
*/

INSERT INTO Project(projTitle, projDescription, usernameCreator, projDateDue) 
    VALUES ("LTW Project", "Task Manager Web App", "fump", 1513263085);

INSERT INTO Project(projTitle, projDescription, usernameCreator, projDateDue) 
    VALUES ("LAIG Project", "Ni Ju Game Interface", "conde", 1514505600);


/*
    Contributors
*/

INSERT INTO User_Project(username,idProject, userRole) VALUES ('fump',2,'Developer');
INSERT INTO User_Project(username,idProject, userRole) VALUES ('conde',1,'Developer');

/*
    To Do Lists
*/

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlDateDue) 
    VALUES (1,'Responsive Site','Make Website Responsive', 1513176685);

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlDateDue) 
    VALUES (1,'User Interface','Javascript Files', 1512917485);

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlDateDue) 
    VALUES (1,'Database','Database Files', 1512917485);

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlDateDue) 
    VALUES (2,'Pieces','Create Pieces', 1513781485);

/*
    Tasks
*/


INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue, percentageCompleted)
    VALUES ('fump',1,'CSS for Tablet', 'CSS for Tablet', 1513003885,0);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',1,'CSS for Phone', 'CSS for Phone', 1513003885,20);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',2,'Javascript User', 'Javascript User', 1512917485,10);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',2,'Javascript Project', 'Javascript User', 1512917485,0);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',3,'Database Creation', 'Database Creation File', 1512831085,10);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',3,'Database Population', 'Database Population File', 1512831085,20);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',4,'Pieces XML', 'Create XML for pieces.', 1513349485,20);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('conde',4,'Pieces Textures', 'Create Textures for pieces.', 1513349485,20);