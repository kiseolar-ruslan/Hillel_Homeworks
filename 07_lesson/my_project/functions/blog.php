<?php

/**
 * @param PDO $connect
 * @param array $data
 * @return int|bool
 */
function blogAdd(PDO $connect, array $data): int|bool
{
    try {
        $queryDataUser = "INSERT INTO `blogs` (user_id, `title`,`image`, `content`) 
                                VALUES (:user_id, :title, :image, :content)";
        $stDataUser = $connect->prepare($queryDataUser);
        $stDataUser->execute($data);
        return $connect->lastInsertId();
    } catch (PDOException $e) {
        return false;
    }
}