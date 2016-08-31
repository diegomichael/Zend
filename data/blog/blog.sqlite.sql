CREATE TABLE `admin` (
  `idadmin` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `nome` TEXT NOT NULL,
  `email` TEXT NOT NULL,
  `senha` TEXT NOT NULL,
  `papel` INTEGER NOT NULL
);


CREATE TABLE `categoria` (
  `idcategoria` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `categoria` TEXT NOT NULL
);


CREATE TABLE [pratos] (
  [idpratos] INTEGER NOT NULL, 
  [idcategoria] INTEGER NOT NULL CONSTRAINT [idcategoria] REFERENCES [categoria]([idcategoria]), 
  [nomeprato] VARCHAR NOT NULL, 
  [precoprato] DOUBLE NOT NULL);


CREATE TABLE [postcardapio] (
  [idpostcardapio] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, 
  [idprato] INTEGER NOT NULL CONSTRAINT [idprato] REFERENCES [pratos]([idprato]), 
  [idcategoria] INTEGER NOT NULL CONSTRAINT [idcategoria] REFERENCES [pratos]([idcategoria]), 
  [idadmin] INTEGER NOT NULL, 
  [prato] TEXT NOT NULL, 
  [preco] TEXT NOT NULL);
