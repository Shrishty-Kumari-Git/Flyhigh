# Flyhigh: E-Commerce Platform for Ticket Booking
### Project Folder present in master branch.

## Overview:
Welcome to Flyhigh – a PHP-based e-commerce platform designed to make ticket booking for buses, trains, and flights a seamless and efficient experience. Whether you're planning a trip or managing your transportation needs, Flyhigh allows users to easily book and manage their tickets all in one place.

# Features:
* Multi-modal Ticket Booking: Book tickets for buses, trains, and flights from one integrated platform.
* Secure & Scalable Architecture: Deployed on AWS EC2 for optimal performance, high availability, and scalability.
* Continuous Integration and Continuous Deployment (CI/CD): Streamlined using Jenkins, Ansible, and Terraform to ensure smooth deployment and automation across the system.
* Database Management: Handled via PHPMyAdmin, ensuring an organized and easy-to-manage approach to database administration.
* Robust Security: Designed with a focus on security at all levels, ensuring a safe experience for both users and administrators.
* High Availability: Leveraging AWS cloud infrastructure, the platform is designed for fault tolerance and uptime.

# Tech Stack:
* Frontend: HTML, CSS, JavaScript
* Backend: PHP (Laravel)
* Database: MySQL (Managed via PHPMyAdmin)
* Deployment: AWS EC2
* CI/CD Tools: Jenkins, Ansible, Terraform


# Make sure you have the following installed:
* PHP (latest stable version)
* Composer (for PHP dependency management)
* MySQL
* Apache or Nginx (for local server)
* AWS CLI (if you are deploying on AWS EC2)
* Jenkins, Ansible, and Terraform (for CI/CD automation)

# CI/CD Pipeline:
* The project uses Jenkins for continuous integration and Terraform & Ansible for automated deployment and configuration management.
* Jenkins automates the building, testing, and deployment processes.
* Terraform is used to define the infrastructure as code (IaC) for provisioning and managing AWS resources.
* Ansible automates server configuration and application deployment.
* This ensures that every change is automatically tested, deployed, and ready for production with minimal human intervention.
