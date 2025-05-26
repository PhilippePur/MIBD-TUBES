 USE Tubes;
GO
CREATE TABLE users (
    Id INT IDENTITY(1,1) PRIMARY KEY,
    Username NVARCHAR(100),
    Email NVARCHAR(100) UNIQUE,	
    Pass NVARCHAR(255)
)


INSERT INTO users
VALUES ('admin', 'admin@mail.com','admin123');

INSERT INTO users
VALUES ('Davin','davin@mail.com', '12345');

CREATE TABLE Channel (
    idChannel INT PRIMARY KEY IDENTITY(1,1),
    namaChannel VARCHAR(100) NOT NULL,	--nama
    deskripsi VARCHAR(500),				--deskripsi
    fotoProfil VARCHAR(255),			-- path ke foto profil
    channelType TINYINT NOT NULL		-- 0 untuk individu, 1 untuk grup
);


CREATE TABLE Videos (
    id INT PRIMARY KEY IDENTITY(1,1), --identifier video 
    title VARCHAR(100),         -- Judul/nama video
    path VARCHAR(255),          -- Path file video (misal: uploads/video1.mp4)
    uploaded_at DATETIME DEFAULT GETDATE(), --waktu upload 
    description VARCHAR(500),	-- deskripsi video
    thumbnail VARCHAR(255),		-- Path file thumbnail (misal : thumbnails/move.jpg)
    idChannel INT,              -- Foreign key ke Channel
    CONSTRAINT FK_Videos_Channel FOREIGN KEY (idChannel) REFERENCES Channel(idChannel)
);

CREATE TABLE Tonton (
    idTonton INT IDENTITY(1,1) PRIMARY KEY,
    idVideo INT NOT NULL,
    idUser INT NOT NULL,
    tanggal DATETIME NOT NULL DEFAULT GETDATE(),
    lamaMenonton INT NOT NULL,
    likeDislike TINYINT NOT NULL,
    FOREIGN KEY (idVideo) REFERENCES Videos(id),
    FOREIGN KEY (idUser) REFERENCES Users(id)
);

CREATE TABLE Roles (
    RoleID INT IDENTITY(1,1) PRIMARY KEY,
    RoleName NVARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO Roles (RoleName) VALUES ('Manager'), ('Editor'), ('Admin'), ('Subtitle Editor'), ('Viewer');


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
    tanggal DATETIME,
    komen NVARCHAR(MAX)
);

CREATE TABLE Subscribe (
    idChannel INT NOT NULL,
    idUser INT NOT NULL,
    tanggalSubscribe DATETIME DEFAULT GETDATE(),
    PRIMARY KEY (idChannel, idUser),
    FOREIGN KEY (idChannel) REFERENCES Channel(idChannel),
    FOREIGN KEY (idUser) REFERENCES Users(Id)
);


INSERT INTO Channel 
VALUES ( 'Dodo', 'Dodo si petualang',  'thumbnails/68343fdcd3cc7_Seoul.png'  ,0)

