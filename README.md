# Salle d'escalade Web Application

Welcome to the Salle d'escalade web application. This platform allows users to reserve climbing sessions seamlessly.

## Table of Contents

- [About the Project](#about-the-project)
- [Features](#features)
- [Screenshots](#screenshots)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## About the Project

This project is a web-based application designed for climbing enthusiasts to book sessions at our climbing facility. It offers an intuitive interface for users to view available slots and make reservations accordingly.

## Features

- **User Registration and Authentication**: Secure sign-up and login functionalities.
- **Session Booking**: Browse and reserve available climbing sessions.
- **Responsive Design**: Optimized for various devices, ensuring a seamless user experience.

## Screenshots

*Note: Include relevant screenshots here to showcase the application's interface and functionalities.*

## Getting Started

Follow these instructions to set up the project locally.

### Prerequisites

- Docker installed on your machine.
- Node.js and npm installed.

### Installation

1. **Clone the repository**:

   ```bash
   git clone https://github.com/Aymankhallaf/Salle-d-escalade-web.git
   ```

2. **Navigate to the project directory**:

   ```bash
   cd Salle-d-escalade-web
   ```

3. **Build and run the Docker containers**:

   ```bash
   docker-compose up -d
   ```

4. **Set up the database**:

   - Import the example database located in the `sql-example` folder.
   - Update the database connection parameters in the `.env` file as needed.

5. **Navigate to the app directory**:

   ```bash
   cd app
   ```

6. **Install dependencies**:

   ```bash
   npm install
   ```

7. **Run the development server**:

   ```bash
   npm run dev
   ```

## Usage

Once the setup is complete, access the application through your web browser at `http://localhost:8000`.

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your proposed changes.

## License

This project is licensed under the MIT License.

## Contact

For any inquiries or support, please contact [Ayman Khallaf](mailto:engAymanKHALAF.com).

