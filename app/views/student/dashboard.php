<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Thoth LMS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; }
        .header { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header h1 { margin: 0; color: #333; }
        .header p { margin: 5px 0 0 0; color: #666; }
        .logout { float: right; }
        .btn { display: inline-block; padding: 8px 16px; background: #dc3545; color: white; text-decoration: none; border-radius: 5px; }
        .btn:hover { background: #c82333; }
        .btn-primary { background: #007bff; }
        .btn-primary:hover { background: #0056b3; }
        .section { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .section h2 { margin-top: 0; color: #333; }
        .course-list { display: grid; gap: 15px; }
        .course-item { border: 1px solid #ddd; padding: 15px; border-radius: 5px; }
        .course-item h3 { margin: 0 0 10px 0; color: #007bff; }
        .course-item p { margin: 0 0 10px 0; color: #666; }
        .course-meta { font-size: 12px; color: #999; }
        .no-courses { color: #666; font-style: italic; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logout">
                <a href="<?php echo BASE_URL; ?>/logout" class="btn">Déconnexion</a>
            </div>
            <h1>Bienvenue, <?php echo htmlspecialchars(Auth::getUserName()); ?> !</h1>
            <p>Email : <?php echo htmlspecialchars(Auth::getUserName() . '@example.com'); ?></p>
        </div>
        
        <div class="section">
            <h2>Mes cours</h2>
            <?php if (!empty($enrolledCourses)): ?>
                <div class="course-list">
                    <?php foreach ($enrolledCourses as $course): ?>
                        <div class="course-item">
                            <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                            <p><?php echo htmlspecialchars($course['description']); ?></p>
                            <div class="course-meta">
                                Inscrit le : <?php echo date('d/m/Y', strtotime($course['enrollment_date'])); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="no-courses">Vous n'êtes inscrit à aucun cours pour le moment.</p>
            <?php endif; ?>
        </div>
        
        <div class="section">
            <h2>Cours disponibles</h2>
            <?php if (!empty($availableCourses)): ?>
                <div class="course-list">
                    <?php foreach ($availableCourses as $course): ?>
                        <div class="course-item">
                            <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                            <p><?php echo htmlspecialchars($course['description']); ?></p>
                            <form method="POST" action="<?php echo BASE_URL; ?>/enroll" style="margin: 0;">
                                <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                                <button type="submit" class="btn btn-primary">S'inscrire</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="no-courses">Aucun cours disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
