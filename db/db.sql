CREATE TABLE Contacts (PK int auto_increment, `Surname` varchar(254), `Firstname` varchar(254), `Street` varchar(254), `PLZ` varchar(10), `City` varchar(100), `Phone` varchar(50), `Birthdate` date, `Active` enum ('Y', 'N'), PRIMARY KEY (PK));

INSERT INTO Contacts VALUES (1, 'Max', 'Mustermann', 'Straße 1', '64295', 'DA', '+49 123 45678', '20010101', 'N');
INSERT INTO Contacts VALUES (2, 'Frida', 'Mustermann', 'Straße 1', '64295', 'DA', '+49 123 45678', '20010101', 'N');
INSERT INTO Contacts VALUES (3, 'Eva', 'Mustermann', 'Straße 1', '64295', 'DA', '+49 123 45678', '20010101', 'Y');