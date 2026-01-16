 Structure du projet

thoth2/
├── public/
│   ├── index.php          # Point d'entrée unique
│   └── .htaccess          # Réécriture d'URL
├── app/
│   ├── core/
│   │   ├── Router.php     # Gestion du routage
│   │   ├── Controller.php # Contrôleur de base
│   │   ├── Database.php   # Connexion BDD (Singleton)
│   │   └── Auth.php       # Gestion des sessions
│   ├── controllers/
│   │   └── StudentController.php
│   ├── models/
│   │   ├── Student.php
│   │   ├── Course.php
│   │   └── Enrollment.php
│   └── views/
│       └── student/
│           ├── index.php
│           ├── login.php
│           ├── register.php
│           ├── dashboard.php
│           └── course.php
├── config/
│   └── database.php       
├── database.sql          
└── README.md


