USE disciplinary;

INSERT INTO Student (EnrollmentNo, FirstName, LastName, DOB, Gender, Email) VALUES
('ENR001','Alice','Karanja','2003-05-12','F','alice.k@example.edu'),
('ENR002','Ben','Otieno','2002-08-03','M','ben.o@example.edu');

INSERT INTO Staff (StaffNo, Name, Role, Email) VALUES
('STF001','Mary Wanjiru','Teacher','mary.w@example.edu'),
('STF002','John Mwangi','Discipline Officer','john.m@example.edu');

INSERT INTO OffenseType (Code, Description, SeverityLevel) VALUES
('OT01','Plagiarism',3),
('OT02','Late Submission',1),
('OT03','Fighting / Physical Altercation',4);

INSERT INTO IncidentReport (ReportDate, Location, ReporterStaffID, StudentID, Description, Status) VALUES
('2025-11-01 09:10:00','Classroom C3',1,1,'Copied assignment from another student','Under Review'),
('2025-10-20 14:30:00','Playground',2,2,'Physical altercation with peer','Actioned');

INSERT INTO ReportOffense (IncidentID, OffenseTypeID, Notes) VALUES
(1,1,'Evidence: Similar write-up found'),
(2,3,'Witnesses: 2 students');

INSERT INTO DisciplinaryAction (IncidentID, ActionType, ActionDate, DurationDays, DecisionMakerID, Notes) VALUES
(1,'Warning', '2025-11-05', 0, 2, 'Counseling required'),
(2,'Suspension', '2025-10-22', 7, 2, '1-week suspension for fight');