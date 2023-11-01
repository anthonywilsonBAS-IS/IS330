USE Droneoperations;


/*Selecting data from two or more tables using a JOIN condition*/
SELECT FirstName, LastName, CallSign, SectorName 
FROM Pilots
 INNER JOIN Sectors 
  ON Pilots.PilotID = Sectors.SectorID;



/*Inserting a row into a table using INSERT*/
INSERT INTO Drones (DroneName)
VALUES ('Quad-Copter');

/* Updating a row using UPDATE */
UPDATE Locations
Set LocationName = 'Region L'
Where LocationID = 2;


/* Deleting a row using DELETE */
DELETE From Pilots 
Where PilotID = 3;


/* Selecting data from one table */
SELECT FirstName, LastName, CallSign FROM Pilots;