<?php
require __DIR__ . '/db.php';

$site = $pdo->query('SELECT * FROM site_info WHERE id = 1')->fetch();

$skillsStmt = $pdo->query('SELECT category, name FROM skills ORDER BY category, name');
$skills = [];
foreach ($skillsStmt as $row) {
    $skills[$row['category']][] = $row['name'];
}

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
    <title><?= htmlspecialchars($site['site_title'] ?? 'Portfolio'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <header class="topbar">
        <div class="container topbar__inner">
            <div class="logo"><?= htmlspecialchars($site['name'] ?? 'Portfolio'); ?></div>
            <nav class="nav" id="nav">
                <a href="#about">About</a>
                <a href="#skills">Skills</a>
                <a href="#projects">Projects</a>
                <a href="#education">Education</a>
                <a href="#contact">Contact</a>
                <a href="admin/login.php" class="nav__admin">Admin</a>
            </nav>
            <button class="nav__toggle" id="navToggle" aria-label="Toggle navigation">☰</button>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero__grid">
                <div class="hero__content">
                    <p class="eyebrow">Hello, I am</p>
                    <h1><?= htmlspecialchars($site['name']); ?></h1>
                    <p class="hero__title"><?= htmlspecialchars($site['title']); ?></p>
                    <p class="hero__tagline"><?= htmlspecialchars($site['tagline']); ?></p>
                    <div class="hero__actions">
                        <?php if (!empty($site['resume_url'])): ?>
                            <a class="btn" href="<?= htmlspecialchars($site['resume_url']); ?>" download>Download Resume</a>
                        <?php endif; ?>
                        <a class="btn btn--ghost" href="#contact">Contact Me</a>
                    </div>
                    <div class="hero__social">
                        <?php if (!empty($site['linkedin'])): ?>
                            <a href="<?= htmlspecialchars($site['linkedin']); ?>" target="_blank" rel="noreferrer" class="social-link" aria-label="LinkedIn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($site['github'])): ?>
                            <a href="<?= htmlspecialchars($site['github']); ?>" target="_blank" rel="noreferrer" class="social-link" aria-label="GitHub">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="hero__stats">
                        <div class="stat">
                            <div class="stat__number">3+</div>
                            <div class="stat__label">Projects</div>
                        </div>
                        <div class="stat">
                            <div class="stat__number">2+</div>
                            <div class="stat__label">Years Exp.</div>
                        </div>
                        <div class="stat">
                            <div class="stat__number">5+</div>
                            <div class="stat__label">Certifications</div>
                        </div>
                    </div>
                </div>
                <div class="hero__image">
                    <div class="hero__photo-wrap">
                        <div class="hero__photo-bg"></div>
                        <div class="hero__photo-ring"></div>
                        <img class="hero__photo" src="<?= htmlspecialchars($site['profile_photo'] ?? 'assets/img/profile.jpg'); ?>" alt="Profile photo" onclick="window.location.href='admin/login.php'" style="cursor: pointer;" title="Click to access admin panel">
                        <div class="hero__card">
                            <div class="hero__badge">Available for Work</div>
                            <p>Open to internships and entry-level roles.</p>
                            <ul>
                                <li>Responsive design</li>
                                <li>Clean, semantic code</li>
                                <li>Modern frameworks</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="section reveal">
            <div class="container section__header reveal">
                <span class="label">About</span>
                <h2>About Me</h2>
            </div>
            <div class="container about reveal">
                <p class="about__intro"><?= htmlspecialchars($site['about_intro']); ?></p>
                <div class="about__grid">
                    <div class="card">
                        <div class="about__icon">🎓</div>
                        <h3>Education Background</h3>
                        <p><?= htmlspecialchars($site['education_background']); ?></p>
                    </div>
                    <div class="card">
                        <div class="about__icon">🎯</div>
                        <h3>Career Goal</h3>
                        <p><?= htmlspecialchars($site['career_goal']); ?></p>
                    </div>
                    <div class="card">
                        <div class="about__icon">💪</div>
                        <h3>Personal Strengths</h3>
                        <p><?= htmlspecialchars($site['strengths']); ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section id="skills" class="section section--muted reveal">
            <div class="container section__header reveal">
                <span class="label">Skills</span>
                <h2>Technical & Soft Skills</h2>
                <p>Technologies and tools I work with</p>
            </div>
            <div class="container skills">
                <?php foreach ($skills as $category => $items): ?>
                    <div class="card skill-category reveal">
                        <h3><?= htmlspecialchars($category); ?></h3>
                        <ul class="taglist">
                            <?php foreach ($items as $item): ?>
                                <li><?= htmlspecialchars($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="projects" class="section reveal">
            <div class="container section__header reveal">
                <span class="label">Projects</span>
                <h2>Featured Work</h2>
                <p>Some of my recent projects</p>
            </div>
            <div class="container projects">
                <?php foreach ($projects as $index => $project): ?>
                    <article class="card project reveal" style="transition-delay: <?= $index * 0.1 ?>s">
                        <div class="project__header">
                            <h3><?= htmlspecialchars($project['title']); ?></h3>
                            <?php if (!empty($project['github_url'])): ?>
                                <a class="link" href="<?= htmlspecialchars($project['github_url']); ?>" target="_blank" rel="noreferrer">GitHub →</a>
                            <?php endif; ?>
                        </div>
                        <p><?= htmlspecialchars($project['description']); ?></p>
                        <?php if (!empty($project['technologies'])): ?>
                            <div class="project__chips">
                                <?php foreach (explode(',', $project['technologies']) as $tech): ?>
                                    <?php $t = trim($tech); if ($t !== ''): ?>
                                        <span class="chip"><?= htmlspecialchars($t); ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($project['features'])): ?>
                            <ul class="project__features">
                                <?php foreach (explode(';', $project['features']) as $feature): ?>
                                    <?php if (trim($feature) !== ''): ?>
                                        <li><?= htmlspecialchars(trim($feature)); ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="education" class="section section--muted reveal">
            <div class="container section__header reveal">
                <span class="label">Education</span>
                <h2>Academic Background</h2>
                <p>My educational journey</p>
            </div>
            <div class="container grid-2">
                <?php foreach ($education as $edu): ?>
                    <div class="card education-card reveal">
                        <div class="education__icon">🎓</div>
                        <div>
                        <h3><?= htmlspecialchars($edu['degree']); ?></h3>
                        <p class="muted"><?= htmlspecialchars($edu['institution']); ?></p>
                        <p><?= htmlspecialchars($edu['year']); ?> — <?= htmlspecialchars($edu['score']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="internships" class="section reveal">
            <div class="container section__header reveal">
                <span class="label">Experience</span>
                <h2>Internships & Training</h2>
            </div>
            <div class="container grid-2">
                <?php foreach ($internships as $intern): ?>
                    <div class="card reveal internship-card" style="cursor: pointer;" onclick="handleInternClick(this, '<?= htmlspecialchars($intern['image']); ?>', '<?= htmlspecialchars(addslashes($intern['organization'])); ?>', '<?= htmlspecialchars(addslashes($intern['role'])); ?>')">
                        <?php if (!empty($intern['image'])): ?>
                            <img class="intern__img" src="<?= htmlspecialchars($intern['image']); ?>" alt="Internship image">
                        <?php endif; ?>
                        <div class="internship-card__body">
                            <h3><?= htmlspecialchars($intern['organization']); ?></h3>
                            <p class="muted"><?= htmlspecialchars($intern['role']); ?> — <?= htmlspecialchars($intern['duration']); ?></p>
                            <p><?= htmlspecialchars($intern['learnings']); ?></p>
                            <div class="intern__view-badge">Click to View</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="certifications" class="section section--muted reveal">
            <div class="container section__header reveal">
                <span class="label">Certifications</span>
                <h2>Courses & Credentials</h2>
                <p>Professional certifications I've earned</p>
            </div>
            <div class="container certifications-grid">
                <?php foreach ($certifications as $cert): ?>
                    <div class="card reveal cert-card" style="cursor: pointer;" onclick="handleCertClick(this, '<?= htmlspecialchars($cert['image']); ?>', '<?= htmlspecialchars(addslashes($cert['course'])); ?>', '<?= htmlspecialchars(addslashes($cert['issuer'])); ?>')">
                        <?php if (!empty($cert['image'])): ?>
                            <img class="cert__img" src="<?= htmlspecialchars($cert['image']); ?>" alt="Certification image">
                        <?php endif; ?>
                        <div class="cert-card__body">
                            <h3><?= htmlspecialchars($cert['course']); ?></h3>
                            <p class="muted"><?= htmlspecialchars($cert['issuer']); ?></p>
                            <div class="cert__view-badge">Click to View</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <?php if ($achievements): ?>
        <section id="achievements" class="section reveal">
            <div class="container section__header reveal">
                <span class="label">Achievements</span>
                <h2>Highlights</h2>
                <p>Notable accomplishments and awards</p>
            </div>
            <div class="container achievements">
                <?php foreach ($achievements as $ach): ?>
                    <div class="card reveal achievement-card">
                        <div class="achievement__icon">🏆</div>
                        <?php if (!empty($ach['image'])): ?>
                            <img class="achievement__img" src="<?= htmlspecialchars($ach['image']); ?>" alt="Achievement image">
                        <?php endif; ?>
                        <span><?= htmlspecialchars($ach['description']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <section id="contact" class="section section--muted reveal">
            <div class="container section__header reveal">
                <span class="label">Contact</span>
                <h2>Let's Connect</h2>
                <p>Get in touch with me</p>
            </div>
            <div class="container contact">
                <div class="contact__info reveal">
                        <?php if (!empty($site['contact_email'])): ?>
                            <div class="contact__item">
                                <div class="contact__icon">✉</div>
                                <div class="contact__details">
                                    <h4>Email</h4>
                                    <p><a href="mailto:<?= htmlspecialchars($site['contact_email']); ?>"><?= htmlspecialchars($site['contact_email']); ?></a></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($site['phone'])): ?>
                            <div class="contact__item">
                                <div class="contact__icon">📞</div>
                                <div class="contact__details">
                                    <h4>Phone</h4>
                                    <p><?= htmlspecialchars($site['phone']); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($site['location'])): ?>
                            <div class="contact__item">
                                <div class="contact__icon">📍</div>
                                <div class="contact__details">
                                    <h4>Location</h4>
                                    <p><?= htmlspecialchars($site['location']); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                </div>
                <div class="contact__cta reveal">
                    <h3>Open to work</h3>
                    <p>Interested in internships or junior web development roles.</p>
                    <a class="btn" href="mailto:<?= htmlspecialchars($site['contact_email']); ?>">Email Me</a>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer__inner">
            <div class="footer__brand"><?= htmlspecialchars($site['name'] ?? 'Portfolio'); ?> <span>Portfolio</span></div>
            <div class="footer__links">
                <?php if (!empty($site['linkedin'])): ?>
                    <a href="<?= htmlspecialchars($site['linkedin']); ?>" target="_blank" rel="noreferrer">in</a>
                <?php endif; ?>
                <?php if (!empty($site['github'])): ?>
                    <a href="<?= htmlspecialchars($site['github']); ?>" target="_blank" rel="noreferrer">GH</a>
                <?php endif; ?>
                <?php if (!empty($site['contact_email'])): ?>
                    <a href="mailto:<?= htmlspecialchars($site['contact_email']); ?>">@</a>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <!-- Certificate Modal -->
    <div id="certModal" class="cert-modal">
        <div class="cert-modal__overlay" onclick="closeCertModal()"></div>
        <div class="cert-modal__content">
            <button class="cert-modal__close" onclick="closeCertModal()">&times;</button>
            <div class="cert-modal__header">
                <h3 id="certModalTitle"></h3>
                <p id="certModalIssuer" class="muted"></p>
            </div>
            <div class="cert-modal__body">
                <img id="certModalImage" src="" alt="Certificate">
            </div>
        </div>
    </div>

    <!-- Internship Modal -->
    <div id="internModal" class="cert-modal">
        <div class="cert-modal__overlay" onclick="closeInternModal()"></div>
        <div class="cert-modal__content">
            <button class="cert-modal__close" onclick="closeInternModal()">&times;</button>
            <div class="cert-modal__header">
                <h3 id="internModalTitle"></h3>
                <p id="internModalRole" class="muted"></p>
            </div>
            <div class="cert-modal__body">
                <img id="internModalImage" src="" alt="Internship Letter">
            </div>
        </div>
    </div>

    <script>
    // Certificate Modal Functions - Inline to ensure they work
    window.handleCertClick = function(element, imageSrc, title, issuer) {
      console.log('Certificate clicked!');
      console.log('Image:', imageSrc);
      console.log('Title:', title);
      console.log('Issuer:', issuer);
      
      element.style.transform = 'scale(0.98)';
      setTimeout(() => {
        element.style.transform = '';
      }, 150);
      
      window.openCertModal(imageSrc, title, issuer);
    }

    window.openCertModal = function(imageSrc, title, issuer) {
      console.log('Opening modal:', imageSrc, title, issuer);
      const modal = document.getElementById('certModal');
      const modalImage = document.getElementById('certModalImage');
      const modalTitle = document.getElementById('certModalTitle');
      const modalIssuer = document.getElementById('certModalIssuer');
      
      if (!imageSrc) {
        console.log('No image source provided');
        return;
      }
      
      modalImage.src = imageSrc;
      modalTitle.textContent = title;
      modalIssuer.textContent = issuer;
      
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
      console.log('Modal opened successfully');
    }

    window.closeCertModal = function() {
      const modal = document.getElementById('certModal');
      modal.classList.remove('active');
      document.body.style.overflow = '';
      console.log('Modal closed');
    }

    // Internship Modal Functions
    window.handleInternClick = function(element, imageSrc, organization, role) {
      console.log('Internship clicked!');
      const modal = document.getElementById('internModal');
      const modalImage = document.getElementById('internModalImage');
      const modalTitle = document.getElementById('internModalTitle');
      const modalRole = document.getElementById('internModalRole');
      
      if (!imageSrc) return;
      
      modalImage.src = imageSrc;
      modalTitle.textContent = organization;
      modalRole.textContent = role;
      
      element.style.transform = 'scale(0.98)';
      setTimeout(() => { element.style.transform = ''; }, 150);
      
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    window.closeInternModal = function() {
      const modal = document.getElementById('internModal');
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        window.closeCertModal();
        window.closeInternModal();
      }
    });
    </script>

    <script src="assets/js/main.js?v=<?= time() ?>"></script>
</body>
</html>

