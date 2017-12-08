INSERT INTO Project(projTitle, projDescription, usernameCreator, projDateDue) 
    VALUES ("LAIG Project", "Ni Ju Game Interface", "conde", '29/12/2017');

INSERT INTO User_Project(username,idProject, userRole) VALUES ('fump',2,'Developer');

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlDateDue) 
    VALUES (2,'Pieces','Create Pieces', '20/12/2017');

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('fump',4,'Pieces XML', 'Create XML for pieces.', '15/12/2017',20);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
    VALUES ('conde',4,'Pieces Textures', 'Create Textures for pieces.', '15/12/2017',20);