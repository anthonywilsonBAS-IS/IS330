USE Droneoperations;

INSERT INTO Sectors (SectorName)
VALUES ('Military'),
	   ('Civilian');

INSERT INTO Pilots (FirstName, LastName, CallSign, PasswordHash, SectorID)
VALUES ('Nick','Bradshaw', 'Goose', '$2y$10$Uy6NhSyjY2Pvk.RHKT482eP7QKDFe0OEvqh8BPavgmqx9pkqdfyhW', '1'),
	   ('Ron', 'Kerner', 'Slider', '$2y$10$Uy6NhSyjY2Pvk.RHKT482eP7QKDFe0OEvqh8BPavgmqx9pkqdfyhW', '1'),
	   ('Tom', 'Kazansky', 'Iceman', '$2y$10$Uy6NhSyjY2Pvk.RHKT482eP7QKDFe0OEvqh8BPavgmqx9pkqdfyhW', '1'),
	   ('Pete', 'Mitchell', 'Maverick', '$2y$10$Uy6NhSyjY2Pvk.RHKT482eP7QKDFe0OEvqh8BPavgmqx9pkqdfyhW', '2'),
	   ('Bradley', 'Bradshaw', 'Rooster', '$2y$10$Uy6NhSyjY2Pvk.RHKT482eP7QKDFe0OEvqh8BPavgmqx9pkqdfyhW', '2'),
	   ('Natasha', 'Trace', 'Phoenix', '$2y$10$Uy6NhSyjY2Pvk.RHKT482eP7QKDFe0OEvqh8BPavgmqx9pkqdfyhW', '2');

INSERT INTO Locations (LocationName)
VALUES ('Area A'),
       ('Region B'),
	   ('Coastal Area Z'),
	   ('Town y'),
	   ('City X');

INSERT INTO Organizations (OrgName, OrgType)
VALUES ('Military Organization A', 'Military'),
       ('Military Organization B', 'Military'),
	   ('Commerical Company X', 'Commerical'),
	   ('Commerical Company X', 'Commerical');

INSERT INTO DroneTypes (TypeName, DroneCategory)
VALUES ('Multi-Rotor', 'Agriculture'),
	   ('Fixed-Wing', 'Mapping'),
	   ('Single-Rotor', 'Enviornmental'),
	   ('Fixed-Wing VTOL', 'Delivery'),
       ('MQ-9 Reaper', 'Reconnaissance');

INSERT INTO Drones (DroneName, DroneTypeID )
VALUES ('Drone 001', '4'),
	   ('Drone 002', '2'),
	   ('Drone X1', '1'),
	   ('Drone X2', '5'),
	   ('Drone Y1', '3');

INSERT INTO Maintenances (MaintenanceDate, DroneID, MaintenanceDescription)
VALUES ('2023-09-05','1','Routine maintenance and inspection'),
	   ('2023-08-20','5','Repair of damaged propellers'),
	   ('2023-09-10', '3','Battery replacement');

INSERT INTO Assignments ( AssignmentName,  MissionDate, MissionComplete, MissionCompletion, Notes, FlightTime)
VALUES ('Mission A', '2023-09-15', True, '18:27:00', 'Training Flight', '02:30:00'),
       ('Mission B', '2023-09-16', False, '13:11:00', 'maintenance test flight', '01:45:00'),
	   ('Delivery X', '2023-09-17', True, '14:23:00', 'Recon', '01:15:00'),
	   ('Reconnaissance Y', '2023-09-18', True, '11:40:00', 'Survellance','02:00:00'),
	   ('Search and Rescue W', '2023-09-20', True, '15:35:00', 'delivery', '01:30:00');

SELECT * FROM PILOTS;