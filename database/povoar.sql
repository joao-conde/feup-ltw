INSERT INTO User (username, encryptedPassword, fullName, shortDescription) 
VALUES ('leonardomgt', 'leozinho', 'Leonardo Teixeira', 'Estudante da FEUP');

INSERT INTO User (username, encryptedPassword, fullName, shortDescription) 
VALUES ('joaopedrofump', 'pedrinho', 'Joao Pedro Furriel', 'Estudante do MIEIC');

INSERT INTO User (username, encryptedPassword, fullName, shortDescription) 
VALUES ('joao_conde', 'condinho', 'Joao Conde', 'Estudante da UP');

INSERT INTO Project(projTitle, projDescription, usernameCreator) VALUES ("CGRA", "Submarino", 'joao_conde');
INSERT INTO Project(projTitle, projDescription, usernameCreator) VALUES ("Sauna - SOPE", "Trabalho de SOPE", 'joaopedrofump');
INSERT INTO Project(projTitle, projDescription, usernameCreator) VALUES ("LAIG", "Maquete FEUP", 'leonardomgt');
INSERT INTO Project(projTitle, projDescription, usernameCreator) VALUES ("CAL", "Maps", 'leonardomgt');

INSERT INTO User_Project(username,idProject, userRole) VALUES ('joao_conde',1,'Administrator');
INSERT INTO User_Project(username,idProject, userRole) VALUES ('joaopedrofump',2,'Administrator');
INSERT INTO User_Project(username,idProject, userRole) VALUES ('leonardomgt',3,'Administrator');
INSERT INTO User_Project(username,idProject, userRole) VALUES ('leonardomgt',4,'Administrator');
INSERT INTO User_Project(username,idProject, userRole) VALUES ('joaopedrofump',1,'Contributor');

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlCategory) 
VALUES (1,'Database','Database management', 'Database');

INSERT INTO Task(username,todoListID,taskTitle,taskDescription,taskDateDue)
VALUES ('joaopedrofump',1,'PHP Functions', 'Develop php functions to database', '3/12/2017');