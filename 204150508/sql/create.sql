\! echo "\n\n-------------------------\n";
DROP DATABASE CS143;
\! echo "Wiped Database 143";
CREATE DATABASE CS143;
\! echo "Created new Database 143";
USE CS143;


/* Constraints:

    -Three PRIMARY KEY constraints
        1. Every movie has a unique id number
        2. Every actor has a unique id number
        3. Every director has a unique id number

    -Six referential integraity constraints
        1. MovieGenre mid references Movie id
        2. MovieDirector mid references Movie id
        3. MovieDirector did references Director id
        4. MovieActor mid references Movie id
        5. MovieAcctor aid references Actor id
        6. Review mid references Movie id

    -Three CHECK constraints
        1. Every movie must have a valid release year (year >= 0)
        2. Every actor must have a gender, which limits to just Male or Female
        3. Every review should have a rating in the range of 0-10

    -Other constraints
        1. Every movie must have a title
        2. Every actor must have a first name and a last name
        3. Every actor must have a DOB
        4. Every director must have a first name and a last name
        5. Every director must have a DOB
        6. Every mid in MovieGenre must not be NULL
        7. Every mid and did in MovieDirector must not be NULL
        8. Every mid and aid in MovieActor must not be NULL
        9. Every name and mid in Review must not be NULL


/*
Create Movie table
Movie(id, title, year, rating, company)
*/
CREATE TABLE Movie(
    id INT,               -- Movie ID
    title VARCHAR(100) NOT NULL,   -- Movie title
    year INT NOT NULL,             -- Release year
    rating VARCHAR(10),   -- MPAA rating
    company VARCHAR(50),   -- Production company
    PRIMARY KEY(id),
    CHECK(year >= 0)
) ENGINE=INNODB;

/*
Create Actor table
Actor(id, last, first, sex, dob, dod)
*/
CREATE TABLE Actor(
    id INT,               -- Actor ID
    last VARCHAR(20) NOT NULL,     -- Last name
    first VARCHAR(20) NOT NULL,    -- First name
    sex VARCHAR(6) NOT NULL,       -- Sex of the actor
    dob DATE NOT NULL,             -- Date of birth
    dod DATE,              -- Date of death
    PRIMARY KEY(id),
    CHECK(sex IN ('Male', 'Female'))
) ENGINE=INNODB;

/*
Create Director table
Director(id, last, first, dob, dod)
*/
CREATE TABLE Director(
    id INT,              -- Director ID
    last VARCHAR(20) NOT NULL,    -- Last name
    first VARCHAR(20) NOT NULL,   -- First name
    dob DATE NOT NULL,            -- Date of birth
    dod DATE,             -- Date of death
    PRIMARY KEY(id)
) ENGINE=INNODB;

/*
Create MovieGenre table
MovieGenre(mid, genre)
*/
CREATE TABLE MovieGenre(
    mid INT NOT NULL,             -- Movie ID
    genre VARCHAR(20),   -- Movie genre
    FOREIGN KEY(mid) references Movie(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;

/*
Create MovieDirector table
MovieDirector(mid, did)
*/
CREATE TABLE MovieDirector(
    mid INT NOT NULL,            -- Movie ID
    did INT NOT NULL,            -- Director ID
    FOREIGN KEY(mid) references Movie(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(did) references Director(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;

/*
Create MovieActor table
MovieActor(mid, aid, role)
*/
CREATE TABLE MovieActor(
    mid INT NOT NULL,           -- Movie ID
    aid INT NOT NULL,           -- Actor ID
    role VARCHAR(50),  -- Actor role in movie
    FOREIGN KEY(mid) references Movie(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(aid) references Actor(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;

/*
Create Review table
Review(name, time, mid, rating, comment)
*/
CREATE TABLE Review(
    name VARCHAR(20) NOT NULL,    -- Reviewer name
    time TIMESTAMP,      -- Review time
    mid INT NOT NULL,             -- Movie ID
    rating INT,          -- Review rating
    comment VARCHAR(500), -- Reviewer comment
    FOREIGN KEY(mid) references Movie(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CHECK(rating >= 0 AND rating <= 10)
) ENGINE=INNODB;

/*
Create MaxPersonID table
MaxPersonID(id)
*/
CREATE TABLE MaxPersonID(
    id INT    -- Max ID assigned to all persons
);

/*
Create MaxMovieID table
MaxMovieID(id)
*/
CREATE TABLE MaxMovieID(
    id INT    -- Max ID assigned to all movies
);


\! echo "Done creating tables";
\! echo "\n-------------------------\n";
