# Online_bus_tickets_booking
this is a project that helps to automate the traditional buss ticketing system with digital mediums. 
Bus Ticket Booking System

Github link of project.  
https://github.com/Susandhamala/Online_bus_tickets_booking/tree/master  
youtube video link : https://youtu.be/HQaPrSBNw5Q   


this is main branch if you trouble finding codes its in master branch.







Overview
The Bus Ticket Booking System is a web-based application designed to facilitate the booking of bus tickets online. The system allows users to select routes, choose seats, and book tickets conveniently from their devices. The application also includes functionalities for managing bookings, viewing booked tickets, and administrative tasks.



Installation
Clone the repository:

git clone https://github.com/Susandhamala/Online_bus_tickets_booking.git


Navigate to the project directory:
cd bus_ticket_booking
Import the database schema (Database Schema.sql) into your MySQL database.

Update the database connection settings in database.php:

Start your web server (e.g., Apache) and navigate to the project URL (e.g., http://localhost/bus_ticket_booking).

Usage
Register as a new user or login with an existing account.

Select a route from the dropdown menu.

Choose your seats on the seat selection page.

Confirm your booking to complete the process.

View your booked tickets on the View Tickets page.


Features
Route Selection: Users can select routes from a dropdown menu.

Seat Selection: Users can select available seats.

Real-Time Availability: The system updates seat availability in real-time.

Booking Confirmation: Users receive confirmation of their bookings and can view their booked tickets.

User Roles: Supports different user roles such as Admin, Manager, and Customer.



/bus_ticket_booking/
│──   css/style.css            # Stylesheet
│── script.js                  # JavaScript file
│── pass.js                    # passwort strength auth 
│── add_buss.php               # to add bus
│── add_route.php               # to add route 
│── admin_dashboard.php        # Admin dashboard
│── manage_users.php           # Manage users
│── manager_dashboard.php      # Manager dashboard
│── manage_routes.php          # Manage bus routes
│── approve_bookings.php       # Approve bookings
│── user_dashboard.php         # User (Customer) dashboard
│── book_ticket.php            # Book a ticket
│── view_tickets.php           # View tickets
│── database.php               # Database connection
│── login.php                  # Login page
│── register.php               # Registration page
│── logout.php                 # Logout page
│── header.php                 # Header file
│── footer.php                 # Footer file
│── index.php                  # Home page
│── README.md                  # Documentation
│── delete.php                 # to delete any things  
│──edit_route.php
│──edit_user.php
│──user_booking.php
