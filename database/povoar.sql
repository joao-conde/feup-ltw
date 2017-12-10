.read createDatabase.sql

INSERT INTO User (username, encryptedPassword, fullName, shortDescription) 
VALUES ('leonardomgt', 'leozinho', 'Leonardo Teixeira', 'Estudante da FEUP');
  		  
INSERT INTO User (username, encryptedPassword, fullName, shortDescription) 		
VALUES ('joaopedrofump', 'pedrinho', 'Joao Pedro Furriel', 'Estudante do MIEIC');		
  		  
INSERT INTO User (username, encryptedPassword, fullName, shortDescription)
VALUES ('joao_conde', 'condinho', 'Joao Conde', 'Estudante da UP');
  		  
INSERT INTO Project(projTitle, projDescription, usernameCreator, projDateDue) 
VALUES ("CGRA", "Submarino", 'leonardomgt', '14/12/2017');

INSERT INTO Project(projTitle, projDescription, usernameCreator, projDateDue) 
VALUES ("Sauna - SOPE", "Trabalho de SOPE", 'leonardomgt', '14/12/2017');

INSERT INTO Project(projTitle, projDescription, usernameCreator, projDateDue) 
VALUES ("LAIG", "Maquete FEUP", 'joao_conde', '14/12/2017');		

INSERT INTO Project(projTitle, projDescription, usernameCreator, projDateDue) 
VALUES ("CAL", "Maps", 'joaopedrofump', '14/12/2017');

INSERT INTO Project(projTitle, projDescription, usernameCreator, projDateDue) 
VALUES ("LTW Project", "Task Manager Web App", "joaopedrofump", '14/12/2017');


INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlDateDue) 
VALUES (1,'Responsive Site','Make Website Responsive', '13/12/2017');

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlDateDue) 
VALUES (1,'User Interface','Javascript Files', '10/12/2017');

INSERT INTO TodoList(projectID,tdlTitle,tdlDescription,tdlDateDue) 
VALUES (1,'Database','Database Files', '10/12/2017');


INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue, percentageCompleted)
VALUES ('joaopedrofump',1,'CSS for Tablet', 'CSS for Tablet', '11/12/2017',0);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
VALUES ('joaopedrofump',1,'CSS for Phone', 'CSS for Phone', '11/12/2017',20);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
VALUES ('joaopedrofump',2,'Javascript User', 'Javascript User', '10/12/2017',10);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
VALUES ('joaopedrofump',2,'Javascript Project', 'Javascript User', '10/12/2017',0);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
VALUES ('joaopedrofump',3,'Database Creation', 'Database Creation File', '9/12/2017',10);

INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue,percentageCompleted)
VALUES ('joaopedrofump',3,'Database Population', 'Database Population File', '9/12/2017',20);
