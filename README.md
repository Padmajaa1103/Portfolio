# Portfolio Website

A dynamic portfolio website built with PHP, MySQL, and modern web technologies. Features an admin panel for easy content management and a responsive design optimized for all devices.

## 🚀 Features

### Frontend
- **Responsive Design** - Works perfectly on desktop, tablet, and mobile
- **Modern UI/UX** - Clean, professional design with smooth animations
- **Interactive Elements** - Hover effects, scroll animations, and dynamic content
- **Contact Form** - Functional contact section with email integration
- **Social Links** - LinkedIn and GitHub integration
- **Profile Photo Click** - Click profile photo to access admin panel

### Backend
- **Admin Panel** - Secure login system for content management
- **Database Integration** - MySQL database for dynamic content storage
- **File Uploads** - Support for profile photos, resumes, certificates, and more
- **Dynamic Content** - Easily update skills, projects, education, and achievements
- **Modal Windows** - Interactive modals for viewing certificates and internships

### Content Management
- **Skills Management** - Organize skills by categories
- **Projects Portfolio** - Showcase projects with technologies and features
- **Education Background** - Display academic achievements
- **Internships & Training** - Document professional experience
- **Certifications** - Upload and display certificates with modal viewing
- **Achievements** - Highlight notable accomplishments

## 🛠️ Technologies Used

- **Backend**: PHP 8+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Styling**: Custom CSS with modern design patterns
- **Icons**: SVG icons for social media and UI elements
- **File Uploads**: PHP file handling with validation

## 📋 Prerequisites

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- File upload permissions enabled

## 🚀 Installation

### Local Development (XAMPP)

1. **Clone the repository**
   ```bash
   git clone https://github.com/Padmajaa1103/Portfolio.git
   cd Portfolio
   ```

2. **Database Setup**
   - Import `portfolio_db.sql` into your MySQL database
   - Update database credentials in `config.php`

3. **Configure**
   ```php
   // config.php
   'db' => [
       'host' => 'localhost',
       'name' => 'portfolio_db',
       'user' => 'root',
       'pass' => '',
       'charset' => 'utf8mb4',
   ]
   ```

4. **Start Server**
   - Place files in XAMPP htdocs
   - Start Apache and MySQL
   - Access at `http://localhost/Portfolio`

### Production Deployment (InfinityFree)

1. **Upload Files**
   - Upload all files to your hosting account
   - Ensure proper file permissions

2. **Database Configuration**
   ```php
   // config.php - Update with your hosting credentials
   'db' => [
       'host' => 'your_sql_host.infinityfree.com',
       'name' => 'your_database_name',
       'user' => 'your_username',
       'pass' => 'your_database_password',
       'charset' => 'utf8mb4',
   ]
   ```

3. **Import Database**
   - Import `portfolio_db.sql` through your hosting control panel
   - Update table prefixes if needed

## 🔐 Admin Access

### Default Credentials
- **Username**: `admin`
- **Password**: `admin123`

**⚠️ Security Note**: Change the default password after first login!

### Access Methods
1. **Direct URL**: `/admin/login.php`
2. **Profile Photo**: Click on profile photo in hero section

### Admin Features
- **Site Information**: Update name, title, tagline, contact details
- **Social Links**: Manage LinkedIn and GitHub links
- **Skills**: Add/edit skills by category
- **Projects**: Manage portfolio projects with GitHub links
- **Education**: Update educational background
- **Internships**: Add internship experiences with document uploads
- **Certifications**: Upload and manage certificates
- **Achievements**: Display notable accomplishments

## 📁 Project Structure

```
Portfolio/
├── admin/                  # Admin panel files
│   ├── dashboard.php      # Main admin interface
│   ├── login.php          # Admin login
│   ├── logout.php         # Admin logout
│   └── save.php           # Data processing
├── assets/                # Static assets
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript files
│   └── uploads/          # User uploaded files
│       ├── profile/      # Profile photos
│       ├── resumes/      # Resume files
│       ├── certifications/ # Certificates
│       └── internships/  # Internship documents
├── config.php            # Configuration file
├── db.php               # Database connection
├── index.php            # Main portfolio page
├── portfolio_db.sql     # Database schema
└── README.md           # This file
```

## 🎨 Customization

### Colors and Styling
- Modify `assets/css/styles.css` for visual customizations
- CSS variables are used for easy theme changes

### Content Updates
- Use the admin panel for content management
- Or directly modify the database for advanced users

### Adding New Sections
- Create new database tables as needed
- Update admin panel for new content types
- Modify `index.php` for frontend display

## 🔧 Troubleshooting

### Common Issues

1. **Database Connection Failed**
   - Check database credentials in `config.php`
   - Ensure MySQL server is running
   - Verify database exists and user has permissions

2. **File Upload Issues**
   - Check folder permissions (755 for directories, 644 for files)
   - Ensure PHP upload limits are sufficient
   - Verify file size restrictions

3. **Admin Login Issues**
   - Clear browser cookies
   - Check session configuration
   - Verify admin credentials in database

4. **InfinityFree Specific**
   - Use correct SQL hostname (sqlXXX.infinityfree.com)
   - Ensure database name includes your username prefix
   - Check if database tables exist

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📞 Contact

- **Portfolio**: [Your Live Portfolio URL]
- **GitHub**: [https://github.com/Padmajaa1103](https://github.com/Padmajaa1103)
- **LinkedIn**: [Your LinkedIn Profile]

---

**Built with ❤️ for showcasing professional achievements**
