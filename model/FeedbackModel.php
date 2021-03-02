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

    public function addFeedback($data)
    {
        //prepare statement
        $this->db->query("INSERT INTO `feedback` (`userId`, `text`) VALUES (:userId, :text)");
        //add values//priskirti reiksmes
        $this->db->bind(':text', $data['commentBody']);
        $this->db->bind(':userId', $data['userId']);
        //make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


}