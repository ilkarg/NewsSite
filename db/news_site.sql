CREATE TABLE IF NOT EXISTS `comments` (
    id INTEGER PRIMARY KEY,
    login TEXT,
    publication_time TEXT,
    text TEXT,
    post_id INTEGER
);

CREATE TABLE IF NOT EXISTS `posts` (
    id INTEGER PRIMARY KEY,
    title TEXT,
    body TEXT,
    tag TEXT,
    publication_time TEXT,
    image TEXT
);

CREATE TABLE IF NOT EXISTS `users` (
    id INTEGER PRIMARY KEY,
    login TEXT,
    password TEXT
);