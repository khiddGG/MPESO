# MPESO - Manpower and Employment Services Office System

## Overview
MPESO is a web-based system designed to manage and streamline the operations of the Manpower and Employment Services Office. The system facilitates job posting, application processing, and employment services management.

## Features
- Job Posting and Management
- Applicant Registration and Profile Management
- Job Application Processing
- Company/Employer Management
- Advanced Search Functionality
- Admin Dashboard
- Staff Management Interface

## System Requirements
- PHP 7.0 or higher
- MySQL Database
- Web Server (Apache/Nginx)
- Modern Web Browser

## Installation
1. Clone the repository:
```bash
git clone https://github.com/khiddGG/MPESO.git
```
2. Import the database using the provided SQL files:
   - `database.sql`
   - `erisdb.sql`
3. Configure your database connection in the system
4. Access the system through your web browser

## Login Credentials

### Administrator Access
- **Username:** marwan
- **Password:** marwan
- **Access Level:** Full system access
- **Capabilities:** 
  - System configuration
  - User management
  - Job posting management
  - Reports generation

### Staff Access
- **Username:** marwan2
- **Password:** marwan2
- **Access Level:** Staff level access
- **Capabilities:**
  - Job posting management
  - Application processing
  - Basic reporting

## Directory Structure
- `/admin` - Administrator interface
- `/applicant` - Applicant portal
- `/include` - System includes and configurations
- `/plugins` - Third-party plugins and libraries
- `/theme` - System themes and styling
- `/img` - Image assets
- `/documentation` - System documentation

## Security
- All passwords are encrypted
- Session management implemented
- Input validation and sanitization
- XSS protection

## Support
For support and inquiries, please contact the system administrator.

## License
This project is proprietary software. All rights reserved. 