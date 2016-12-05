DROP TABLE Map;
DROP TABLE MapCategoryColor;
DROP TABLE GeoPoint;
DROP TABLE AccessLevel;
DROP TABLE Calendar;
DROP TABLE Club;
DROP TABLE ClubEvent;
DROP TABLE ClubGenre;
DROP TABLE ContactInfo;
DROP TABLE GeoArea;
DROP TABLE GeoPath;
DROP TABLE HWEvent;
DROP TABLE HWNEws;
DROP TABLE JunctionGeoArea;
DROP TABLE JunctionGeoPath;
DROP TABLE JunctionGeoPoint;
DROP TABLE JunctionUserClub;
DROP TABLE Media;
DROP TABLE Wuser;

CREATE TABLE IF NOT EXISTS MapCategoryColor (
  mapCategoryColorID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  categoryName VARCHAR(50),
  colorCode VARCHAR(300)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS GeoPoint (
  pointID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pointType VARCHAR(50),
  pointDescription VARCHAR(300),
  coordinateX INTEGER,
  coordinateY INTEGER
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS GeoPath (
  pathID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pathType VARCHAR(50),
  pathDescription VARCHAR(300),
  vectors VARCHAR(500)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS GeoArea (
  areaID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  areaType VARCHAR(50),
  areaDescription VARCHAR(300),
  vectors VARCHAR(500)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS Media (
  mediaID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  mediaType VARCHAR(50),
  mediaDescription VARCHAR(300),
  URL VARCHAR(50)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS HWEvent (
  HWEventID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  HWEventDate Date,
  HWEventDescription VARCHAR(300),
  localisation VARCHAR(50),
  mediaID INTEGER,
  FOREIGN KEY (mediaID) REFERENCES Media(mediaID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS HWNews (
  HWNewsID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  HWNewsDate Date,
  HWNewsName VARCHAR(30),
  HWNewsText VARCHAR(1000)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS Club (
  clubID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  clubName VARCHAR(200),
  clubDescription VARCHAR(300),
  clubGenreID INTEGER,
  eventID INTEGER,
  mediaID INTEGER,
  contactInfoID INTEGER,

  name VARCHAR(30),
  adress VARCHAR(50),
  phone VARCHAR(20),
  email VARCHAR(30)

  FOREIGN KEY (clubGenreID) REFERENCES ClubGenre(clubGenreID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (eventID) REFERENCES ClubEvent(eventID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (mediaID) REFERENCES Media(mediaID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (contactInfoID) REFERENCES ContactInfo(contactInfoID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS ContactInfo (
  contactInfoID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS Calendar (
  eventID INTEGER NOT NULL,
  clubID INTEGER NOT NULL,
  PRIMARY KEY (eventID, clubID),
  FOREIGN KEY (eventID) REFERENCES ClubEvent(eventID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (clubID) REFERENCES Club(clubID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS ClubEvent (
  eventID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pdate Date,
  pdescription VARCHAR(300),
  localisation VARCHAR(50)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS ClubGenre (
  clubGenreID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pname VARCHAR(30),
  localisation VARCHAR(50)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS WUser (
  userID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  displayName VARCHAR(30),
  email VARCHAR(30),
  userName VARCHAR(30),
  userPassword VARCHAR(500),
  levelCode INTEGER,
  FOREIGN KEY (levelCode) REFERENCES AccessLevel(levelCode) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS AccessLevel (
  levelCode INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pdescription VARCHAR(300)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS JunctionUserClub (
  userID INTEGER NOT NULL,
  clubID INTEGER NOT NULL,
  PRIMARY KEY (userID, clubID),
  FOREIGN KEY (userID) REFERENCES WUser(userID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (clubID) REFERENCES Club(clubID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;
