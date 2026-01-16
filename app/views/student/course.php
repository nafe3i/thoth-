<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - Thoth LMS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .back-link { margin-bottom: 20px; }
        .back-link a { color: #007bff; text-decoration: none; }
        .back-link a:hover { text-decoration: underline; }
        .course-detail { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .course-detail h1 { margin-top: 0; color: #333; }
        .course-detail p { color: #666; line-height: 1.6; }
        .btn { display: inline-block; padding: 12px 24px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; }
        .btn:hover { background: #218838; }
        .btn-disabled { background: #6c757d; cursor: not-allowed; }
        .enrolled { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="<?php echo BASE_URL; ?>/student/dashboard">← Retour au dashboard</a>
        </div>
        
        <div class="course-detail">
            <h1><?php echo htmlspecialchars($course['title']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
            
            <?php if ($isEnrolled): ?>
                <div class="enrolled">
                    Vous êtes inscrit à ce cours.
                </div>
            <?php else: ?>
                <form method="POST" action="<?php echo BASE_URL; ?>/enroll">
                    <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                    <button type="submit" class="btn">S'inscrire à ce cours</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
