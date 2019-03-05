SELECT * FROM tracks;
SELECT name, composer FROM tracks;
SELECT * FROM artists;

-- Display tracks that cost more than 0.99.
-- Sort from shortest to longest
SELECT track_id, name, composer, unit_price 
FROM tracks
WHERE unit_price > 0.99
ORDER BY milliseconds DESC;

-- Display tracks that have a composer
-- Only show track's id, name, composer, price
SELECT track_id, name, composer, unit_price
FROM tracks
WHERE composer IS NOT NULL;

-- Display tracks that have 'you' or 'day' in their name
SELECT * FROM tracks
WHERE name LIKE '%you%' OR name LIKE '%day%';

-- Display tracks composed by U2 that have 'you' or 'day' in their name
SELECT * FROM tracks
WHERE (name LIKE '%you%' OR name LIKE '%day%')
AND composer LIKE '%u2%';

SELECT * FROM albums;
SELECT * FROM artists;

-- JOIN albums & artists to see albums correspond to their artist
SELECT *
FROM albums
JOIN artists
	ON artists.artist_id = albums.artist_id;

-- Refine naming, alias
SELECT album_id, title AS album_title, name AS artist_name
FROM albums
JOIN artists
	ON artists.artist_id = albums.artist_id;

-- Display all jazz tracks
SELECT * FROM tracks
WHERE genre_id = 2;

-- Display all jazz tracks. 
-- Show track name, genre name, album title, artist name
SELECT tracks.name AS track_name, genres.name AS genre_name, albums.title AS album_title, artists.name AS artist_name FROM tracks
JOIN genres
	ON genres.genre_id = tracks.genre_id
JOIN albums
	ON albums.album_id = tracks.album_id
JOIN artists
	ON albums.artist_id = artists.artist_id
WHERE tracks.genre_id = 2;

SELECT * FROM genres;



