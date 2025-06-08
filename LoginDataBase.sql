USE Tubes;
GO


DROP TABLE IF EXISTS Tonton;
DROP TABLE IF EXISTS Komen;
DROP TABLE IF EXISTS Subscribe;
DROP TABLE IF EXISTS Videos;
DROP TABLE IF EXISTS [Admin];
DROP TABLE IF EXISTS Channel;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Roles;
GO

CREATE TABLE Users (
    idUser INT IDENTITY(1,1) PRIMARY KEY,
    Username NVARCHAR(100),
    Email NVARCHAR(100) UNIQUE,
    Pass NVARCHAR(255),
    fotoProfil VARCHAR(255) DEFAULT 'Assets/NoProfile.jpg'
);

CREATE TABLE Channel (
    idChannel INT PRIMARY KEY IDENTITY(1,1),
    namaChannel VARCHAR(100) NOT NULL,
    deskripsi VARCHAR(500),
    fotoProfil VARCHAR(255) DEFAULT 'Assets/NoProfile.jpg',
    channelType TINYINT NOT NULL
);

CREATE TABLE Videos (
    idVideo INT PRIMARY KEY IDENTITY(1,1),
    title VARCHAR(100),
    path VARCHAR(255),
    uploaded_at DATETIME DEFAULT GETDATE(),
    description VARCHAR(500),
    thumbnail VARCHAR(255),
    idChannel INT,
	isActive bit DEFAULT 1,
    CONSTRAINT FK_Videos_Channel FOREIGN KEY (idChannel) REFERENCES Channel(idChannel)
);

CREATE TABLE Roles (
    idRole INT IDENTITY(1,1) PRIMARY KEY,
    RoleName NVARCHAR(50) NOT NULL UNIQUE
);


CREATE TABLE Admin (
    idUser INT NOT NULL,
    idChannel INT NOT NULL,
    idRole INT NOT NULL,
    IsActive TINYINT NOT NULL DEFAULT 1,
    CreatedAt DATETIME DEFAULT GETDATE(),
    PRIMARY KEY (idUser, idChannel),
    FOREIGN KEY (idUser) REFERENCES Users(idUser),
    FOREIGN KEY (idChannel) REFERENCES Channel(idChannel),
    FOREIGN KEY (idRole) REFERENCES Roles(idRole)
);


CREATE TABLE Komen (
    idKomen INT PRIMARY KEY IDENTITY(1,1),
    idVideo INT FOREIGN KEY REFERENCES Videos(idVideo),
    idUser INT FOREIGN KEY REFERENCES Users(idUser),
    tanggal DATETIME DEFAULT GETDATE(),
    komen NVARCHAR(4000),
    isActive BIT NOT NULL
);
CREATE TABLE Tonton (
    idVideo INT NOT NULL,
    idUser INT NOT NULL,
    tanggal DATETIME NOT NULL DEFAULT GETDATE(),
    lamaMenonton INT NOT NULL DEFAULT 0,
    jumlahTonton INT NOT NULL DEFAULT 1,
    likeDislike TINYINT NULL,
    PRIMARY KEY (idVideo, idUser),
    FOREIGN KEY (idVideo) REFERENCES Videos(idVideo),
    FOREIGN KEY (idUser) REFERENCES Users(idUser)
);

CREATE TABLE Subscribe (
    idChannel INT NOT NULL,
    idUser INT NOT NULL,
    tanggalSubscribe DATETIME DEFAULT GETDATE(),
    isActive BIT NOT NULL,
    PRIMARY KEY (idChannel, idUser),
    FOREIGN KEY (idChannel) REFERENCES Channel(idChannel),
    FOREIGN KEY (idUser) REFERENCES Users(idUser)
);

CREATE TABLE Subtitle (
    idSubtitle INT IDENTITY(1,1) PRIMARY KEY,
    idVideo INT NOT NULL,
    waktuMuncul TIME NOT NULL,
    waktuSelesai TIME NOT NULL,
    isiTeks NVARCHAR(MAX) NOT NULL,
    FOREIGN KEY (idVideo) REFERENCES Videos(idVideo)
)
-- User: idUser
CREATE CLUSTERED INDEX PK_User_idUser
ON Users(idUser);

-- Channel: idChannel
CREATE CLUSTERED INDEX PK_Channel_idChannel
ON Channel(idChannel);

-- Videos: idVideo
CREATE CLUSTERED INDEX PK_Videos_idVideo
ON Videos(id);

-- Roles: idRole
CREATE CLUSTERED INDEX PK_Roles_idRole
ON Roles(idRole);

-- Admin: composite(idUser, idChannel, idRole)
CREATE NONCLUSTERED INDEX IX_Admin_idUser_idChannel_idRole
ON Admin(idUser, idChannel, idRole);

