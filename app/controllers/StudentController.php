<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/Enrollment.php';

class StudentController extends Controller {
    
    public function index() {
        $this->view('student/index');
    }
    
    // Page de connexion
    public function login() {
        if (Auth::isLoggedIn()) {
            $this->redirect('/student/dashboard');
            return;
        }
        
        if ($this->isPost()) {
            $email = $this->post('email');
            $password = $this->post('password');
            
            $errors = [];
            
            // Validation
            if (empty($email)) {
                $errors[] = "L'email est requis";
            }
            if (empty($password)) {
                $errors[] = "Le mot de passe est requis";
            }
            
            if (empty($errors)) {
                $studentModel = new Student();
                $student = $studentModel->authenticate($email, $password);
                
                if ($student) {
                    Auth::login($student);
                    $this->redirect('/student/dashboard');
                } else {
                    $errors[] = "Email ou mot de passe incorrect";
                }
            }
            
            $this->view('student/login', ['errors' => $errors]);
        } else {
            $this->view('student/login');
        }
    }
    
    public function register() {
        if (Auth::isLoggedIn()) {
            $this->redirect('/student/dashboard');
            return;
        }
        
        if ($this->isPost()) {
            $name = $this->post('name');
            $email = $this->post('email');
            $password = $this->post('password');
            $password_confirm = $this->post('password_confirm');
            
            $errors = [];
            
            // Validation
            if (empty($name)) {
                $errors[] = "Le nom est requis";
            }
            if (empty($email)) {
                $errors[] = "L'email est requis";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'email n'est pas valide";
            }
            if (empty($password)) {
                $errors[] = "Le mot de passe est requis";
            } elseif (strlen($password) < 6) {
                $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
            }
            if ($password !== $password_confirm) {
                $errors[] = "Les mots de passe ne correspondent pas";
            }
            
            if (empty($errors)) {
                $studentModel = new Student();
                if ($studentModel->emailExists($email)) {
                    $errors[] = "Cet email est déjà utilisé";
                }
            }
            
            if (empty($errors)) {
                $studentModel = new Student();
                if ($studentModel->register($name, $email, $password)) {
                    $this->redirect('/login?registered=1');
                } else {
                    $errors[] = "Erreur lors de l'inscription";
                }
            }
            
            $this->view('student/register', ['errors' => $errors]);
        } else {
            $this->view('student/register');
        }
    }
    
    public function dashboard() {
        Auth::protect();
        
        $studentId = Auth::getUserId();
        
        $courseModel = new Course();
        $enrollmentModel = new Enrollment();
        
        // Obtenir les cours où l'étudiant est inscrit
        $enrolledCourses = $enrollmentModel->getByStudent($studentId);
        
        // Obtenir les cours disponibles
        $availableCourses = $courseModel->getAvailableForStudent($studentId);
        
        $this->view('student/dashboard', [
            'enrolledCourses' => $enrolledCourses,
            'availableCourses' => $availableCourses
        ]);
    }
    
    public function course() {
        Auth::protect();
        
        $courseId = $this->get('id');
        $studentId = Auth::getUserId();
        
        if (!$courseId) {
            $this->redirect('/student/dashboard');
            return;
        }
        
        $courseModel = new Course();
        $enrollmentModel = new Enrollment();
        
        $course = $courseModel->find($courseId);
        $isEnrolled = $enrollmentModel->isEnrolled($studentId, $courseId);
        
        if (!$course) {
            echo "<h1>Cours non trouvé</h1>";
            return;
        }
        
        $this->view('student/course', [
            'course' => $course,
            'isEnrolled' => $isEnrolled
        ]);
    }
    
    public function enroll() {
        Auth::protect();
        
        if ($this->isPost()) {
            $courseId = $this->post('course_id');
            $studentId = Auth::getUserId();
            
            if ($courseId) {
                $enrollmentModel = new Enrollment();
                
                if (!$enrollmentModel->isEnrolled($studentId, $courseId)) {
                    $enrollmentModel->enroll($studentId, $courseId);
                }
            }
        }
        
        $this->redirect('/student/dashboard');
    }
    
    public function logout() {
        Auth::logout();
        $this->redirect('/login');
    }
}
