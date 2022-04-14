SET sql_notes = 0;	/* ignore warnings */
DROP SCHEMA IF EXISTS university_events;
CREATE SCHEMA university_events;
USE university_events;

/* university TABLE */
DROP TABLE IF EXISTS university;
CREATE TABLE university (
	univId int AUTO_INCREMENT,
    univName varchar(255) NOT NULL UNIQUE,
    univLocation varchar(255) NOT NULL UNIQUE,
    univDescription varchar(255) NOT NULL,
    univNumStudents int NOT NULL,
    univTag varchar(255) NOT NULL UNIQUE,
    univPicture varchar(64000), /* varchar(65535) is max, 65535-4(255)-4(2)=64507 */
    PRIMARY KEY (univId)
);
INSERT INTO university VALUES (NULL, 'University of Central Florida', 'Orlando, FL', 'The best university in Florida', 70406, '@knights.ucf.edu', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Ftwitter.com%2Fucf&psig=AOvVaw2Oxof7KR44x3kMWvx4K6gD&ust=1648864244888000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCJinmY7g8fYCFQAAAAAdAAAAABAG');
INSERT INTO university VALUES (NULL, 'University of Florida', 'Gainesville, FL', 'The school that lost to UCF Football this season', 34931, '@ufl.edu', 'data:image/png;base64,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');
INSERT INTO university VALUES (NULL, 'University of Miami', 'Miami, FL', 'The most expensive school in Florida', 20000, '@miami.edu', 'data:image/png;base64,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');

/* user TABLE */
DROP TABLE IF EXISTS user;
CREATE TABLE user (
	userId int AUTO_INCREMENT,
	fullName varchar(255) NOT NULL UNIQUE,
    univId int NOT NULL,
	email varchar(255) NOT NULL UNIQUE,
    username varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    roleId tinyint NOT NULL,
	PRIMARY KEY (userId),
    FOREIGN KEY (univId) REFERENCES university (univId)
);
    /*1*/   INSERT INTO user VALUES (NULL, 'Maxim Aldaranov', 1, 'maxim@knights.ucf.edu', 'maxim', 'password', 0);
    /*2*/   INSERT INTO user VALUES (NULL, 'Cameron Berezuk', 1, 'cameron@knights.ucf.edu', 'cameron', 'password', 0);
    /*3*/   INSERT INTO user VALUES (NULL, 'Chanxay Bounheuangviseth', 1, 'chanxay@knights.ucf.edu', 'chanxay', 'password', 0);

    /*4*/   INSERT INTO user VALUES (NULL, 'Karolina Britt', 2, 'karolina@ufl.edu', 'karolina', 'password', 1);
    /*5*/   INSERT INTO user VALUES (NULL, 'Glyn Ford', 3, 'glyn@miami.edu', 'glyn', 'password', 1);
    /*6*/   INSERT INTO user VALUES (NULL, 'Jorden Conroy', 1, 'jorden@knights.ucf.edu', 'jorden', 'password', 1);
    /*7*/   INSERT INTO user VALUES (NULL, 'Cillian Galindo', 2, 'cillian@ufl.edu', 'cillian', 'password', 1);
    /*8*/   INSERT INTO user VALUES (NULL, 'Raiden Hollis', 3, 'raiden@miami.edu', 'raiden', 'password', 1);

    /*9 */  INSERT INTO user VALUES (NULL, 'Ailsa Jacobson', 1, 'alisa@knights.ucf.edu', 'ailsa', 'password', 2);
    /*10*/  INSERT INTO user VALUES (NULL, 'Gilbert Sparrow', 2, 'gilbert@ufl.edu', 'gilbert', 'password', 2);
    /*11*/  INSERT INTO user VALUES (NULL, 'Korben Williamson', 3, 'korben@miami.edu', 'korben', 'password', 2);
    /*12*/  INSERT INTO user VALUES (NULL, 'Catrin Webster', 1, 'catrin@knights.ucf.edu', 'catrin', 'password', 2);
    /*13*/  INSERT INTO user VALUES (NULL, 'Benedict Parks', 2, 'benedict@ufl.edu', 'benedict', 'benedict', 2);

    /*14*/  INSERT INTO user VALUES (NULL, 'Anthony Carlson', 3, 'anthony@miami.edu', 'anthony', 'password', 2);
    /*15*/  INSERT INTO user VALUES (NULL, 'Milena Cohen', 1, 'milena@knights.ucf.edu', 'milena', 'password', 2);
    /*16*/  INSERT INTO user VALUES (NULL, 'Nikita Blackmore', 2, 'nikita@ufl.edu', 'nikita', 'password', 2);
    /*17*/  INSERT INTO user VALUES (NULL, 'Eddie Lim', 3, 'eddie@miami.edu', 'eddie', 'password', 2);
    /*18*/  INSERT INTO user VALUES (NULL, 'Leanna Power', 1, 'leanna@knights.ucf.edu', 'leanna', 'password', 2);

/* rso TABLE */
DROP TABLE IF EXISTS rso;
CREATE TABLE rso (
	rsoId int AUTO_INCREMENT,
    rso_active boolean NOT NULL,
    rsoName varchar(255) NOT NULL UNIQUE,
    ownerId int NOT NULL,
    univId int NOT NULL,
    PRIMARY KEY (rsoId),
    FOREIGN KEY (ownerId) REFERENCES admin (userId),
    FOREIGN KEY (univId) REFERENCES university (univId)
);
    INSERT INTO rso VALUES (NULL, true, 'Web Development', 6, 1);
    INSERT INTO rso VALUES (NULL, true, 'Ethical Hacking', 4, 1);
    INSERT INTO rso VALUES (NULL, true, 'Art', 8, 1);
    INSERT INTO rso VALUES (NULL, false, 'NFT Collectors', 5, 1);
    INSERT INTO rso VALUES (NULL, false, 'Cybersecurity', 7, 1);

    /* rso_members */
DROP TABLE IF EXISTS rso_members;
CREATE TABLE rso_members (
    rsoId int,
    userId int,
    PRIMARY KEY (rsoId, userId),
    FOREIGN KEY (rsoId) REFERENCES rso (rsoId),
    FOREIGN KEY (userId) REFERENCES user (userId)
);
    /* RSO: Web Development */
    INSERT INTO rso_members VALUES (1, 6);
    INSERT INTO rso_members VALUES (1, 9);
    INSERT INTO rso_members VALUES (1, 12);
    INSERT INTO rso_members VALUES (1, 15);
    INSERT INTO rso_members VALUES (1, 18);

    /* RSO: Ethical Hacking */
    INSERT INTO rso_members VALUES (2, 4);
    INSERT INTO rso_members VALUES (2, 10);
    INSERT INTO rso_members VALUES (2, 16);

    /* RSO: Art */

/* location TABLE */
DROP TABLE IF EXISTS location;
CREATE TABLE location (
    locationId int AUTO_INCREMENT,
    locationAddress varchar(255) NOT NULL,
    locationLatitude DECIMAL(10,8),
    locationLongitude DECIMAL(11,8),
    PRIMARY KEY (locationId, locationAddress)
);
    INSERT INTO location VALUES (NULL, '500 W Livingston St Orlando FL 32801', 28.54654355, -81.38628953);
    INSERT INTO location VALUES (NULL, '4000 Central Florida Blvd Orlando FL 32816', NULL, NULL);
    INSERT INTO location VALUES (NULL, '9907 Universal Blvd, Orlando, FL 32819', NULL, NULL);


/* event TABLEs */
DROP TABLE IF EXISTS event;
CREATE TABLE event (
	eventId int AUTO_INCREMENT,
    eventName varchar(255) NOT NULL UNIQUE,
    eventCategory varchar(255) NOT NULL,
    eventDescription varchar(255),
    eventDate date NOT NULL,
    eventTime int NOT NULL,
    eventLocationId int NOT NULL,
    eventContactPhone varchar(11) NOT NULL,
    eventContactEmail varchar(255) NOT NULL,
    eventUnivId int not NULL,
    eventPrivacy tinyint not NULL,
    eventRsoId int,
    PRIMARY KEY (eventId),
    FOREIGN KEY (eventUnivId) REFERENCES university (univId) ON DELETE CASCADE,
    FOREIGN KEY (eventLocationId) REFERENCES location (locationId) ON DELETE CASCADE,
    FOREIGN KEY (eventRsoId) REFERENCES rso (rsoId) ON DELETE CASCADE
);
    /* public events */
    INSERT INTO event VALUES (NULL, 'Student Orientation', 'Social Event', 'Orientation for freshman and transfer students.', '2022-4-1', 9, 2, '6582529256', 'admission@ucf.edu', 1, 0, NULL);
    INSERT INTO event VALUES (NULL, 'Unix Workshop', 'Workshop/Conference', 'Learn how to navigate UNIX with a terminal!', '2022-4-2', 12, 1, '5437158561 ', 'cs2@ucf.edu', 1, 0, NULL);
    INSERT INTO event VALUES (NULL, 'Hack Workshop', 'Workshop/Conference', 'Learn how to code defensively', '2022-4-1', 12, 3, '5437158123 ', 'hackucf@ucf.edu', 1, 0, NULL);
    INSERT INTO event VALUES (NULL, 'Art Festival', 'Entertainment', 'Street painting with chalk!', '2022-4-3', 12, 1, '5437158124 ', 'art@ucf.edu', 1, 0, NULL);
    INSERT INTO event VALUES (NULL, 'Music Concert', 'Entertainment', 'New artists performing at the concert!', '2022-4-2', 10, 2, '5437158126 ', 'concerts@ucf.edu', 1, 3, NULL);
    INSERT INTO event VALUES (NULL, 'School Tour', 'Social Event', 'Take a tour of the school', '2022-4-4', 12, 1, '5437158127 ', 'tours@ucf.edu', 1, 3, NULL);
    INSERT INTO event VALUES (NULL, 'Football Game', 'Sports', 'Watch the football game!', '2022-4-5', 12, 3, '5437158128 ', 'football@ucf.edu', 1, 3, NULL);

    /* private events */
    INSERT INTO event VALUES (NULL, 'Graduation 2022', 'Social Event', 'Congratulations, graduates of 2022!', '2022-4-3', 6, 2, '3326616984 ', 'ucf@knights.ucf.edu', 1, 1, NULL);
    INSERT INTO event VALUES (NULL, 'Movie Night', 'Entertainment', 'Come and watch movies with us!', '2022-4-4', 18, 1, '5886334570 ', 'ufl@ufl.edu', 1, 1, NULL);
    INSERT INTO event VALUES (NULL, 'Fight Club 2022', 'Entertainment', 'The first rule of Fight Club...', '2022-5-4', 18, 2, '1948375048 ', 'fight@ucf.edu', 1, 1, NULL);
    INSERT INTO event VALUES (NULL, 'Spear Fishing', 'Entertainment', 'We are going spear fishing at Lake Claire', '2022-6-4', 13, 3, '1539583720 ', 'spearfish@ucf.edu', 1, 1, NULL);
    INSERT INTO event VALUES (NULL, 'Tech Workshop', 'Workshop/Conference', 'Come learn about robot vision!', '2022-6-4', 6, 1, '3326616985 ', 'hack@knights.ucf.edu', 1, 1, NULL);
    INSERT INTO event VALUES (NULL, 'Spring Formal', 'Social Event', 'Connect with your peers while you dance!', '2022-7-4', 7, 3, '3310616985 ', 'sga@knights.ucf.edu', 1, 1, NULL);
    INSERT INTO event VALUES (NULL, 'Gardening Introduction', 'Workshop/Conference', 'Learn how to start your first garden.', '2022-8-4', 7, 1, '1029384756 ', 'gardening@knights.ucf.edu', 1, 1, NULL);

    INSERT INTO event VALUES (NULL, 'Graduation', 'Social Event', 'Congratulations, graduates of 2022!', '2022-4-3', 6, 2, '3326616984 ', 'ufl@ufl.edu', 2, 1, NULL);
    INSERT INTO event VALUES (NULL, 'Movie Night!', 'Entertainment', 'Come and watch movies with us!', '2022-4-4', 18, 1, '5886334570 ', 'ufl@ufl.edu', 2, 1, NULL);
    INSERT INTO event VALUES (NULL, 'Fight Club', 'Entertainment', 'The first rule of Fight Club...', '2022-5-4', 18, 2, '1948375048 ', 'fight@ufl.edu', 2, 1, NULL);

    /* RSO events */
    INSERT INTO event VALUES (NULL, 'MySql Database', 'Speaker/Lecture/Seminar', 'Come and learn about MySql Database!', '2022-4-4', 12, 3, '8418082225  ', 'webdev.club@ucf.edu', 1, 2, 1);
    INSERT INTO event VALUES (NULL, 'Hackathon', 'Workshop/Conference', 'Compete with the best.', '2022-4-4', 15, 1, '8418082225  ', 'cybersec.club@ucf.edu', 1, 2, 2);
    INSERT INTO event VALUES (NULL, 'Art Workshop', 'Workshop/Conference', 'Draw stuff.', '2022-4-4', 15, 2, '8418082226  ', 'art.club@ucf.edu', 1, 2, 3);
    INSERT INTO event VALUES (NULL, 'Art GBM', 'Workshop/Conference', 'Draw stuff', '2022-4-4', 15, 2, '8418082226  ', 'art.club@ucf.edu', 1, 2, 3);
    INSERT INTO event VALUES (NULL, 'Art Painting', 'Workshop/Conference', 'painting', '2022-4-4', 15, 3, '8418082226  ', 'art.club@ucf.edu', 1, 2, 3);
    INSERT INTO event VALUES (NULL, 'Art Drawing', 'Workshop/Conference', 'Drawing again', '2022-4-5', 15, 2, '8418082226  ', 'art.club@ucf.edu', 1, 2, 3);
    INSERT INTO event VALUES (NULL, 'Art Mapping', 'Workshop/Conference', 'Map and color', '2022-4-6', 15, 2, '8418082226  ', 'art.club@ucf.edu', 1, 2, 3);

    /* event_comment TABLE */
DROP TABLE IF EXISTS event_comment;
CREATE TABLE event_comment (
    commentId int AUTO_INCREMENT,
    comment_eventId int NOT NULL,
    comment_userName varchar(255) NOT NULL,
    comment_msg text NOT NULL,
    comment_datetime datetime NOT NULL,
    PRIMARY KEY (commentId),
    FOREIGN KEY (comment_eventId) REFERENCES event (eventId),
    FOREIGN KEY (comment_userName) REFERENCES user (username)
);

INSERT INTO event_comment VALUES (NULL, 1, 'chanxay', 'I loved this event!', '2022-04-04 22:21:35');
INSERT INTO event_comment VALUES (NULL, 2, 'cameron', 'What a great time', '2022-04-05 22:21:36');
INSERT INTO event_comment VALUES (NULL, 3, 'maxim', 'Lots of fun to be had', '2022-04-06 22:21:37');

    /* event_rating TABLE*/ 
    /* NOTE: this is just 1 rating instance from 1 user for 1 event */
DROP TABLE IF EXISTS event_rating;
CREATE TABLE event_rating (
    ratingId int AUTO_INCREMENT,
    ratingValue tinyint NOT NULL,
    rating_eventId int NOT NULL,
    PRIMARY KEY (ratingId),
    FOREIGN KEY (rating_eventId) REFERENCES event (eventId)
);
