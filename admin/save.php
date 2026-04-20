<?php
session_start();
if (empty($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
require __DIR__ . '/../db.php';

// Ensure optional resumes table exists before inserting
function ensureResumesTable(PDO $pdo): void {
    try {
        $pdo->query('SELECT 1 FROM resumes LIMIT 1');
    } catch (PDOException $e) {
        $pdo->exec(
            "CREATE TABLE IF NOT EXISTS resumes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(160) NOT NULL,
                file_path VARCHAR(255) NOT NULL,
                version VARCHAR(40) DEFAULT NULL,
                is_active TINYINT(1) DEFAULT 0,
                notes VARCHAR(255) DEFAULT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
        );
    }
}

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'update_site':
        $currentSite = $pdo->query('SELECT profile_photo FROM site_info WHERE id = 1')->fetch();
        $newPhotoPath = $currentSite['profile_photo'] ?? 'assets/img/profile.jpg';

        if (!empty($_FILES['profile_photo']['tmp_name']) && is_uploaded_file($_FILES['profile_photo']['tmp_name'])) {
            $file = $_FILES['profile_photo'];
            $maxSize = 2 * 1024 * 1024; // 2MB
            $allowed = ['image/jpeg', 'image/png', 'image/webp'];
            $mime = mime_content_type($file['tmp_name']);

            if (in_array($mime, $allowed, true) && $file['size'] <= $maxSize) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) ?: 'jpg';
                $uploadDir = __DIR__ . '/../assets/uploads/profile/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $filename = 'profile-' . time() . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
                $destination = $uploadDir . $filename;

                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    $newPhotoPath = 'assets/uploads/profile/' . $filename;

                    if (!empty($currentSite['profile_photo']) && strpos($currentSite['profile_photo'], 'assets/uploads/profile/') === 0) {
                        $oldPath = __DIR__ . '/../' . $currentSite['profile_photo'];
                        if (is_file($oldPath)) {
                            @unlink($oldPath);
                        }
                    }
                }
            }
        }

        $stmt = $pdo->prepare('UPDATE site_info SET name=:name, title=:title, tagline=:tagline, profile_photo=:profile_photo, resume_url=:resume_url, hero_email=:hero_email, about_intro=:about_intro, education_background=:education_background, career_goal=:career_goal, strengths=:strengths, contact_email=:contact_email, phone=:phone, linkedin=:linkedin, github=:github, location=:location, footer_text=:footer_text WHERE id = 1');
        $stmt->execute([
            ':name' => $_POST['name'],
            ':title' => $_POST['title'],
            ':tagline' => $_POST['tagline'],
            ':profile_photo' => $newPhotoPath,
            ':resume_url' => $_POST['resume_url'],
            ':hero_email' => $_POST['hero_email'],
            ':about_intro' => $_POST['about_intro'],
            ':education_background' => $_POST['education_background'],
            ':career_goal' => $_POST['career_goal'],
            ':strengths' => $_POST['strengths'],
            ':contact_email' => $_POST['contact_email'],
            ':phone' => $_POST['phone'],
            ':linkedin' => $_POST['linkedin'],
            ':github' => $_POST['github'],
            ':location' => $_POST['location'],
            ':footer_text' => $_POST['footer_text'],
        ]);
        break;

    case 'upload_resume':
        if (!empty($_FILES['resume_file']['tmp_name']) && is_uploaded_file($_FILES['resume_file']['tmp_name'])) {
            $file = $_FILES['resume_file'];
            $maxSize = 5 * 1024 * 1024; // 5MB
            $allowed = ['application/pdf'];
            $mime = mime_content_type($file['tmp_name']);

            if (in_array($mime, $allowed, true) && $file['size'] <= $maxSize) {
                $uploadDir = __DIR__ . '/../assets/uploads/resumes/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $filename = 'resume-' . time() . '-' . bin2hex(random_bytes(4)) . '.pdf';
                $destination = $uploadDir . $filename;
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    $relativePath = 'assets/uploads/resumes/' . $filename;
                    $stmt = $pdo->prepare('UPDATE site_info SET resume_url = :resume_url WHERE id = 1');
                    $stmt->execute([':resume_url' => $relativePath]);

                    // record in resumes table (create if missing)
                    ensureResumesTable($pdo);
                    $pdo->prepare('INSERT INTO resumes (title, file_path, version, is_active, notes) VALUES (:title, :file_path, :version, 1, :notes)')
                        ->execute([
                            ':title' => 'Uploaded ' . date('Y-m-d H:i'),
                            ':file_path' => $relativePath,
                            ':version' => null,
                            ':notes' => 'Uploaded via admin',
                        ]);
                    // mark previous resumes inactive
                    $pdo->prepare('UPDATE resumes SET is_active = 0 WHERE file_path <> :file_path')->execute([':file_path' => $relativePath]);
                }
            }
        }
        break;

    case 'add_skill':
        $stmt = $pdo->prepare('INSERT INTO skills (category, name) VALUES (:category, :name)');
        $stmt->execute([':category' => $_POST['category'], ':name' => $_POST['name']]);
        break;
    case 'delete_skill':
        $stmt = $pdo->prepare('DELETE FROM skills WHERE id = :id');
        $stmt->execute([':id' => $_POST['id']]);
        break;

    case 'add_project':
        $stmt = $pdo->prepare('INSERT INTO projects (title, description, technologies, features, github_url) VALUES (:title, :description, :technologies, :features, :github_url)');
        $stmt->execute([
            ':title' => $_POST['title'],
            ':description' => $_POST['description'],
            ':technologies' => $_POST['technologies'],
            ':features' => $_POST['features'],
            ':github_url' => $_POST['github_url'],
        ]);
        break;
    case 'delete_project':
        $stmt = $pdo->prepare('DELETE FROM projects WHERE id = :id');
        $stmt->execute([':id' => $_POST['id']]);
        break;

    case 'add_education':
        $stmt = $pdo->prepare('INSERT INTO education (degree, institution, year, score) VALUES (:degree, :institution, :year, :score)');
        $stmt->execute([
            ':degree' => $_POST['degree'],
            ':institution' => $_POST['institution'],
            ':year' => $_POST['year'],
            ':score' => $_POST['score'],
        ]);
        break;
    case 'delete_education':
        $stmt = $pdo->prepare('DELETE FROM education WHERE id = :id');
        $stmt->execute([':id' => $_POST['id']]);
        break;

    case 'add_internship':
        $internshipImage = null;
        if (!empty($_FILES['internship_image']['tmp_name']) && is_uploaded_file($_FILES['internship_image']['tmp_name'])) {
            $file = $_FILES['internship_image'];
            $maxSize = 2 * 1024 * 1024;
            $allowed = ['image/jpeg', 'image/png', 'image/webp'];
            $mime = mime_content_type($file['tmp_name']);
            if (in_array($mime, $allowed, true) && $file['size'] <= $maxSize) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) ?: 'jpg';
                $uploadDir = __DIR__ . '/../assets/uploads/internships/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $filename = 'intern-' . time() . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
                if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
                    $internshipImage = 'assets/uploads/internships/' . $filename;
                }
            }
        }
        $stmt = $pdo->prepare('INSERT INTO internships (organization, duration, role, learnings, image) VALUES (:organization, :duration, :role, :learnings, :image)');
        $stmt->execute([
            ':organization' => $_POST['organization'],
            ':duration' => $_POST['duration'],
            ':role' => $_POST['role'],
            ':learnings' => $_POST['learnings'],
            ':image' => $internshipImage,
        ]);
        break;
    case 'delete_internship':
        $old = $pdo->prepare('SELECT image FROM internships WHERE id = :id');
        $old->execute([':id' => $_POST['id']]);
        $oldRow = $old->fetch();
        if (!empty($oldRow['image']) && strpos($oldRow['image'], 'assets/uploads/internships/') === 0) {
            $oldPath = __DIR__ . '/../' . $oldRow['image'];
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }
        }
        $stmt = $pdo->prepare('DELETE FROM internships WHERE id = :id');
        $stmt->execute([':id' => $_POST['id']]);
        break;

    case 'add_certification':
        $certImage = null;
        if (!empty($_FILES['cert_image']['tmp_name']) && is_uploaded_file($_FILES['cert_image']['tmp_name'])) {
            $file = $_FILES['cert_image'];
            $maxSize = 2 * 1024 * 1024;
            $allowed = ['image/jpeg', 'image/png', 'image/webp'];
            $mime = mime_content_type($file['tmp_name']);
            if (in_array($mime, $allowed, true) && $file['size'] <= $maxSize) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) ?: 'jpg';
                $uploadDir = __DIR__ . '/../assets/uploads/certifications/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $filename = 'cert-' . time() . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
                if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
                    $certImage = 'assets/uploads/certifications/' . $filename;
                }
            }
        }
        $stmt = $pdo->prepare('INSERT INTO certifications (course, issuer, image) VALUES (:course, :issuer, :image)');
        $stmt->execute([
            ':course' => $_POST['course'],
            ':issuer' => $_POST['issuer'],
            ':image' => $certImage,
        ]);
        break;
    case 'delete_certification':
        $old = $pdo->prepare('SELECT image FROM certifications WHERE id = :id');
        $old->execute([':id' => $_POST['id']]);
        $oldRow = $old->fetch();
        if (!empty($oldRow['image']) && strpos($oldRow['image'], 'assets/uploads/certifications/') === 0) {
            $oldPath = __DIR__ . '/../' . $oldRow['image'];
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }
        }
        $stmt = $pdo->prepare('DELETE FROM certifications WHERE id = :id');
        $stmt->execute([':id' => $_POST['id']]);
        break;

    case 'add_achievement':
        $achievementImage = null;
        if (!empty($_FILES['achievement_image']['tmp_name']) && is_uploaded_file($_FILES['achievement_image']['tmp_name'])) {
            $file = $_FILES['achievement_image'];
            $maxSize = 2 * 1024 * 1024;
            $allowed = ['image/jpeg', 'image/png', 'image/webp'];
            $mime = mime_content_type($file['tmp_name']);
            if (in_array($mime, $allowed, true) && $file['size'] <= $maxSize) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) ?: 'jpg';
                $uploadDir = __DIR__ . '/../assets/uploads/achievements/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $filename = 'ach-' . time() . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
                if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
                    $achievementImage = 'assets/uploads/achievements/' . $filename;
                }
            }
        }
        $stmt = $pdo->prepare('INSERT INTO achievements (description, image) VALUES (:description, :image)');
        $stmt->execute([
            ':description' => $_POST['description'],
            ':image' => $achievementImage
        ]);
        break;
    case 'delete_achievement':
        $old = $pdo->prepare('SELECT image FROM achievements WHERE id = :id');
        $old->execute([':id' => $_POST['id']]);
        $oldRow = $old->fetch();
        if (!empty($oldRow['image']) && strpos($oldRow['image'], 'assets/uploads/achievements/') === 0) {
            $oldPath = __DIR__ . '/../' . $oldRow['image'];
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }
        }
        $stmt = $pdo->prepare('DELETE FROM achievements WHERE id = :id');
        $stmt->execute([':id' => $_POST['id']]);
        break;

    default:
        // No action
        break;
}

header('Location: dashboard.php');
exit;

