<?php

class CreateUsersTable {
    public function up(PDO $db): void {
        $db->exec("CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            password VARCHAR(100) NOT NULL,
            birthdate DATE NOT NULL,
            phone_number VARCHAR(10) NOT NULL,
            url VARCHAR(200) NOT NULL
        ) ENGINE=INNODB;");
    }

    public function down(PDO $db): void {
        $db->exec("DROP TABLE users;");
    }
}
