-- 3 PRIMARY KEY constraints
INSERT INTO Movie VALUES(3, 'TEST', 2016, 'TEST', 'TEST');

INSERT INTO Actor VALUES(1, 'TEST', 'TEST', 'Male', 19880808, NULL);

INSERT INTO Director VALUES(16, 'TEST', 'TEST', 19880808, NULL);

-- 6 referential integrity constraints
DELETE FROM Movie
WHERE id = 3;

DELETE FROM Actor
WHERE id = 597;

DELETE FROM Director
WHERE id = 577;

-- 3 CHECK constraints
UPDATE Movie
SET year = -2
WHERE id = 3;

UPDATE Actor
SET sex='M'
WHERE id = 1;

INSERT INTO Review VALUES('TEST', 20161017, 3, 11, NULL);

-- Other constraints
	-- 1.
	INSERT INTO Movie VALUES(1, NULL, 2016, NULL, NULL);

	-- 2.
	INSERT INTO Actor VALUES(1, NULL, NULL, 'Male', 19880808, NULL);

	-- 3.
	INSERT INTO Actor VALUES(1, 'TEST', 'TEST', 'Male', NULL, NULL);

	-- 4.
	INSERT INTO Director VALUES(16, NULL, NULL, 19880808, NULL);

	-- 5.
	INSERT INTO Director VALUES(16, 'TEST', 'TEST', NULL, NULL);

	-- 6.
	INSERT INTO MovieGenre VALUES(NULL, 'TEST');

	-- 7.
	INSERT INTO MovieDirector VALUES(NULL, NULL);

	-- 8.
	INSERT INTO MovieActor VALUES(NULL,NULL,'TEST');

	-- 9.
	INSERT INTO Review VALUES(NULL,20161017,NULL,'TEST','TEST');