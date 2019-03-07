-- Add album Fight On by the artist Spirit of Troy
SELECT * FROM albums;
INSERT INTO albums (title, artist_id)
VALUES ('Fight On', 276);

SELECT * FROM albums
ORDER BY album_id DESC;

-- Add an artist named Spirit of Troy
INSERT INTO artists (name)
VALUES ('Spirit of Troy');

SELECT * FROM artists
WHERE name LIKE '%spirit%';

-- Update track 'For Those About to Rock' to be part of the Fight On album
-- and composed by Tommy Trojan

UPDATE tracks
SET composer = 'Tommy Trojan', album_id = 348
-- WHERE name = 'I Love You'; 
WHERE track_id = 1;

SELECT * FROM tracks;

-- Delete 'Fast As a Shark'
DELETE FROM tracks
WHERE track_id = 3;

SELECT * FROM invoice_items;

-- Create a view that displays album and arists
CREATE OR REPLACE VIEW album_artists AS 
SELECT album_id, title, name
FROM albums
JOIN artists
	on artists.artist_id = albums.artist_id
ORDER BY artists.name DESC;
    
-- "Call" my view
SELECT * FROM album_artists;

-- How many tracks are there?
SELECT COUNT(track_id), COUNT(composer)
FROM tracks;

-- How many composers are there?
SELECT COUNT(composer)
FROM tracks;






