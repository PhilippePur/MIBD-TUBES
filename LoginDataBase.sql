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
    Id INT IDENTITY(1,1) PRIMARY KEY,
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
    id INT PRIMARY KEY IDENTITY(1,1),
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
    RoleID INT IDENTITY(1,1) PRIMARY KEY,
    RoleName NVARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Admin (
    UserID INT NOT NULL,
    ChannelID INT NOT NULL,
    RoleID INT NOT NULL,
    IsActive BIT NOT NULL DEFAULT 1,
    CreatedAt DATETIME DEFAULT GETDATE(),
    
    PRIMARY KEY (UserID, ChannelID),
    
    FOREIGN KEY (UserID) REFERENCES Users(Id),
    FOREIGN KEY (ChannelID) REFERENCES Channel(idChannel),
    FOREIGN KEY (RoleID) REFERENCES Roles(RoleID)
);


CREATE TABLE Komen (
    idKomen INT PRIMARY KEY IDENTITY(1,1),
    idVideo INT FOREIGN KEY REFERENCES Videos(id),
    idUser INT FOREIGN KEY REFERENCES Users(id),
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
    FOREIGN KEY (idVideo) REFERENCES Videos(id),
    FOREIGN KEY (idUser) REFERENCES Users(id)
);

CREATE TABLE Subscribe (
    idChannel INT NOT NULL,
    idUser INT NOT NULL,
    tanggalSubscribe DATETIME DEFAULT GETDATE(),
    isActive BIT NOT NULL,
    PRIMARY KEY (idChannel, idUser),
    FOREIGN KEY (idChannel) REFERENCES Channel(idChannel),
    FOREIGN KEY (idUser) REFERENCES Users(Id)
);

CREATE TABLE Subtitle (
    idSubtitle INT IDENTITY(1,1) PRIMARY KEY,
    idVideo INT NOT NULL,
    waktuMuncul TIME NOT NULL,
    waktuSelesai TIME NOT NULL,
    isiTeks NVARCHAR(MAX) NOT NULL,
    FOREIGN KEY (idVideo) REFERENCES Videos(id)
)

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

ALTER TABLE VIDEOS 
ADD isActive BIT DEFAULT 1

UPDATE Videos 
SET isActive = 1
WHERE id = 3

SELECT TOP 10 V.id, V.title, V.thumbnail, V.uploaded_at 
FROM Videos V
INNER JOIN Channel C ON V.idChannel = C.idChannel
INNER JOIN Admin A ON C.idChannel = A.ChannelID
INNER JOIN Users U ON A.UserID = U.id
WHERE U.id = 2
ORDER BY V.uploaded_at DESC

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

SELECT * FROM Komen ORDER BY tanggal ASC

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