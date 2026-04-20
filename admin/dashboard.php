<?php
session_start();
if (empty($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
require __DIR__ . '/../db.php';

$site = $pdo->query('SELECT * FROM site_info WHERE id = 1')->fetch();
$skills = $pdo->query('SELECT * FROM skills ORDER BY category, name')->fetchAll();
$projects = $pdo->query('SELECT * FROM projects ORDER BY id DESC')->fetchAll();
$education = $pdo->query('SELECT * FROM education ORDER BY id DESC')->fetchAll();
$internships = $pdo->query('SELECT * FROM internships ORDER BY id DESC')->fetchAll();
$certifications = $pdo->query('SELECT * FROM certifications ORDER BY id DESC')->fetchAll();
$achievements = $pdo->query('SELECT * FROM achievements ORDER BY id DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body { background: #F8FAFC; }
        main { max-width: 1100px; margin: 0 auto; padding: 24px 20px 72px; }
        .admin-nav {
            position: sticky;
            top: 64px;
            z-index: 5;
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 10px 12px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 16px;
        }
        .admin-nav a {
            padding: 8px 12px;
            border-radius: 8px;
            background: #F8FAFC;
            color: #0F172A;
            border: 1px solid #E2E8F0;
            font-weight: 600;
        }
        .admin-nav a:hover { background: #E0F2FE; border-color: #BFDBFE; color: #1D4ED8; }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            margin: 6px 0 12px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
        }
        textarea { min-height: 80px; }
        .flex { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #E2E8F0;
            padding: 8px;
            font-size: 0.95rem;
            vertical-align: top;
        }
        .actions { display: flex; gap: 0.35rem; }
        .small-btn {
            background: #E2E8F0;
            border: none;
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
        }
        .section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            margin: 0 0 12px;
        }
        .hint { color: #64748B; font-size: 0.95rem; margin: 4px 0 12px; }
        .section-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 12px;
        }
        .photo-upload {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            flex-wrap: wrap;
        }
        .photo-upload img {
            width: 96px;
            height: 96px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            background: #FFFFFF;
        }
        .photo-upload__inputs { flex: 1; min-width: 220px; }
        .card-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 12px;
            margin-top: 12px;
        }
        .card-list__item {
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 12px;
            background: #FFFFFF;
            display: grid;
            gap: 6px;
        }
        .meta {
            color: #475569;
            font-size: 0.9rem;
        }
        .chipline { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
        .chipline .chip { background: #EFF6FF; color: #1D4ED8; border: 1px solid #BFDBFE; padding: 4px 8px; border-radius: 999px; font-size: 0.9rem; }
        .thumb {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #E2E8F0;
            background: #FFFFFF;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 12px;
            margin-top: 12px;
        }
        .gallery-card {
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 12px;
            background: #FFFFFF;
            display: grid;
            gap: 6px;
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="container topbar__inner">
            <div class="logo">Admin Panel</div>
            <div class="nav">
                <a href="../index.php">View Site</a>
                <a href="logout.php" class="nav__admin">Logout</a>
            </div>
        </div>
    </header>

    <main>
        <h1 style="margin: 12px 0 6px;">Dashboard</h1>
        <p class="muted">Update portfolio content. Changes save instantly to the database.</p>

        <nav class="admin-nav">
            <a href="#hero">Hero</a>
            <a href="#resume">Resume</a>
            <a href="#skills">Skills</a>
            <a href="#projects">Projects</a>
            <a href="#education">Education</a>
            <a href="#internships">Internships</a>
            <a href="#certifications">Certifications</a>
            <a href="#achievements">Achievements</a>
        </nav>

        <section id="hero" class="card">
            <div class="section-title">
                <h2>Hero & Contact</h2>
                <span class="label">Primary info</span>
            </div>
            <p class="hint">Name, title, tagline, resume link, about text, and contact/social details.</p>
            <form method="post" action="save.php" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_site">
                <div class="grid-2">
                    <div>
                        <label>Name</label>
                        <input name="name" value="<?= htmlspecialchars($site['name'] ?? ''); ?>" required>
                    </div>
                    <div>
                        <label>Title</label>
                        <input name="title" value="<?= htmlspecialchars($site['title'] ?? ''); ?>" required>
                    </div>
                </div>
                <label>Tagline</label>
                <input name="tagline" value="<?= htmlspecialchars($site['tagline'] ?? ''); ?>" required>
                <label>Profile Photo</label>
                <div class="photo-upload">
                    <img src="../<?= htmlspecialchars($site['profile_photo'] ?? 'assets/img/profile.jpg'); ?>" alt="Current profile photo">
                    <div class="photo-upload__inputs">
                        <input type="file" name="profile_photo" accept="image/*">
                        <p class="hint">Upload JPEG/PNG/WebP up to 2MB. Leave empty to keep current photo.</p>
                    </div>
                </div>
                <label>Resume URL</label>
                <input name="resume_url" value="<?= htmlspecialchars($site['resume_url'] ?? ''); ?>">
                <label>Hero Email</label>
                <input name="hero_email" value="<?= htmlspecialchars($site['hero_email'] ?? ''); ?>">
                <label>About Intro</label>
                <textarea name="about_intro"><?= htmlspecialchars($site['about_intro'] ?? ''); ?></textarea>
                <label>Education Background</label>
                <input name="education_background" value="<?= htmlspecialchars($site['education_background'] ?? ''); ?>">
                <label>Career Goal</label>
                <input name="career_goal" value="<?= htmlspecialchars($site['career_goal'] ?? ''); ?>">
                <label>Strengths</label>
                <input name="strengths" value="<?= htmlspecialchars($site['strengths'] ?? ''); ?>">
                <div class="grid-2">
                    <div>
                        <label>Contact Email</label>
                        <input name="contact_email" value="<?= htmlspecialchars($site['contact_email'] ?? ''); ?>">
                    </div>
                    <div>
                        <label>Phone</label>
                        <input name="phone" value="<?= htmlspecialchars($site['phone'] ?? ''); ?>">
                    </div>
                </div>
                <div class="grid-2">
                    <div>
                        <label>LinkedIn</label>
                        <input name="linkedin" value="<?= htmlspecialchars($site['linkedin'] ?? ''); ?>">
                    </div>
                    <div>
                        <label>GitHub</label>
                        <input name="github" value="<?= htmlspecialchars($site['github'] ?? ''); ?>">
                    </div>
                </div>
                <label>Location</label>
                <input name="location" value="<?= htmlspecialchars($site['location'] ?? ''); ?>">
                <label>Footer Text</label>
                <input name="footer_text" value="<?= htmlspecialchars($site['footer_text'] ?? ''); ?>">
                <button class="btn" type="submit">Save Info</button>
            </form>
        </section>

        <section id="resume" class="card">
            <div class="section-title">
                <h2>Resume File</h2>
                <span class="label">Upload & set link</span>
            </div>
            <p class="hint">Upload a PDF resume. The latest upload will become the active download link on the site.</p>
            <div style="margin-bottom:10px;">
                <strong>Current link:</strong>
                <?php if (!empty($site['resume_url'])): ?>
                    <a href="../<?= htmlspecialchars($site['resume_url']); ?>" target="_blank" rel="noreferrer"><?= htmlspecialchars($site['resume_url']); ?></a>
                <?php else: ?>
                    <span class="muted">No resume uploaded yet.</span>
                <?php endif; ?>
            </div>
            <form method="post" action="save.php" enctype="multipart/form-data" class="flex">
                <input type="hidden" name="action" value="upload_resume">
                <input type="file" name="resume_file" accept="application/pdf" required>
                <button class="btn" type="submit">Upload & Set Active</button>
            </form>
        </section>

        <section id="skills" class="card">
            <div class="section-title">
                <h2>Skills</h2>
                <span class="label">Add & delete</span>
            </div>
            <form method="post" action="save.php" class="flex">
                <input type="hidden" name="action" value="add_skill">
                <input name="category" placeholder="Category (e.g., Programming Languages)" required>
                <input name="name" placeholder="Skill name" required>
                <button class="btn" type="submit">Add Skill</button>
            </form>
            <table class="table">
                <tr><th>Category</th><th>Name</th><th>Actions</th></tr>
                <?php foreach ($skills as $skill): ?>
                    <tr>
                        <td><?= htmlspecialchars($skill['category']); ?></td>
                        <td><?= htmlspecialchars($skill['name']); ?></td>
                        <td class="actions">
                            <form method="post" action="save.php">
                                <input type="hidden" name="action" value="delete_skill">
                                <input type="hidden" name="id" value="<?= $skill['id']; ?>">
                                <button class="small-btn" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <section id="projects" class="card">
            <div class="section-title">
                <h2>Projects</h2>
                <span class="label">Showcase</span>
            </div>
            <form method="post" action="save.php">
                <input type="hidden" name="action" value="add_project">
                <div class="grid-2">
                    <div>
                        <label>Title</label>
                        <input name="title" required>
                    </div>
                    <div>
                        <label>Technologies (comma separated)</label>
                        <input name="technologies">
                    </div>
                </div>
                <label>Description</label>
                <textarea name="description" required></textarea>
                <label>Features (semicolon separated)</label>
                <input name="features" placeholder="Feature 1;Feature 2;Feature 3">
                <label>GitHub URL</label>
                <input name="github_url">
                <button class="btn" type="submit">Add Project</button>
            </form>
            <table class="table">
                <tr><th>Title</th><th>Tech</th><th>Actions</th></tr>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?= htmlspecialchars($project['title']); ?></td>
                        <td><?= htmlspecialchars($project['technologies']); ?></td>
                        <td class="actions">
                            <form method="post" action="save.php">
                                <input type="hidden" name="action" value="delete_project">
                                <input type="hidden" name="id" value="<?= $project['id']; ?>">
                                <button class="small-btn" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <section id="education" class="card">
            <div class="section-title">
                <h2>Education</h2>
                <span class="label">Degrees</span>
            </div>
            <form method="post" action="save.php">
                <input type="hidden" name="action" value="add_education">
                <div class="grid-2">
                    <div><label>Degree</label><input name="degree" required></div>
                    <div><label>Institution</label><input name="institution" required></div>
                </div>
                <div class="grid-2">
                    <div><label>Year</label><input name="year" required></div>
                    <div><label>CGPA / Percentage</label><input name="score"></div>
                </div>
                <button class="btn" type="submit">Add Education</button>
            </form>
            <table class="table">
                <tr><th>Degree</th><th>Institution</th><th>Year</th><th>Actions</th></tr>
                <?php foreach ($education as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['degree']); ?></td>
                        <td><?= htmlspecialchars($row['institution']); ?></td>
                        <td><?= htmlspecialchars($row['year']); ?></td>
                        <td class="actions">
                            <form method="post" action="save.php">
                                <input type="hidden" name="action" value="delete_education">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <button class="small-btn" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <section id="internships" class="card">
            <div class="section-title">
                <h2>Internships / Training</h2>
                <span class="label">Experience</span>
            </div>
            <p class="hint">Add your latest internships; they will appear as tidy cards below.</p>
            <form method="post" action="save.php" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_internship">
                <label>Organization</label>
                <input name="organization" required>
                <div class="grid-2">
                    <div><label>Duration</label><input name="duration" required></div>
                    <div><label>Role</label><input name="role" required></div>
                </div>
                <label>Key Learnings</label>
                <input name="learnings">
                <label>Certificate / Badge (optional)</label>
                <input type="file" name="internship_image" accept="image/*">
                <p class="hint">JPEG/PNG/WebP up to 2MB.</p>
                <button class="btn" type="submit">Add Internship</button>
            </form>
            <?php if ($internships): ?>
                <div class="card-list">
                    <?php foreach ($internships as $row): ?>
                        <div class="card-list__item">
                            <?php if (!empty($row['image'])): ?>
                                <img class="thumb" src="../<?= htmlspecialchars($row['image']); ?>" alt="Internship image">
                            <?php endif; ?>
                            <div class="chipline">
                                <span class="chip"><?= htmlspecialchars($row['role']); ?></span>
                                <span class="meta"><?= htmlspecialchars($row['duration']); ?></span>
                            </div>
                            <div class="meta"><?= htmlspecialchars($row['organization']); ?></div>
                            <?php if (!empty($row['learnings'])): ?>
                                <div><?= htmlspecialchars($row['learnings']); ?></div>
                            <?php endif; ?>
                            <div class="actions" style="margin-top:6px;">
                                <form method="post" action="save.php">
                                    <input type="hidden" name="action" value="delete_internship">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <button class="small-btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="muted" style="margin-top:10px;">No internships added yet.</p>
            <?php endif; ?>
        </section>

        <section id="certifications" class="card">
            <div class="section-title">
                <h2>Certifications</h2>
                <span class="label">Courses</span>
            </div>
            <p class="hint">Add certification details and an optional badge image.</p>
            <form method="post" action="save.php" class="grid-2" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_certification">
                <div><label>Course</label><input name="course" required></div>
                <div><label>Issuer</label><input name="issuer" required></div>
                <div style="grid-column: span 2;">
                    <label>Badge Image (optional)</label>
                    <input type="file" name="cert_image" accept="image/*">
                    <p class="hint">JPEG/PNG/WebP up to 2MB.</p>
                </div>
                <button class="btn" type="submit" style="width:180px;">Add</button>
            </form>
            <?php if ($certifications): ?>
                <div class="gallery-grid">
                    <?php foreach ($certifications as $row): ?>
                        <div class="gallery-card">
                            <?php if (!empty($row['image'])): ?>
                                <img class="thumb" src="../<?= htmlspecialchars($row['image']); ?>" alt="Certificate image">
                            <?php endif; ?>
                            <div>
                                <strong><?= htmlspecialchars($row['course']); ?></strong><br>
                                <span class="meta"><?= htmlspecialchars($row['issuer']); ?></span>
                            </div>
                            <div class="actions" style="margin-top:6px;">
                                <form method="post" action="save.php">
                                    <input type="hidden" name="action" value="delete_certification">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <button class="small-btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="muted" style="margin-top:10px;">No certifications added yet.</p>
            <?php endif; ?>
        </section>

        <section id="achievements" class="card">
            <div class="section-title">
                <h2>Achievements</h2>
                <span class="label">Highlights</span>
            </div>
            <p class="hint">Add highlights and optionally attach an image or certificate.</p>
            <form method="post" action="save.php" class="flex" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_achievement">
                <input name="description" placeholder="Achievement detail" required>
                <input type="file" name="achievement_image" accept="image/*" style="flex:1; min-width:220px;">
                <button class="btn" type="submit">Add</button>
            </form>
            <?php if ($achievements): ?>
                <div class="gallery-grid">
                    <?php foreach ($achievements as $row): ?>
                        <div class="gallery-card">
                            <?php if (!empty($row['image'])): ?>
                                <img class="thumb" src="../<?= htmlspecialchars($row['image']); ?>" alt="Achievement image">
                            <?php endif; ?>
                            <div><?= htmlspecialchars($row['description']); ?></div>
                            <div class="actions" style="margin-top:6px;">
                                <form method="post" action="save.php">
                                    <input type="hidden" name="action" value="delete_achievement">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <button class="small-btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="muted" style="margin-top:10px;">No achievements added yet.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>

