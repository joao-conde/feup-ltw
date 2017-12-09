INSERT INTO Project(projTitle, projDescription, usernameCreator, projDateDue) 
    VALUES ("LTW Project", "Task Manager Web App", "fump", '14/12/2017');

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlDateDue) 
    VALUES (1,'Responsive Site','Make Website Responsive', '13/12/2017');

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlDateDue) 
    VALUES (1,'User Interface','Javascript Files', '10/12/2017');

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlDateDue) 
    VALUES (1,'Database','Database Files', '10/12/2017');



/*
INSERT INTO User_Project(username,idProject, userRole) VALUES ('joao_conde',1,'Administrator');
INSERT INTO User_Project(username,idProject, userRole) VALUES ('joaopedrofump',2,'Administrator');
INSERT INTO User_Project(username,idProject, userRole) VALUES ('leonardomgt',3,'Administrator');
INSERT INTO User_Project(username,idProject, userRole) VALUES ('leonardomgt',4,'Administrator');
INSERT INTO User_Project(username,idProject, userRole) VALUES ('joaopedrofump',1,'Contributor');
*/



INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue, percentageCompleted)
    VALUES ('fump',1,'CSS for Tablet', 'CSS for Tablet', '11/12/2017',0);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',1,'CSS for Phone', 'CSS for Phone', '11/12/2017',20);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',2,'Javascript User', 'Javascript User', '10/12/2017',10);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',2,'Javascript Project', 'Javascript User', '10/12/2017',0);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',3,'Database Creation', 'Database Creation File', '9/12/2017',10);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',3,'Database Population', 'Database Population File', '9/12/2017',20);
