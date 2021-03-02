# php-forum
website, where you can follow communities, post (reddit)

![img1](https://i.imgur.com/0yxn7AM.png)

**Ustvarjanje baze**
```bash
CREATE DATABASE db;

use db;

CREATE TABLE uporabniki(
    id int not null primary key AUTO_INCREMENT,
    username nvarchar(20) not null unique,
    password nvarchar(256) not null
)
```