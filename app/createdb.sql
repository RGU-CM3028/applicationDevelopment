CREATE TABLE IF NOT EXISTS Map (
  mapID DECIMAL NOT NULL PRIMARY KEY
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS MapCategoryColor (
  mapCategoryColorID DECIMAL NOT NULL PRIMARY KEY,
  categoryName VARCHAR(50),
  colorCode VARCHAR(300)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS GeoPoint (
  pointID DECIMAL NOT NULL PRIMARY KEY,
  pointType VARCHAR(50),
  pointDescription VARCHAR(300),
  coordinateX DECIMAL,
  coordinateY DECIMAL
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS GeoPath (
  pathID DECIMAL NOT NULL PRIMARY KEY,
  pathType VARCHAR(50),
  pathDescription VARCHAR(300),
  vectors VARCHAR(500)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS GeoArea (
  areaID DECIMAL NOT NULL PRIMARY KEY,
  areaType VARCHAR(50),
  areaDescription VARCHAR(300),
  vectors VARCHAR(500)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS Media (
  mediaID DECIMAL NOT NULL PRIMARY KEY,
  mediaType VARCHAR(50),
  mediaDescription VARCHAR(300),
  URL VARCHAR(50)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS HWEvent (
  HWEventID DECIMAL NOT NULL PRIMARY KEY,
  HWEventDate Date,
  HWEventDescription VARCHAR(300),
  localisation VARCHAR(50),
  mediaID DECIMAL,
  FOREIGN KEY (mediaID) REFERENCES Media(mediaID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS HWNews (
  HWNewsID DECIMAL NOT NULL PRIMARY KEY,
  HWNewsDate Date,
  HWNewsName VARCHAR(30),
  HWNewsText VARCHAR(1000)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS Club (
  clubID DECIMAL NOT NULL PRIMARY KEY,
  clubName VARCHAR(30),
  clubDescription VARCHAR(300),
  clubGenreID DECIMAL,
  eventID DECIMAL,
  mediaID DECIMAL,
  contactInfoID DECIMAL,
  FOREIGN KEY (clubGenreID) REFERENCES ClubGenre(clubGenreID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (eventID) REFERENCES ClubEvent(eventID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (mediaID) REFERENCES Media(mediaID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (contactInfoID) REFERENCES ContactInfo(contactInfoID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS ContactInfo (
  contactInfoID DECIMAL NOT NULL PRIMARY KEY,
  pname VARCHAR(30),
  adress VARCHAR(50),
  phone VARCHAR(20),
  email VARCHAR(30)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS Calendar (
  eventID DECIMAL NOT NULL,
  clubID DECIMAL NOT NULL,
  PRIMARY KEY (eventID, clubID),
  FOREIGN KEY (eventID) REFERENCES ClubEvent(eventID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (clubID) REFERENCES Club(clubID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS ClubEvent (
  eventID DECIMAL NOT NULL PRIMARY KEY,
  pdate Date,
  pdescription VARCHAR(300),
  localisation VARCHAR(50)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS ClubGenre (
  clubGenreID DECIMAL NOT NULL PRIMARY KEY,
  pname VARCHAR(30),
  localisation VARCHAR(50)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS WUser (
  userID DECIMAL NOT NULL PRIMARY KEY,
  displayName VARCHAR(30),
  email VARCHAR(30),
  userName VARCHAR(30),
  userPassword VARCHAR(20),
  levelCode DECIMAL,
  FOREIGN KEY (levelCode) REFERENCES AccessLevel(levelCode) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS AccessLevel (
  levelCode DECIMAL NOT NULL PRIMARY KEY,
  pdescription VARCHAR(300)
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS JunctionGeoPoint (
  mapID DECIMAL NOT NULL,
  pointID DECIMAL NOT NULL,
  PRIMARY KEY (mapID, pointID),
  FOREIGN KEY (mapID) REFERENCES Map(mapID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (pointID) REFERENCES GeoPoint(pointID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS JunctionGeoArea (
  mapID DECIMAL NOT NULL,
  areaID DECIMAL NOT NULL,
  PRIMARY KEY (mapID, areaID),
  FOREIGN KEY (mapID) REFERENCES Map(mapID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (areaID) REFERENCES GeoArea(areaID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS JunctionGeoPath (
  mapID DECIMAL NOT NULL,
  pathID DECIMAL NOT NULL,
  PRIMARY KEY (mapID, pathID),
  FOREIGN KEY (mapID) REFERENCES Map(mapID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (pathID) REFERENCES GeoPath(pathID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;

CREATE TABLE IF NOT EXISTS JunctionUserClub (
  userID DECIMAL NOT NULL,
  clubID DECIMAL NOT NULL,
  PRIMARY KEY (userID, clubID),
  FOREIGN KEY (userID) REFERENCES WUser(userID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (clubID) REFERENCES Club(clubID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = MYISAM ;
