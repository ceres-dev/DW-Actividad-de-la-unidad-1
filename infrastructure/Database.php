<?php
class Database {
    public static function connect() {
        return new PDO("mysql:host=192.168.1.55;dbname=test", "user_mc", "");
    }
}