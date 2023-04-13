-- Gebruikers
CREATE TABLE Gebruikers
(
    GebruikerID    INTEGER AUTO_INCREMENT PRIMARY KEY,
    Naam           VARCHAR(50)         NOT NULL,
    Achternaam     VARCHAR(50)         NOT NULL,
    Geboortedatum  DATE                NOT NULL,
    Email          VARCHAR(100) UNIQUE NOT NULL,
    Telefoonnummer VARCHAR(20)         NOT NULL,
    Wachtwoord     VARCHAR(255)        NOT NULL,
    Rol            ENUM ('student', 'docent', 'beheerder')
);

-- Opleidingen
CREATE TABLE Opleidingen
(
    OpleidingID  INTEGER AUTO_INCREMENT PRIMARY KEY,
    Naam         VARCHAR(100) NOT NULL,
    Beschrijving TEXT         NOT NULL
);

-- Studiejaar
CREATE TABLE Studiejaar
(
    StudiejaarID INTEGER AUTO_INCREMENT PRIMARY KEY,
    Jaar         INTEGER NOT NULL,
    Startdatum   DATE    NOT NULL,
    Einddatum    DATE    NOT NULL
);

-- Student_Opleiding
CREATE TABLE Student_Opleiding
(
    StudentID      INTEGER NOT NULL,
    OpleidingID    INTEGER NOT NULL,
    StudiejaarID   INTEGER NOT NULL,
    Inschrijfdatum DATE    NOT NULL,
    PRIMARY KEY (StudentID, OpleidingID),
    FOREIGN KEY (StudentID) REFERENCES Gebruikers (GebruikerID),
    FOREIGN KEY (OpleidingID) REFERENCES Opleidingen (OpleidingID),
    FOREIGN KEY (StudiejaarID) REFERENCES Studiejaar (StudiejaarID)
);

-- Courses
CREATE TABLE Courses
(
    CourseID     INTEGER AUTO_INCREMENT PRIMARY KEY,
    OpleidingID  INTEGER      NOT NULL,
    Naam         VARCHAR(100) NOT NULL,
    Beschrijving TEXT         NOT NULL,
    FOREIGN KEY (OpleidingID) REFERENCES Opleidingen (OpleidingID)
);

-- Vakken
CREATE TABLE Vakken
(
    VakID        INTEGER AUTO_INCREMENT PRIMARY KEY,
    CourseID     INTEGER      NOT NULL,
    Naam         VARCHAR(100) NOT NULL,
    Beschrijving TEXT         NOT NULL,
    FOREIGN KEY (CourseID) REFERENCES Courses (CourseID)
);

-- Docenten_Vakken
CREATE TABLE Docenten_Vakken
(
    DocentID INTEGER NOT NULL,
    VakID    INTEGER NOT NULL,
    PRIMARY KEY (DocentID, VakID),
    FOREIGN KEY (DocentID) REFERENCES Gebruikers (GebruikerID),
    FOREIGN KEY (VakID) REFERENCES Vakken (VakID)
);

-- Tentamens
CREATE TABLE Tentamens
(
    TentamenID INTEGER AUTO_INCREMENT PRIMARY KEY,
    VakID      INTEGER      NOT NULL,
    Naam       VARCHAR(100) NOT NULL,
    Datum      DATE         NOT NULL,
    Tijd       TIME         NOT NULL,
    Locatie    VARCHAR(100) NOT NULL,
    Tijdsduur  INTEGER      NOT NULL,
    FOREIGN KEY (VakID) REFERENCES Vakken (VakID)
);

-- Tentamenpogingen
CREATE TABLE Tentamenpogingen
(
    PogingID     INTEGER AUTO_INCREMENT PRIMARY KEY,
    StudentID    INTEGER    NOT NULL,
    TentamenID   INTEGER    NOT NULL,
    PogingNummer INTEGER    NOT NULL,
    Cijfer       VARCHAR(2) NOT NULL,
    FOREIGN KEY (StudentID) REFERENCES Gebruikers (GebruikerID),
    FOREIGN KEY (TentamenID) REFERENCES Tentamens (TentamenID)
);

-- Groepen
CREATE TABLE Groepen
(
    GroepID INTEGER AUTO_INCREMENT PRIMARY KEY,
    VakID   INTEGER      NOT NULL,
    Naam    VARCHAR(100) NOT NULL,
    FOREIGN KEY (VakID) REFERENCES Vakken (VakID)
);

-- Studenten_Groepen
CREATE TABLE Studenten_Groepen
(
    StudentID INTEGER NOT NULL,
    GroepID   INTEGER NOT NULL,
    PRIMARY KEY (StudentID, GroepID),
    FOREIGN KEY (StudentID) REFERENCES Gebruikers (GebruikerID),
    FOREIGN KEY (GroepID) REFERENCES Groepen (GroepID)
);

-- Student_Begeleider
CREATE TABLE Student_Begeleider
(
    StudentID INTEGER NOT NULL,
    DocentID  INTEGER NOT NULL,
    PRIMARY KEY (StudentID, DocentID),
    FOREIGN KEY (StudentID) REFERENCES Gebruikers (GebruikerID),
    FOREIGN KEY (DocentID) REFERENCES Gebruikers (GebruikerID)
);

-- Inschrijvingen_Courses
CREATE TABLE Inschrijvingen_Courses
(
    StudentID       INTEGER NOT NULL,
    CourseID        INTEGER NOT NULL,
    Inschrijfdatum  DATE    NOT NULL,
    Uitschrijfdatum DATE    NOT NULL,
    PRIMARY KEY (StudentID, CourseID),
    FOREIGN KEY (StudentID) REFERENCES Gebruikers (GebruikerID),
    FOREIGN KEY (CourseID) REFERENCES Courses (CourseID)
);