-- Komen: idKomen
CREATE CLUSTERED INDEX PK_Komen_idKomen
ON Komen(idKomen);

-- Tonton: composite(idVideo, idUser)
CREATE NONCLUSTERED INDEX IX_Tonton_idVideo_idUser
ON Tonton(idVideo, idUser);

-- Subscribe: composite(idChannel, idUser)
CREATE NONCLUSTERED INDEX IX_Subscribe_idChannel_idUser
ON Subscribe(idChannel, idUser);


--Index Bitmap
-- Channel: channelType
CREATE NONCLUSTERED INDEX IX_Channel_channelType
ON Channel(channelType);

-- Videos: idChannel, isActive
CREATE NONCLUSTERED INDEX IX_Videos_idChannel_isActive
ON Videos(idChannel, isActive);

-- Admin: idChannel
CREATE NONCLUSTERED INDEX IX_Admin_idChannel
ON Admin(idChannel);

-- Komen: idUser, idVideo, isActive
CREATE NONCLUSTERED INDEX IX_Komen_idUser_idVideo_isActive
ON Komen(idUser, idVideo, isActive);

-- Tonton: idUser, idVideo, likeDislike
CREATE NONCLUSTERED INDEX IX_Tonton_idUser_idVideo_likeDislike
ON Tonton(idUser, idVideo, likeDislike);

-- Subscribe: idChannel, idUser, isActive
CREATE NONCLUSTERED INDEX IX_Subscribe_idChannel_idUser_isActive
ON Subscribe(idChannel, idUser, isActive);


-- Users
INSERT INTO Users (Username, Email, Pass) VALUES
('admin', 'admin@mail.com','admin123'),
('Davin','davin@mail.com', '12345'),
('guess', 'guess@email.com', 'gues123');

-- Roles
INSERT INTO Roles (RoleName) VALUES 
('Owner'), ('Manager'), ('Editor'), ('Admin'), ('Subtitle Editor'), ('Viewer');

-- Channel
INSERT INTO Channel (namaChannel, deskripsi, fotoProfil, channelType)
VALUES ('Dodo', 'Dodo si petualang', 'thumbnails/68343fdcd3cc7_Seoul.png', 0);

-- Videos 
INSERT INTO Videos (title, path, description, thumbnail, idChannel)
VALUES ('Seoul', 'Assets/Seoul.mp4', 'Ini Kota Seoul', 'Assets/Seoul.png', 1);

-- Komen
INSERT INTO Komen (idVideo, idUser, tanggal, komen, isActive)
VALUES 
(1, 2, GETDATE(), 'Komentar panjang...', 1),
(1, 2, GETDATE(), 'Testing Komen', 1);

SELECT * 
FROM [Admin]
RIGHT JOIN Users 
ON Admin.UserID = Users.Id 
WHERE 
Email = 'shopee@mail.com' 
DELETE FROM Users WHERE id = 5
SELECT * FROM users
SELECT * FROM Channel
SELECT * FROM [Admin] CROSS JOIN users 
SELECT * FROM Videos WHERE idChannel = 3 AND isActive = 1 
SELECT * FROM Tonton
SELECT * FROM Roles
SELECT * FROM Subscribe

SELECT A.ChannelID
        FROM Admin A
        WHERE  RoleID = 1 OR RoleID = 2) 

SELECT C.namaChannel, c.deskripsi, c.fotoProfil, u.Email FROM
Users U INNER JOIN [Admin] A
ON A.UserID = U.Id
INNER JOIN Channel C
ON C.idChannel = A.ChannelID

INSERT INTO [Admin] (UserID, ChannelID, RoleID, IsActive, CreatedAt)
VALUES (2, 3, 1, 1, GETDATE())

INSERT INTO [Admin] (UserID, ChannelID, RoleID, IsActive, CreatedAt)
VALUES(4, 4, 1 , 1, GETDATE())


SELECT TOP 10 V.id, V.title, V.thumbnail, V.uploaded_at 
FROM Videos V
INNER JOIN Channel C ON V.idChannel = C.idChannel
INNER JOIN Admin A ON C.idChannel = A.ChannelID
INNER JOIN Users U ON A.UserID = U.id
WHERE U.id = 2
ORDER BY V.uploaded_at DESC

ALTER TABLE VIDEOS 
ADD isActive BIT DEFAULT 1

UPDATE Videos 
SET isActive = 1
WHERE id = 3

SELECT * 
FROM Videos 
INNER JOIN Komen 
ON Komen.idVideo = Videos.id
WHERE Videos.id = 2

SELECT
    K.idKomen,
    K.komen,
    K.tanggal,
    V.id AS videoId,
    V.title AS videoTitle,
    V.thumbnail,
    V.uploaded_at,
    V.idChannel,
    U.Username AS userUsername,
    U.fotoProfil AS userFotoProfil
