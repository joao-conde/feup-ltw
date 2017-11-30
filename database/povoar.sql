INSERT INTO User (username, encryptedPassword, fullName, shortDescription) 
VALUES ('leonardomgt', 'leozinho', 'Leonardo Teixeira', 'Estudante da FEUP');

INSERT INTO User (username, encryptedPassword, fullName, shortDescription) 
VALUES ('joaopedrofump', 'pedrinho', 'Joao Pedro Furriel', 'Estudante do MIEIC');

INSERT INTO User (username, encryptedPassword, fullName, shortDescription) 
VALUES ('joao_conde', 'condinho', 'Joao Conde', 'Estudante da UP');

INSERT INTO Project(projTitle, projDescription, userCreatorID) VALUES ("CGRA", "Submarino", 3);
INSERT INTO Project(projTitle, projDescription, userCreatorID) VALUES ("Sauna - SOPE", "Trabalho de SOPE", 2);
INSERT INTO Project(projTitle, projDescription, userCreatorID) VALUES ("LAIG", "Maquete FEUP", 1);
INSERT INTO Project(projTitle, projDescription, userCreatorID) VALUES ("CAL", "Maps", 1);

INSERT INTO User_Project(idUser,idProject, userRole) VALUES (3,1,'Administrator');
INSERT INTO User_Project(idUser,idProject, userRole) VALUES (2,2,'Administrator');
INSERT INTO User_Project(idUser,idProject, userRole) VALUES (1,3,'Administrator');
INSERT INTO User_Project(idUser,idProject, userRole) VALUES (1,4,'Administrator');
INSERT INTO User_Project(idUser,idProject, userRole) VALUES (2,1,'Contributor');

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlCategory) 
VALUES (1,'Database','Database management', 'Database');

INSERT INTO Task(userResponsableID,todoListID,taskTitle,taskDescription,taskDateDue)
VALUES (2,1,'PHP Functions', 'Develop php functions to database', '3/12/2017');