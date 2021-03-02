<?php


namespace app\model;


use app\core\Application;
use app\core\Database;

class FeedbackModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }

    public function getAllFeedback()
    {
        $sql = "SELECT u.name AS userName, f.text AS feedbackText, f.feedbackId, u.userId, f.created As feedbackCreated
                FROM feedback f INNER JOIN users u ON f.userId = u.userId ORDER BY f.created DESC";

        $this->db->query($sql);
        $result = $this->db->resultSet();
        return $result;
    }


}