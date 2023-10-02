CREATE DATABASE IF NOT Exists Droneoperations ;
USE Droneoperations ;

DROP TABLE IF EXISTS Assignments;
DROP TABLE IF EXISTS Maintenances;
DROP TABLE IF EXISTS Drones;
DROP TABLE IF EXISTS DroneTypes;
DROP TABLE IF EXISTS Organizations;
DROP TABLE IF EXISTS Locations;
DROP TABLE IF EXISTS Pilots;
DROP TABLE IF EXISTS Sectors;

CREATE TABLE Sectors (
    SectorID INT PRIMARY KEY AUTO_INCREMENT,
    SectorName VARCHAR(55)
);

CREATE TABLE Pilots (
    PilotID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(55),
    LastName VARCHAR(55),
    SectorID INT,
    UserName VARCHAR(15),
    PasswordHash VARCHAR(25),
    FOREIGN KEY (SectorID) REFERENCES Sectors(SectorID)
);

CREATE TABLE Locations (
    LocationID INT PRIMARY KEY AUTO_INCREMENT,
    LocationName VARCHAR(100)
);

CREATE TABLE Organizations (
    OrgID INT PRIMARY KEY AUTO_INCREMENT,
    OrgName VARCHAR(100),
    OrgType VARCHAR(50)
);

CREATE TABLE DroneTypes (
    DroneTypeID INT PRIMARY KEY AUTO_INCREMENT,
    TypeName VARCHAR(50),
    DroneCategory VARCHAR(50)
);

CREATE TABLE Drones (
    DroneID INT PRIMARY KEY AUTO_INCREMENT,
    DroneName VARCHAR(100),
    DroneTypeID INT,
    FOREIGN KEY (DroneTypeID) REFERENCES DroneTypes(DroneTypeID)
);

CREATE TABLE Maintenances (
    MaintenanceID INT PRIMARY KEY AUTO_INCREMENT,
    DroneID INT,
	MaintenanceDate INT,
	MaintenanceDescription varchar(255),
    FOREIGN KEY (DroneID) REFERENCES Drones(DroneID)
);

CREATE TABLE Assignments (
   AssignmentID INT PRIMARY KEY AUTO_INCREMENT,
   AssignmentName VARCHAR(100),
   OrgID INT,
   LocationID INT,
   MissionDate DATE,
   MissionCompletion BOOLEAN, 
   MissionCompletionTime Date,
   Notes VARCHAR(255),
   DroneID INT,
   FlightTime TIME,
   PilotsID INT, 
    FOREIGN KEY (OrgID) REFERENCES Organizations(OrgID),
    FOREIGN KEY (LocationID) REFERENCES Locations(LocationID),
    FOREIGN KEY (DroneID) REFERENCES Drones(DroneID),
    FOREIGN KEY (PilotsID) REFERENCES Pilots(PilotID)
);