FROM Komen K
JOIN Videos V ON K.idVideo = V.id
JOIN Users U ON K.idUser = U.Id
WHERE K.isActive = 1 
ORDER BY tanggal ASC

SELECT * FROM Admin ORDER BY tanggal ASC

SELECT
    V.id AS videoId,
    V.title AS videoTitle,
    V.thumbnail,
    V.uploaded_at,
    V.idChannel
FROM Videos V 
WHERE V.id = ?


SELECT A.ChannelID, A.UserID
FROM Channel C 
INNER JOIN Admin A ON C.idChannel = A.ChannelID
INNER JOIN Users U ON A.UserID = U.id

WHERE U.id = 2
ORDER BY V.uploaded_at DESC


SELECT A.ChannelID
        FROM Admin A
        WHERE A.UserID = 2


UPDATE Admin 
SET status = 1 WHERE RoleID = 1
SELECT * FROM admin

UPDATE ADMIN SET IsActive = 2 WHERE UserID=1

ALTER TABLE [ADMIN]
DROP CONSTRAINT DF__Admin__IsActive__69FBBC1F
ALTER TABLE [Admin]
ALTER COLUMN isActive TINYINT
--1 untuk active, 2 untuk inactive, 3 untuk invited

ALTER TABLE [Admin]
DROP COLUMN isAccepted

ALTER TABLE [Admin]
DROP CONSTRAINT DF__Admin__isAccepte__19AACF41;

SELECT * FROM Admin

EXEC sp_rename 'Videos.idVideos',  'idVideo', 'COLUMN';

SELECT 
		C.namaChannel, 
        C.fotoProfil, 
		R.RoleName,
        U.Email,
        A.idChannel
        FROM Users U
        INNER JOIN [Admin] A ON A.idUser = U.idUser
        INNER JOIN Channel C ON C.idChannel = A.idChannel
		INNER JOIN Roles R on A.idRole = R.idRole
		WHERE A.idUser = 9 AND IsActive = 2 AND C.channelType = 1

SELECT idChannel FROM Admin WHERE idUser = 9

SELECT U.idUser AS UserID
        FROM Users U
        WHERE U.Email = 'bukalapak@mail.com';

SELECT * FROM Roles

UPDATE Admin SET IsActive = 2 
WHERE idUser = 13

SELECT A.idUser, C.namaChannel, C.fotoProfil, R.RoleName
FROM [Admin] A
JOIN Channel C ON A.idChannel = C.idChannel
JOIN Roles R ON A.idRole = R.idRole
WHERE A.idUser = 13 AND A.IsActive = 2 AND C.channelType = 1


SELECT * 
FROM Admin A 
RIGHT JOIN Users U ON A.idUser = U.idUser 
WHERE A.idUser IS NULL

SELECT U.fotoProfil, U.Username, R.RoleName
                    FROM Admin A
                    INNER JOIN Users U ON A.idUser = U.idUser
                    INNER JOIN Roles R ON A.idRole = R.idRole
                    WHERE A.idRole = (SELECT idRole FROM Admin WHERE idUser = 14)
                    AND A.IsActive = 2

SELECT U.fotoProfil, U.Username, R.RoleName
                    FROM Admin A
                    INNER JOIN Users U ON A.idUser = U.idUser
                    INNER JOIN Roles R ON A.idRole = R.idRole
                    WHERE A.idChannel = (SELECT idChannel FROM Admin WHERE idUser = 9)
                    AND A.IsActive = 2

SELECT 
            C.namaChannel, 
            C.deskripsi, 
            C.fotoProfil, 
            U.Email,
            A.idChannel,
            R.RoleName
        FROM Users U
        INNER JOIN [Admin] A ON A.idUser = U.idUser
        INNER JOIN Channel C ON C.idChannel = A.idChannel
        INNER JOIN Roles R ON R.idRole = A.idRole
        WHERE U.idUser = 13 AND isActive = 1

SELECT * FROM users
SELECT 
            C.fotoProfil, 
            A.idChannel
			FROM Users U
        INNER JOIN [Admin] A ON A.idChannel = U.idUser
        INNER JOIN Channel C ON C.idChannel = A.idChannel
        WHERE U.idUser = 11

	SELECT 1 FROM Tonton WHERE idVideo = 99 AND idUser = 9

	SELECT * FROM Subscribe WHERE idChannel = 11 AND isActive = 1

	SELECT COUNT(idUser) as count FROM Subscribe WHERE idChannel= 11 AND isActive = 1

	SELECT COUNT(*) as count FROM Subscribe WHERE idUser = 9 AND idChannel = 11 AND isActive = 1
	SELECT * FROM Tonton
	SELECT ISNULL(SUM(jumlahTonton), 0) AS jumlahView FROM Tonton WHERE idVideo = 16

	SELECT COUNT(*) AS total_comments FROM Komen WHERE idVideo = 16