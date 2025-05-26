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

CREATE TABLE UploadedFiles (
    Id INT PRIMARY KEY IDENTITY(1,1),
    NamaFile NVARCHAR(255) NOT NULL,
	Deskripsi NVARCHAR(MAX),
    FilePath NVARCHAR(500) NOT NULL,
    UploadDate DATETIME DEFAULT GETDATE()
)

SELECT *
FROM adminDB

CREATE TABLE AdminDB (
    IDAdmin INT IDENTITY(1,1) PRIMARY KEY,
    Email NVARCHAR(100) NOT NULL UNIQUE,
    Roles NVARCHAR(50) NOT NULL,
    CreatedAt DATETIME DEFAULT GETDATE()
)

CREATE TABLE ChannelDB (
    ChannelID INT IDENTITY(1,1) PRIMARY KEY,
    ChannelName NVARCHAR(100) NOT NULL UNIQUE,
    DescChannel NVARCHAR(255) DEFAULT 'ini channel baru',
    ProfilePath NVARCHAR(255) NULL,
    ChannelType NVARCHAR(20) NOT NULL CHECK (ChannelType IN ('Group', 'Individual')),
    ChannelPass NVARCHAR(100) NOT NULL
)

SELECT *
FROM ChannelDB

CREATE TABLE CommentDB (
    CommentID INT IDENTITY(1,1) PRIMARY KEY,
    ChannelID INT,
    CommentText NVARCHAR(255),
    CreatedAt DATETIME DEFAULT GETDATE()
)
