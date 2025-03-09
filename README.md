# Sunglasses E-commerce Platform

A complete e-commerce solution for selling sunglasses online, built with PHP, MySQL, and Docker.

## Project Overview

This e-commerce platform provides a complete solution for selling sunglasses online with the following features:

- Customer registration and login
- Product browsing and searching
- Shopping cart functionality
- Secure checkout process
- Admin panel for product and order management
- Responsive design for mobile and desktop

## Technology Stack

- **Backend**: PHP
- **Database**: MySQL 8.0
- **Server**: Apache
- **Containerization**: Docker & Docker Compose

## Prerequisites

Before you begin, ensure you have the following installed on your Windows system:

- [Docker Desktop for Windows](https://www.docker.com/products/docker-desktop)
- Git (optional, for cloning the repository)

## Docker Installation Guide for Windows

1. **Install Docker Desktop for Windows**:
   - Download Docker Desktop from [Docker's official website](https://www.docker.com/products/docker-desktop)
   - Follow the installation wizard instructions
   - Ensure Hyper-V and Windows containers features are enabled if prompted
   - Restart your computer if required

2. **Verify Docker Installation**:
   - Open PowerShell or Command Prompt
   - Run the following commands to verify Docker is installed correctly:
     ```
     docker --version
     docker-compose --version
     ```

## Running the Project Locally

1. **Clone or download the project**:
   ```
   git clone <repository-url>
   ```
   Or download and extract the project ZIP file

2. **Navigate to the project directory**:
   ```
   cd Sunglasses
   ```

3. **Configure environment variables (optional)**:
   - The project includes a default `.env` file with database credentials
   - You can modify these values if needed, but the defaults will work out of the box

4. **Start the Docker containers**:
   ```
   docker-compose up -d
   ```
   This command builds and starts the containers in detached mode

5. **Access the application**:
   - Open your browser and navigate to: `http://localhost:8080`
   - The admin panel is available at: `http://localhost:8080/admin`
     - Default admin credentials (if applicable): Check documentation or database

6. **Stop the containers**:
   ```
   docker-compose down
   ```
   To stop and remove the containers

## Deploying to a Server Using Docker

### Prerequisites for Server Deployment

- A Linux server with SSH access
- Docker and Docker Compose installed on the server
- Git (optional, for cloning the repository)

### Deployment Steps

1. **Install Docker and Docker Compose on your server**:
   ```bash
   # Update package index
   sudo apt update
   
   # Install required packages
   sudo apt install -y apt-transport-https ca-certificates curl software-properties-common
   
   # Add Docker's official GPG key
   curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
   
   # Add Docker repository
   sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
   
   # Update package index again
   sudo apt update
   
   # Install Docker CE
   sudo apt install -y docker-ce
   
   # Install Docker Compose
   sudo curl -L "https://github.com/docker/compose/releases/download/v2.18.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
   sudo chmod +x /usr/local/bin/docker-compose
   ```

2. **Transfer the project files to your server**:
   - Using SCP:
     ```
     scp -r /path/to/local/project username@server_ip:/path/on/server
     ```
   - Or clone from a Git repository:
     ```
     git clone <repository-url>
     ```

3. **Navigate to the project directory on your server**:
   ```
   cd /path/to/project
   ```

4. **Configure environment variables for production**:
   - Edit the `.env` file with secure credentials:
     ```
     DB_ROOT_PASSWORD=secure_root_password
     DB_NAME=sunglass_ecommerce
     DB_USER=secure_username
     DB_PASSWORD=secure_password
     ```

5. **Start the Docker containers**:
   ```
   docker-compose up -d
   ```

6. **Configure a reverse proxy (optional but recommended)**:
   - If you want to use a domain name and HTTPS, set up Nginx or Apache as a reverse proxy
   - Example Nginx configuration:
     ```
     server {
         listen 80;
         server_name yourdomain.com;
         
         location / {
             proxy_pass http://localhost:8080;
             proxy_set_header Host $host;
             proxy_set_header X-Real-IP $remote_addr;
         }
     }
     ```

7. **Set up SSL with Let's Encrypt (recommended)**:
   - Install Certbot and obtain SSL certificates for your domain

## Maintenance and Updates

### Updating the Application

1. Pull the latest changes from your repository:
   ```
   git pull origin main
   ```

2. Rebuild and restart the containers:
   ```
   docker-compose down
   docker-compose up -d --build
   ```

### Database Backups

1. Create a backup of the MySQL database:
   ```
   docker exec mysql_container mysqldump -u root -p sunglass_ecommerce > backup.sql
   ```

2. Restore from a backup:
   ```
   docker exec -i mysql_container mysql -u root -p sunglass_ecommerce < backup.sql
   ```

## Troubleshooting

### Common Issues

1. **Port conflicts**: If port 8080 or 3306 is already in use, modify the port mappings in `docker-compose.yml`

2. **Database connection issues**: Ensure the database container is running and the connection parameters in `.env` match those in `docker-compose.yml`

3. **Permission issues**: If you encounter permission problems, ensure proper ownership:
   ```
   docker exec -it php_apache_container chown -R www-data:www-data /var/www/html
   ```

## License

[Specify your license information here]

## Contact

[Your contact information or support details] 