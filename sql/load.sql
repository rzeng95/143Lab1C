\! echo "\n-------------------------\n";
\! echo "Beginning data loading";

LOAD DATA LOCAL INFILE '~/data/movie.del' INTO TABLE Movie
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
\! echo "\nSuccessfully loaded movie.del";

LOAD DATA LOCAL INFILE '~/data/actor1.del' INTO TABLE Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
\! echo "\nSuccessfully loaded actor1.del";

LOAD DATA LOCAL INFILE '~/data/actor2.del' INTO TABLE Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
\! echo "\nSuccessfully loaded actor2.del";

LOAD DATA LOCAL INFILE '~/data/actor3.del' INTO TABLE Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
\! echo "\nSuccessfully loaded actor3.del";

LOAD DATA LOCAL INFILE '~/data/director.del' INTO TABLE Director
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
\! echo "\nSuccessfully loaded director.del";

LOAD DATA LOCAL INFILE '~/data/moviegenre.del' INTO TABLE MovieGenre
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
\! echo "\nSuccessfully loaded moviegenre.del";

LOAD DATA LOCAL INFILE '~/data/moviedirector.del' INTO TABLE MovieDirector
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
\! echo "\nSuccessfully loaded moviedirector.del";

LOAD DATA LOCAL INFILE '~/data/movieactor1.del' INTO TABLE MovieActor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
\! echo "\nSuccessfully loaded movieactor1.del";

LOAD DATA LOCAL INFILE '~/data/movieactor2.del' INTO TABLE MovieActor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
\! echo "\nSuccessfully loaded movieactor2.del";

INSERT INTO MaxPersonID VALUES(69000);
\! echo "\nSuccessfully inserted tuple (69000) into MaxPersonID";

INSERT INTO MaxMovieID VALUES(4750);
\! echo "\nSuccessfully inserted tuple (4750) into MaxMovieID";

\! echo "\nFinished loading all data";
\! echo "\n-------------------------\n";
