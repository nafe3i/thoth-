<?php

class Course {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    // Obtenir tous les cours
    public function getAll() {
        $sql = "SELECT * FROM courses ORDER BY title";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    // Obtenir un cours par son ID
    public function find($id) {
        $sql = "SELECT * FROM courses WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    // Obtenir les cours disponibles pour un étudiant (ceux où il n'est pas inscrit)
    public function getAvailableForStudent($studentId) {
        $sql = "SELECT c.* FROM courses c 
                LEFT JOIN enrollments e ON c.id = e.course_id AND e.student_id = :student_id 
                WHERE e.id IS NULL 
                ORDER BY c.title";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
