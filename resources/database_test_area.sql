SET sql_notes = 0;	/* ignore warnings */
DROP SCHEMA IF EXISTS testing_events;
CREATE SCHEMA testing_events;
USE testing_events;

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
INSERT INTO user VALUES (NULL, 'RSO Owner', 1, 'rso_owner@knights.ucf.edu', 'rso_owner', 'password', 1);

/* rso TABLE */
DROP TABLE IF EXISTS rso;
CREATE TABLE rso (
	rsoId int AUTO_INCREMENT,
    rso_active boolean NOT NULL DEFAULT false,
    rsoName varchar(255) NOT NULL UNIQUE,
    ownerId int NOT NULL,
    PRIMARY KEY (rsoId),
    FOREIGN KEY (ownerId) REFERENCES admin (adminId)
);
INSERT INTO rso VALUES (NULL, true, 'RSO_1', 1);

    /* rso_members */
DROP TABLE IF EXISTS rso_member;
CREATE TABLE rso_member (
    rsoId int,
    userId int,
    PRIMARY KEY (rsoId, userId),
    FOREIGN KEY (rsoId) REFERENCES rso (rsoId),
    FOREIGN KEY (userId) REFERENCES user (userId)
);
INSERT INTO rso_member VALUES (1, 2);
INSERT INTO rso_member VALUES (1, 3);
INSERT INTO rso_member VALUES (1, 4);
INSERT INTO rso_member VALUES (1, 5);
INSERT INTO rso_member VALUES (1, 6);

DELIMITER $$;

CREATE TRIGGER RSOStatusUpdateActive
    AFTER INSERT ON rso_members
 FOR EACH ROW BEGIN
  IF ((SELECT COUNT(*) FROM rso_members M WHERE M.rsoId = NEW.rsoId) > 1)
        THEN
           UPDATE rso
           SET rso_active = 1
          WHERE rsoId = NEW.rsoId
  END IF;
 END $$
DELIMITER ;