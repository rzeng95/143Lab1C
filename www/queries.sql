\! echo "\n-------------------------\n";
\! echo "Beginning data querying";


/*
	Give the names of all the actors in the movie 'Die Another Day'

	Join Actor, MovieActor and Movie tables then select tuples which
	have same actor id, movie id and the movie title is 'Die Another Day'.
	From the tuples we selected, we concatenate their first name and last name,
	separated by single space.

*/

SELECT CONCAT(first, ' ',last)
FROM Actor as s1, MovieActor as s2, Movie as s3
WHERE s1.id=s2.aid AND s2.mid=s3.id AND s3.title='Die Another Day';

\! echo "\nSuccessful query 1";

/*
	Give the count of all the actors who acted in multiple movies
*/

SELECT COUNT(*)
FROM (
	SELECT aid
	FROM MovieActor
	GROUP BY aid
	HAVING COUNT(aid) > 1
) InnerQuery;

\! echo "\nSuccessful query 2";


/*
	Give the names of all the movies that have more than one genre

	Join MovieGenre table with itself then select the tuples which have
	the same movie id but have different movie genres. Then select titles
	in Movie where their ids are in the set of previous selected tuples.
*/

SELECT title
FROM Movie as s1
JOIN (
	SELECT mid
	FROM MovieGenre
	GROUP BY mid
	HAVING COUNT(mid) > 1
) InnerQuery
WHERE s1.id = InnerQuery.mid;

\! echo "\nSuccessful query 3";
