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
    CONSTRAINT FK_Videos_Channel FOREIGN KEY (idChannel) REFERENCES Channel(idChannel)
);

CREATE TABLE Roles (
    RoleID INT IDENTITY(1,1) PRIMARY KEY,
    RoleName NVARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE [Admin] (
    IDAdmin INT IDENTITY(1,1) PRIMARY KEY,
    Email NVARCHAR(100) NOT NULL UNIQUE,
    RoleID INT NOT NULL,
    CreatedAt DATETIME DEFAULT GETDATE(),
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

-- Users
INSERT INTO Users (Username, Email, Pass) VALUES
('admin', 'admin@mail.com','admin123'),
('Davin','davin@mail.com', '12345'),
('guess', 'guess@email.com', 'gues123');

-- Roles
INSERT INTO Roles (RoleName) VALUES 
('Manager'), ('Editor'), ('Admin'), ('Subtitle Editor'), ('Viewer');

-- Channel
INSERT INTO Channel (namaChannel, deskripsi, fotoProfil, channelType)
VALUES ('Dodo', 'Dodo si petualang', 'thumbnails/68343fdcd3cc7_Seoul.png', 0);

-- Videos (opsional jika butuh foreign key ID di komen/tonton)
-- INSERT INTO Videos (title, path, description, thumbnail, idChannel)
-- VALUES ('Video 1', 'uploads/video1.mp4', 'Deskripsi video 1', 'thumbnails/video1.jpg', 1);

-- Komen
INSERT INTO Komen (idVideo, idUser, tanggal, komen, isActive)
VALUES 
(1, 2, GETDATE(), 'Komentar panjang...', 1),
(1, 2, GETDATE(), 'Testing Komen', 1);
