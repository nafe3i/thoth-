<?php

class Enrollment {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    // Inscrire un étudiant à un cours
    public function enroll($studentId, $courseId) {
        $sql = "INSERT INTO enrollments (student_id, course_id) VALUES (:student_id, :course_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':course_id', $courseId);
        
        return $stmt->execute();
    }
    
    // Obtenir les cours d'un étudiant
    public function getByStudent($studentId) {
        $sql = "SELECT c.*, e.enrollment_date 
                FROM courses c 
                JOIN enrollments e ON c.id = e.course_id 
                WHERE e.student_id = :student_id 
                ORDER BY e.enrollment_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    // Vérifier si un étudiant est déjà inscrit à un cours
    public function isEnrolled($studentId, $courseId) {
        $sql = "SELECT id FROM enrollments WHERE student_id = :student_id AND course_id = :course_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':course_id', $courseId);
        $stmt->execute();
        
        return $stmt->fetch() !== false;
    }
}
